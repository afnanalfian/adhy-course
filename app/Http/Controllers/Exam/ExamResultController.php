<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;

class ExamResultController extends Controller
{
    /**
     * ===============================
     * ADMIN / TENTOR RESULT
     * ===============================
     * Ranking + analisis soal
     */
    public function admin(Exam $exam)
    {
        // Load dengan relationships yang lengkap untuk semua tipe soal
        $exam->load([
            'questions.question.options',
            'questions.question.subItems' => function ($query) {
                $query->orderBy('order');
            },
            'questions.question.subItems.answers',
            'attempts.user',
            'attempts.answers',
        ]);

        // hanya attempt yang sudah submit
        $attempts = $exam->attempts
            ->where('is_submitted', true)
            ->sortByDesc('score')
            ->values();

        // ===============================
        // HITUNG STATISTIK PER SOAL
        // ===============================
        $questionStats = [];

        foreach ($exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $questionId = $question->id;

            $total = 0;
            $correct = 0;

            foreach ($attempts as $attempt) {
                $answer = $attempt->answers
                    ->firstWhere('question_id', $questionId);

                if (!$answer) {
                    continue;
                }

                $total++;

                if ($answer->is_correct) {
                    $correct++;
                }
            }

            $questionStats[$questionId] = [
                'question' => $question,
                'total'   => $total,
                'correct' => $correct,
                'accuracy' => $total > 0 ? round(($correct / $total) * 100, 1) : 0,
                'type' => $question->type,
            ];
        }

        // ===============================
        // STATISTIK PER TIPE SOAL
        // ===============================
        $typeStats = [];
        $typeBreakdown = [
            'mcq' => ['total' => 0, 'correct' => 0],
            'mcma' => ['total' => 0, 'correct' => 0],
            'truefalse' => ['total' => 0, 'correct' => 0],
            'short_answer' => ['total' => 0, 'correct' => 0],
            'compound' => ['total' => 0, 'correct' => 0],
        ];

        foreach ($attempts as $attempt) {
            $attempt->load('answers');
            $scoreByType = $attempt->getScoreByType();

            foreach ($scoreByType as $type => $data) {
                if (!isset($typeStats[$type])) {
                    $typeStats[$type] = [
                        'total_questions' => 0,
                        'total_correct' => 0,
                        'attempts' => 0,
                    ];
                }

                $typeStats[$type]['total_questions'] += $data['total'];
                $typeStats[$type]['total_correct'] += $data['correct'];
                $typeStats[$type]['attempts']++;
            }

            // Untuk breakdown per tipe
            foreach ($attempt->answers as $answer) {
                $question = $exam->questions->firstWhere('question_id', $answer->question_id)?->question;
                if ($question && isset($typeBreakdown[$question->type])) {
                    $typeBreakdown[$question->type]['total']++;
                    if ($answer->is_correct) {
                        $typeBreakdown[$question->type]['correct']++;
                    }
                }
            }
        }

        // Hitung persentase per tipe
        foreach ($typeBreakdown as $type => &$data) {
            $data['accuracy'] = $data['total'] > 0
                ? round(($data['correct'] / $data['total']) * 100, 1)
                : 0;
        }

        return view('exams.result-admin', compact(
            'exam',
            'attempts',
            'questionStats',
            'typeStats',
            'typeBreakdown'
        ));
    }

    /**
     * ===============================
     * SISWA RESULT
     * ===============================
     * Jawaban + pembahasan
     */
    public function student(Exam $exam)
    {
        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', true)
            ->firstOrFail();

        // Load dengan semua relationships yang dibutuhkan
        $exam->load([
            'questions' => function ($query) {
                $query->orderBy('order');
            },
            'questions.question.options',
            'questions.question.subItems' => function ($query) {
                $query->orderBy('order');
            },
            'questions.question.subItems.answers',
        ]);

        // Load answers dengan question untuk akses yang mudah
        $attempt->load([
            'answers.question',
            'answers.question.options',
            'answers.question.subItems' => function ($query) {
                $query->orderBy('order');
            },
            'answers.question.subItems.answers',
        ]);

        // Group questions by type untuk display yang lebih terorganisir
        $questionsByType = [
            'mcq' => collect(),
            'mcma' => collect(),
            'truefalse' => collect(),
            'short_answer' => collect(),
            'compound' => collect(),
        ];

        foreach ($exam->questions as $examQuestion) {
            $question = $examQuestion->question;
            $answer = $attempt->answers->firstWhere('question_id', $question->id);

            // Cek jika key type ada
            if (isset($questionsByType[$question->type])) {
                $questionsByType[$question->type]->push([
                    'question' => $question,
                    'exam_question' => $examQuestion,
                    'answer' => $answer,
                    'is_correct' => $answer ? $answer->is_correct : false,
                ]);
            }
        }

        // Hitung score breakdown per tipe
        $scoreByType = $attempt->getScoreByType();

        // Format data untuk compound questions
        $compoundQuestions = [];
        if (isset($questionsByType['compound']) && $questionsByType['compound']->isNotEmpty()) {
            foreach ($questionsByType['compound'] as $index => $compoundData) {
                $question = $compoundData['question'];
                $answer = $compoundData['answer'];

                $formattedSubItems = [];
                if ($question->subItems) {
                    foreach ($question->subItems as $subItem) {
                        $subAnswer = $answer ? $answer->getCompoundAnswerBySubId($subItem->id) : null;
                        $correctAnswer = $this->getCorrectAnswerForSubItem($subItem);

                        $formattedSubItems[] = [
                            'subItem' => $subItem,
                            'studentAnswer' => $subAnswer,
                            'correctAnswer' => $correctAnswer,
                            'isCorrect' => $this->isSubItemAnswerCorrect($subItem, $subAnswer),
                        ];
                    }
                }

                $compoundQuestions[] = [
                    'question' => $question,
                    'answer' => $answer,
                    'subItems' => $formattedSubItems,
                    'is_correct' => collect($formattedSubItems)->every(fn($i) => $i['isCorrect']),
                ];
            }
        }

        return view('exams.result-student', compact(
            'exam',
            'attempt',
            'questionsByType',
            'scoreByType',
            'compoundQuestions'
        ));
    }

    /**
     * Helper: Get correct answer for sub-item
     */
    private function getCorrectAnswerForSubItem($subItem): ?array
    {
        if ($subItem->type === 'truefalse') {
            $answer = $subItem->answers->first();
            return $answer ? ['boolean' => (bool) $answer->boolean_answer] : null;
        }

        if ($subItem->type === 'short_answer') {
            $answers = $subItem->answers->map(function ($ans) {
                return $ans->answer_text;
            })->toArray();

            $primaryAnswer = $subItem->answers->where('is_primary', true)->first();

            return [
                'answers' => $answers,
                'primary' => $primaryAnswer ? $primaryAnswer->answer_text : null,
            ];
        }

        return null;
    }

    /**
     * Helper: Check if sub-item answer is correct
     */
    private function isSubItemAnswerCorrect($subItem, ?array $studentAnswer): bool
    {
        if (!$studentAnswer) {
            return false;
        }

        if ($subItem->type === 'truefalse') {
            $correctAnswer = $subItem->answers->first();
            if (!$correctAnswer) {
                return false;
            }

            $studentBoolean = $studentAnswer['boolean'] ?? null;
            return $studentBoolean === (bool) $correctAnswer->boolean_answer;
        }

        if ($subItem->type === 'short_answer') {
            $studentValue = $studentAnswer['normalized'] ?? $studentAnswer['value'] ?? null;
            if (!$studentValue) {
                return false;
            }

            $studentValue = strtolower(trim(preg_replace('/\s+/', ' ', $studentValue)));

            foreach ($subItem->answers as $correctAnswer) {
                $correctValue = strtolower(trim(preg_replace('/\s+/', ' ', $correctAnswer->answer_text ?? '')));
                if ($studentValue === $correctValue) {
                    return true;
                }
            }

            return false;
        }

        return false;
    }

    /**
     * ===============================
     * DETAILED QUESTION ANALYSIS
     * ===============================
     * Untuk melihat detail jawaban per soal
     */
    public function questionAnalysis(Exam $exam, $questionId)
    {
        $exam->load([
            'questions.question.options',
            'questions.question.subItems.answers',
            'attempts.user',
            'attempts.answers',
        ]);

        $examQuestion = $exam->questions->firstWhere('question_id', $questionId);
        abort_if(!$examQuestion, 404);

        $question = $examQuestion->question;

        // Get all attempts with answers for this question
        $attemptsWithAnswers = [];

        foreach ($exam->attempts->where('is_submitted', true) as $attempt) {
            $answer = $attempt->answers->firstWhere('question_id', $questionId);

            if ($answer) {
                $attemptsWithAnswers[] = [
                    'attempt' => $attempt,
                    'answer' => $answer,
                    'is_correct' => $answer->is_correct,
                ];
            }
        }

        // Analyze answer patterns for multiple choice
        $optionStats = [];
        if (in_array($question->type, ['mcq', 'mcma', 'truefalse'])) {
            foreach ($question->options as $option) {
                $optionStats[$option->id] = [
                    'option' => $option,
                    'count' => 0,
                    'percentage' => 0,
                ];
            }

            foreach ($attemptsWithAnswers as $item) {
                $selectedIds = $item['answer']->selected_ids;
                foreach ($selectedIds as $id) {
                    if (isset($optionStats[$id])) {
                        $optionStats[$id]['count']++;
                    }
                }
            }

            $totalAnswers = count($attemptsWithAnswers);
            foreach ($optionStats as $id => &$stat) {
                $stat['percentage'] = $totalAnswers > 0
                    ? round(($stat['count'] / $totalAnswers) * 100, 1)
                    : 0;
            }
        }

        // Analyze short answer responses
        $shortAnswerResponses = [];
        if ($question->type === 'short_answer') {
            foreach ($attemptsWithAnswers as $item) {
                $value = $item['answer']->short_answer_value;
                if ($value) {
                    $shortAnswerResponses[] = [
                        'user' => $item['attempt']->user->name,
                        'answer' => $value,
                        'is_correct' => $item['is_correct'],
                    ];
                }
            }
        }

        // Analyze compound sub-item responses
        $compoundSubStats = [];
        if ($question->type === 'compound') {
            foreach ($question->subItems as $subItem) {
                $compoundSubStats[$subItem->id] = [
                    'subItem' => $subItem,
                    'total' => 0,
                    'correct' => 0,
                ];
            }

            foreach ($attemptsWithAnswers as $item) {
                foreach ($question->subItems as $subItem) {
                    $compoundSubStats[$subItem->id]['total']++;

                    $studentAnswer = $item['answer']->getCompoundAnswerBySubId($subItem->id);
                    if ($this->isSubItemAnswerCorrect($subItem, $studentAnswer)) {
                        $compoundSubStats[$subItem->id]['correct']++;
                    }
                }
            }

            foreach ($compoundSubStats as $subId => &$stat) {
                $stat['accuracy'] = $stat['total'] > 0
                    ? round(($stat['correct'] / $stat['total']) * 100, 1)
                    : 0;
            }
        }
        $attemptsWithAnswers = collect($attemptsWithAnswers);
        return view('exams.question-analysis', compact(
            'exam',
            'question',
            'attemptsWithAnswers',
            'optionStats',
            'shortAnswerResponses',
            'compoundSubStats'
        ));
    }
}
