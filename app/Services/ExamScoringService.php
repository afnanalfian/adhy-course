<?php

namespace App\Services;

use App\Models\ExamAttempt;

class ExamScoringService
{
    /**
     * ============================
     * CHECK PER QUESTION TYPE
     * ============================
     */
    protected function checkAnswer(
        string $type,
        $options,
        array $selectedIds
    ): bool {

        $correctIds = $options
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
        logger()->info('EXAM SCORING DEBUG', [
            'question_type' => $type,
            'correct_ids'   => $correctIds,
            'selected_ids'  => $selectedIds,
            'correct_types' => array_map('gettype', $correctIds),
            'selected_types'=> array_map('gettype', $selectedIds),
        ]);
        return match ($type) {

            'mcq', 'truefalse' =>
                count($selectedIds) === 1 &&
                $selectedIds[0] === ($correctIds[0] ?? null),

            'mcma' =>
                $selectedIds === $correctIds,

            default => false
        };
    }

    public function scoreAttempt(ExamAttempt $attempt): array
    {
        $attempt->load([
            'exam.questions.question.options',
            'answers',
        ]);

        $correct = 0;
        $wrong = 0;

        foreach ($attempt->exam->questions as $examQuestion) {

            $question = $examQuestion->question;

            $answer = $attempt->answers
                ->firstWhere('question_id', $question->id);

            if (!$answer || empty($answer->selected_options)) {
                $wrong++;
                $answer?->update(['is_correct' => false]);
                continue;
            }

            $isCorrect = $this->checkAnswer(
                $question->type,
                $question->options,
                $answer->selected_options
            );

            $answer->update([
                'is_correct' => $isCorrect
            ]);

            $isCorrect ? $correct++ : $wrong++;
        }

        $score = round(
            ($correct / max(1, $correct + $wrong)) * 100
        );

        return [
            'score' => $score,
            'correct' => $correct,
            'wrong' => $wrong,
        ];
    }
}
