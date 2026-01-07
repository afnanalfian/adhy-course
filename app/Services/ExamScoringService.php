<?php

namespace App\Services;

use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Support\Str;

class ExamScoringService
{
    /**
     * ======================================================
     * ENTRY POINT
     * ======================================================
     */
    public function scoreAttempt(ExamAttempt $attempt): array
    {
        $attempt->load([
            'exam',
            'exam.questions.question.options',
            'exam.questions.question.subItems.answers',
            'answers',
        ]);

        $exam = $attempt->exam;

        return match ($exam->test_type) {
            'skd'       => $this->scoreSKD($attempt),
            'mtk_stis'  => $this->scoreMtkStis($attempt),
            'mtk_tka'   => $this->scoreMtkTka($attempt),
            'general'   => $this->scoreGeneral($attempt),
            default     => $this->scoreDefault($attempt),
        };
    }

    /**
     * ======================================================
     * 1. SKD
     * ======================================================
     */
    protected function scoreSKD(ExamAttempt $attempt): array
    {
        $score = 0;
        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer   = $attempt->answers->firstWhere('question_id', $question->id);

            // kosong
            if (!$answer || $answer->isEmpty) {
                continue;
            }

            // TKP → pakai bobot
            if ($question->test_type === 'tkp') {
                $score += $this->getTkpScore($question, $answer);
                $answer->update(['is_correct' => null]);
                continue;
            }

            // TIU / TWK → MCQ tunggal
            $isCorrect = $this->checkMcqSingle($question, $answer);

            if ($isCorrect) {
                $score += 5;
                $correct++;
            } else {
                $wrong++;
            }

            $answer->update(['is_correct' => $isCorrect]);
        }

        return $this->result($score, $correct, $wrong);
    }

    /**
     * ======================================================
     * 2. MTK STIS
     * - MCQ only
     * - benar +4, salah -1, kosong 0
     * ======================================================
     */
    protected function scoreMtkStis(ExamAttempt $attempt): array
    {
        $score = 0;
        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer   = $attempt->answers->firstWhere('question_id', $question->id);

            if (!$answer || $answer->isEmpty) {
                continue;
            }

            $isCorrect = $this->checkMcqSingle($question, $answer);

            if ($isCorrect) {
                $score += 4;
                $correct++;
            } else {
                $score -= 1;
                $wrong++;
            }

            $answer->update(['is_correct' => $isCorrect]);
        }

        return $this->result($score, $correct, $wrong);
    }

    /**
     * ======================================================
     * 3. MTK TKA
     * - Skala 0–100
     * - MCMA harus persis
     * - Compound: semua sub benar
     * ======================================================
     */
    protected function scoreMtkTka(ExamAttempt $attempt): array
    {
        return $this->scoreScaled($attempt, allowShortAnswer: false);
    }

    /**
     * ======================================================
     * 4. GENERAL
     * - Skala 0–100
     * - Semua tipe termasuk short answer
     * ======================================================
     */
    protected function scoreGeneral(ExamAttempt $attempt): array
    {
        return $this->scoreScaled($attempt, allowShortAnswer: true);
    }

    /**
     * ======================================================
     * SHARED: SCALE 0–100
     * ======================================================
     */
    protected function scoreScaled(
        ExamAttempt $attempt,
        bool $allowShortAnswer
    ): array {
        $correct = 0;
        $wrong = 0;
        $total = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer   = $attempt->answers->firstWhere('question_id', $question->id);

            $total++;

            if (!$answer || $answer->isEmpty) {
                $wrong++;
                continue;
            }

            $isCorrect = match ($question->type) {
                'mcq', 'truefalse' => $this->checkMcqSingle($question, $answer),
                'mcma'             => $this->checkMcmaExact($question, $answer),
                'compound'         => $this->checkCompound($question, $answer),
                'short_answer'     => $allowShortAnswer
                    ? $this->checkShortAnswer($question, $answer)
                    : false,
                default            => false,
            };

            $isCorrect ? $correct++ : $wrong++;
            $answer->update(['is_correct' => $isCorrect]);
        }

        $score = round(($correct / max(1, $total)) * 100);

        return $this->result($score, $correct, $wrong);
    }

    /**
     * ======================================================
     * HELPERS
     * ======================================================
     */
    protected function checkMcqSingle(Question $question, $answer): bool
    {
        $selected = $answer->selected_ids;
        if (count($selected) !== 1) return false;

        $correctId = $question->options
            ->where('is_correct', true)
            ->first()?->id;

        return (int) $selected[0] === (int) $correctId;
    }

    protected function checkMcmaExact(Question $question, $answer): bool
    {
        $selected = collect($answer->selected_ids)->sort()->values()->toArray();

        $correct = $question->options
            ->where('is_correct', true)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values()
            ->toArray();

        return $selected === $correct;
    }

    protected function checkCompound(Question $question, $answer): bool
    {
        foreach ($question->subItems as $subItem) {
            $student = $answer->getCompoundAnswerBySubId($subItem->id);
            if (!$student) return false;

            if ($subItem->type === 'truefalse') {
                $correct = (bool) $subItem->answers->first()?->boolean_answer;
                if ((bool) $student['boolean'] !== $correct) return false;
            }

            if ($subItem->type === 'short_answer') {
                $normalized = $student['normalized'] ?? null;
                $valid = $subItem->answers
                    ->pluck('answer_text')
                    ->map(fn ($v) => Str::lower(trim($v)))
                    ->contains($normalized);

                if (!$valid) return false;
            }
        }

        return true;
    }

    protected function checkShortAnswer(Question $question, $answer): bool
    {
        $normalized = $answer->normalized_short_answer;
        if (!$normalized) {
            return false;
        }

        // STANDALONE SHORT ANSWER
        if ($question->subItems->isEmpty()) {
            return $question->options
                ->pluck('option_text')
                ->map(fn ($v) => Str::lower(trim($v)))
                ->contains($normalized);
        }

        // FALLBACK (kalau suatu saat short_answer pakai subItem)
        return $question->subItems
            ->flatMap(fn ($s) => $s->answers)
            ->pluck('answer_text')
            ->map(fn ($v) => Str::lower(trim($v)))
            ->contains($normalized);
    }

    protected function getTkpScore(Question $question, $answer): int
    {
        $selected = $answer->selected_ids;
        if (empty($selected)) return 0;

        return (int) $question->options
            ->whereIn('id', $selected)
            ->sum('weight');
    }

    protected function result(int|float $score, int $correct, int $wrong): array
    {
        return [
            'score'   => max(0, $score),
            'correct' => $correct,
            'wrong'   => $wrong,
            'total'   => $correct + $wrong,
        ];
    }

    /**
     * fallback
     */
    protected function scoreDefault(ExamAttempt $attempt): array
    {
        return $this->scoreScaled($attempt, true);
    }
}
