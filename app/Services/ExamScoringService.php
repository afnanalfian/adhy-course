<?php

namespace App\Services;

use App\Models\ExamAttempt;
use App\Models\Question;
use Illuminate\Support\Str;

class ExamScoringService
{
    /**
     * ============================
     * CHECK MULTIPLE CHOICE (MCQ/MCMA/TrueFalse)
     * ============================
     */
    protected function checkMultipleChoice(
        Question $question,
        array $selectedOptions
    ): bool {
        $selectedIds = $selectedOptions['mcq_answers'] ?? [];

        $correctIds = $question->options
            ->where('is_correct', true)
            ->pluck('id')
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values()
            ->toArray();

        $selectedIds = collect($selectedIds)
            ->map(fn ($id) => (int) $id)
            ->sort()
            ->values()
            ->toArray();

        return match ($question->type) {
            'mcq', 'truefalse' =>
                count($selectedIds) === 1 &&
                $selectedIds[0] === ($correctIds[0] ?? null),

            'mcma' =>
                $selectedIds === $correctIds,

            default => false
        };
    }

    /**
     * ============================
     * CHECK SHORT ANSWER
     * ============================
     */
    protected function checkShortAnswer(
        Question $question,
        array $selectedOptions
    ): bool {
        $studentAnswer = $selectedOptions['normalized'] ?? null;

        if (empty($studentAnswer)) {
            return false;
        }

        // Get all possible correct answers from sub_items
        $correctAnswers = $this->getShortAnswerCorrectValues($question);

        // Check if student answer matches any of the correct answers
        foreach ($correctAnswers as $correct) {
            if ($studentAnswer === $correct) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get all normalized correct answers for short_answer question
     */
    private function getShortAnswerCorrectValues(Question $question): array
    {
        $values = [];

        if ($question->isShortAnswer() && $question->subItems->count() > 0) {
            $subItem = $question->subItems->first();
            $values = $subItem->answers
                ->map(function ($answer) {
                    return Str::lower(trim(preg_replace('/\s+/', ' ', $answer->answer_text ?? '')));
                })
                ->filter()
                ->values()
                ->toArray();
        }

        return $values;
    }

    /**
     * ============================
     * CHECK COMPOUND QUESTION
     * ============================
     */
    protected function checkCompound(
        Question $question,
        array $selectedOptions
    ): bool {
        $studentAnswers = $selectedOptions['answers'] ?? [];

        if (empty($studentAnswers)) {
            return false;
        }

        // Group student answers by sub_id for easy lookup
        $studentAnswersBySubId = [];
        foreach ($studentAnswers as $answer) {
            $subId = $answer['sub_id'] ?? null;
            if ($subId !== null) {
                $studentAnswersBySubId[$subId] = $answer;
            }
        }

        // Check each sub-item
        foreach ($question->subItems as $subItem) {
            $studentAnswer = $studentAnswersBySubId[$subItem->id] ?? null;

            if (!$studentAnswer) {
                return false; // Missing answer for a sub-item
            }

            $isSubCorrect = $this->checkSubItemAnswer($subItem, $studentAnswer);

            if (!$isSubCorrect) {
                return false; // One wrong = whole question wrong
            }
        }

        return true;
    }

    /**
     * Check individual sub-item answer
     */
    private function checkSubItemAnswer($subItem, array $studentAnswer): bool
    {
        return match ($subItem->type) {
            'truefalse' => $this->checkTrueFalseSubItem($subItem, $studentAnswer),
            'short_answer' => $this->checkShortAnswerSubItem($subItem, $studentAnswer),
            default => false
        };
    }

    /**
     * Check truefalse sub-item
     */
    private function checkTrueFalseSubItem($subItem, array $studentAnswer): bool
    {
        $studentBoolean = $studentAnswer['boolean'] ?? null;

        if ($studentBoolean === null) {
            return false;
        }

        $correctAnswer = $subItem->answers->first();
        if (!$correctAnswer) {
            return false;
        }

        return $studentBoolean === (bool) $correctAnswer->boolean_answer;
    }

    /**
     * Check short_answer sub-item
     */
    private function checkShortAnswerSubItem($subItem, array $studentAnswer): bool
    {
        $studentValue = $studentAnswer['normalized'] ?? null;

        if (empty($studentValue)) {
            return false;
        }

        // Get all possible correct answers for this sub-item
        $correctAnswers = $subItem->answers
            ->map(function ($answer) {
                return Str::lower(trim(preg_replace('/\s+/', ' ', $answer->answer_text ?? '')));
            })
            ->filter()
            ->values()
            ->toArray();

        // Check if student answer matches any correct answer
        foreach ($correctAnswers as $correct) {
            if ($studentValue === $correct) {
                return true;
            }
        }

        return false;
    }

    /**
     * ============================
     * MAIN SCORING METHOD
     * ============================
     */
    public function scoreAttempt(ExamAttempt $attempt): array
    {
        // Load all necessary relationships
        $attempt->load([
            'exam.questions.question.options',
            'exam.questions.question.subItems.answers',
            'answers',
        ]);

        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer = $attempt->answers->firstWhere('question_id', $question->id);

            if (!$answer || empty($answer->selected_options)) {
                $wrong++;
                $answer?->update(['is_correct' => false]);
                continue;
            }

            $isCorrect = $this->evaluateAnswer($question, $answer->selected_options ?? []);

            $answer->update(['is_correct' => $isCorrect]);
            $isCorrect ? $correct++ : $wrong++;
        }

        $score = round(($correct / max(1, $correct + $wrong)) * 100);

        return [
            'score' => $score,
            'correct' => $correct,
            'wrong' => $wrong,
            'total' => $correct + $wrong,
        ];
    }

    /**
     * Evaluate answer based on question type
     */
    private function evaluateAnswer(Question $question, array $selectedOptions): bool
    {
        $answerType = $selectedOptions['type'] ?? null;

        if (!$answerType) {
            return false;
        }

        return match ($answerType) {
            'mcq', 'mcma', 'truefalse' => $this->checkMultipleChoice($question, $selectedOptions),
            'short_answer' => $this->checkShortAnswer($question, $selectedOptions),
            'compound' => $this->checkCompound($question, $selectedOptions),
            default => false
        };
    }

    /**
     * Get detailed breakdown for debugging
     */
    public function getDetailedScoring(ExamAttempt $attempt): array
    {
        $attempt->load([
            'exam.questions.question.options',
            'exam.questions.question.subItems.answers',
            'answers',
        ]);

        $details = [];

        foreach ($attempt->exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer = $attempt->answers->firstWhere('question_id', $question->id);

            $details[] = [
                'question_id' => $question->id,
                'question_type' => $question->type,
                'answer_type' => $answer->answer_type ?? null,
                'is_correct' => $answer->is_correct ?? false,
                'selected_options' => $answer->selected_options ?? null,
            ];
        }

        return $details;
    }
}
