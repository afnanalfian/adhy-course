<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class ExamResultController extends Controller
{
    /**
     * =========================================
     * ADMIN / TENTOR RESULT
     * =========================================
     */
    public function admin(Exam $exam)
    {
        $exam->load([
            'questions' => fn ($q) => $q->orderBy('order'),
            'questions.question.options',
            'questions.question.subItems.answers',
            'attempts.user',
            'attempts.answers',
        ]);

        $attempts = $exam->attempts
            ->where('is_submitted', true)
            ->sortByDesc('score')
            ->values();

        $totalParticipants = $attempts->count();

        $averageScore = round($attempts->avg('score') ?? 0, 2);
        $averageDuration = round($attempts->avg(fn ($a) => $a->work_duration_seconds));

        $ranking = $attempts->map(function ($attempt, $index) {
            return [
                'rank'     => $index + 1,
                'user'     => $attempt->user,
                'score'    => $attempt->score,
                'duration' => $attempt->work_duration_seconds,
            ];
        });

        // ===============================
        // QUESTION STATS (SORT FIRST!)
        // ===============================
        $questionStats = collect();

        foreach ($exam->questions as $examQuestion) {
            $question = $examQuestion->question;

            $total = 0;
            $correct = 0;

            foreach ($attempts as $attempt) {
                $answer = $attempt->answers
                    ->firstWhere('question_id', $question->id);

                if (!$answer) continue;

                $total++;
                if ($answer->is_correct) $correct++;
            }

            $accuracy = $total > 0
                ? round(($correct / $total) * 100, 1)
                : 0;

            $questionStats->push([
                'exam_order' => $examQuestion->order,
                'question'   => $question,
                'total'      => $total,
                'correct'    => $correct,
                'accuracy'   => $accuracy,
            ]);
        }

        // ⬇⬇ SORT DI SINI (SEBELUM PAGINATE)
        $questionStats = $questionStats
            ->sortBy('exam_order')
            ->values();

        // ===============================
        // PAGINATE (LAST STEP)
        // ===============================
        $page = request('page', 1);
        $perPage = 10;

        $questionStats = new LengthAwarePaginator(
            $questionStats->forPage($page, $perPage),
            $questionStats->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('exams.result-admin', [
            'exam'              => $exam,
            'totalParticipants' => $totalParticipants,
            'averageScore'      => $averageScore,
            'averageDuration'   => $averageDuration,
            'ranking'           => $ranking,
            'questionStats'     => $questionStats,
        ]);
    }

    /**
     * =========================================
     * STUDENT RESULT - PERBAIKAN totalParticipants
     * =========================================
     */
    public function student(Exam $exam)
    {
        // ===============================
        // ATTEMPT SISWA
        // ===============================
        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', true)
            ->firstOrFail();

        // ===============================
        // LOAD RELATIONS
        // ===============================
        $exam->load([
            'questions.question.options',
            'questions.question.subItems.answers',
        ]);

        $attempt->load([
            'answers.question.options',
            'answers.question.subItems.answers',
        ]);

        // ===============================
        // TOTAL PARTICIPANTS
        // ===============================
        $totalParticipants = $exam->attempts()
            ->where('is_submitted', true)
            ->count();

        // ===============================
        // RANKING (SCORE DESC, DURASI ASC)
        // ===============================
        $ranking = ExamAttempt::where('exam_id', $exam->id)
            ->where('is_submitted', true)
            ->get()
            ->sortBy([
                ['score', 'desc'],
                fn ($a, $b) =>
                    $a->started_at->diffInSeconds($a->submitted_at)
                    <=>
                    $b->started_at->diffInSeconds($b->submitted_at)
            ])
            ->values();

        $rankIndex = $ranking->search(fn ($a) => $a->id === $attempt->id);
        $rank = $rankIndex !== false ? $rankIndex + 1 : null;

        // ===============================
        // DURASI KERJA SISWA (FINAL)
        // ===============================
        $duration = $attempt->started_at && $attempt->submitted_at
            ? $attempt->started_at->diffInSeconds($attempt->submitted_at)
            : null;

        // ===============================
        // QUESTIONS + ANSWERS (DENGAN COMPOUND)
        // ===============================
        $questions = $exam->questions()
            ->orderBy('order')
            ->get()
            ->map(function ($examQuestion) use ($attempt) {
                $question = $examQuestion->question;
                $answer = $attempt->answers
                    ->firstWhere('question_id', $question->id);

                $data = [
                    'order'     => $examQuestion->order,
                    'question'  => $question,
                    'answer'    => $answer,
                    'is_correct'=> $answer?->is_correct ?? false,
                ];

                // compound handling (tetap seperti sebelumnya)
                if ($question->type === 'compound') {
                    $subItems = [];

                    foreach ($question->subItems as $subItem) {
                        $studentAnswer = $answer
                            ? $answer->getCompoundAnswerBySubId($subItem->id)
                            : null;

                        $isCorrect = false;
                        $correctAnswer = null;

                        if ($subItem->type === 'truefalse') {
                            $correctBool = (bool) optional($subItem->answers->first())->boolean_answer;

                            if ($studentAnswer) {
                                $isCorrect = (bool) ($studentAnswer['boolean'] ?? null) === $correctBool;
                            }

                            $correctAnswer = [
                                'primary' => $correctBool ? 'Benar' : 'Salah',
                            ];
                        }

                        if ($subItem->type === 'short_answer') {
                            if ($studentAnswer) {
                                $normalized = strtolower(trim($studentAnswer['normalized'] ?? ''));
                                $isCorrect = $subItem->answers
                                    ->pluck('answer_text')
                                    ->map(fn ($v) => strtolower(trim($v)))
                                    ->contains($normalized);
                            }

                            $correctAnswer = [
                                'answers' => $subItem->answers
                                    ->pluck('answer_text')
                                    ->toArray(),
                            ];
                        }

                        $subItems[] = [
                            'subItem'       => $subItem,
                            'studentAnswer' => $studentAnswer,
                            'isCorrect'     => $isCorrect,
                            'correctAnswer' => $correctAnswer, // ← SELALU ADA
                        ];
                    }

                    $data['subItems'] = $subItems;
                }

                return $data;
            });

        // ===============================
        // PAGINATION (10 SOAL)
        // ===============================
        $page    = request('page', 1);
        $perPage = 10;

        $questions = new LengthAwarePaginator(
            $questions->forPage($page, $perPage)->values(),
            $questions->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        // ===============================
        // RETURN VIEW
        // ===============================
        return view('exams.result-student', [
            'exam'              => $exam,
            'attempt'           => $attempt,
            'rank'              => $rank,
            'duration'          => $duration,
            'questions'         => $questions,
            'totalParticipants' => $totalParticipants,
        ]);
    }

    /**
     * =========================================
     * QUESTION ANALYSIS (ADMIN)
     * =========================================
     */
    public function questionAnalysis(Exam $exam, $questionId)
    {
        $exam->load([
            'questions.question.options',
            'questions.question.subItems.answers',
            'attempts.user',
            'attempts.answers',
        ]);

        $examQuestion = $exam->questions
            ->firstWhere('question_id', $questionId);

        abort_if(!$examQuestion, 404);

        $question = $examQuestion->question;

        $attempts = $exam->attempts
            ->where('is_submitted', true);

        /**
         * ===============================
         * ANSWERS + USER
         * ===============================
         */
        $answersWithUsers = $attempts->map(function ($attempt) use ($questionId) {
            $answer = $attempt->answers
                ->firstWhere('question_id', $questionId);

            if (!$answer) {
                return null;
            }

            return [
                'user'   => $attempt->user,
                'answer' => $answer,
            ];
        })->filter();

        /**
         * ===============================
         * OPTION STATS (MCQ / MCMA / TF)
         * ===============================
         */
        $optionStats = [];

        if (in_array($question->type, ['mcq', 'mcma', 'truefalse'])) {
            foreach ($question->options as $option) {
                $optionStats[$option->id] = [
                    'option'     => $option,
                    'count'      => 0,
                    'percentage' => 0,
                ];
            }

            foreach ($answersWithUsers as $row) {
                foreach ($row['answer']->selected_ids as $id) {
                    if (isset($optionStats[$id])) {
                        $optionStats[$id]['count']++;
                    }
                }
            }

            $total = $answersWithUsers->count();

            foreach ($optionStats as &$stat) {
                $stat['percentage'] = $total > 0
                    ? round(($stat['count'] / $total) * 100, 1)
                    : 0;
            }
        }

        /**
         * ===============================
         * SHORT ANSWER RESPONSES
         * ===============================
         */
        $shortAnswers = [];

        if ($question->type === 'short_answer') {
            foreach ($answersWithUsers as $row) {
                $shortAnswers[] = [
                    'user'       => $row['user'],
                    'answer'     => $row['answer']->short_answer_value,
                    'is_correct' => $row['answer']->is_correct,
                ];
            }
        }

        /**
         * ===============================
         * COMPOUND STATS (PER SUB ITEM)
         * ===============================
         */
        $compoundStats = [];

        if ($question->type === 'compound') {
            foreach ($question->subItems as $subItem) {
                $compoundStats[$subItem->id] = [
                    'subItem' => $subItem,
                    'total'   => 0,
                    'correct' => 0,
                    'accuracy'=> 0,
                ];
            }

            foreach ($answersWithUsers as $row) {
                $answer = $row['answer'];

                foreach ($question->subItems as $subItem) {
                    $compoundStats[$subItem->id]['total']++;

                    $student = $answer->getCompoundAnswerBySubId($subItem->id);
                    if (!$student) {
                        continue;
                    }

                    $isCorrect = false;

                    // TRUE / FALSE
                    if ($subItem->type === 'truefalse') {
                        $correct = (bool) $subItem->answers->first()?->boolean_answer;
                        $isCorrect = isset($student['boolean'])
                            && (bool) $student['boolean'] === $correct;
                    }

                    // SHORT ANSWER
                    if ($subItem->type === 'short_answer') {
                        $normalized = $student['normalized'] ?? null;

                        $isCorrect = $normalized && $subItem->answers
                            ->pluck('answer_text')
                            ->map(fn ($v) => strtolower(trim($v)))
                            ->contains($normalized);
                    }

                    if ($isCorrect) {
                        $compoundStats[$subItem->id]['correct']++;
                    }
                }
            }

            foreach ($compoundStats as &$stat) {
                $stat['accuracy'] = $stat['total'] > 0
                    ? round(($stat['correct'] / $stat['total']) * 100, 1)
                    : 0;
            }
        }

        return view('exams.question-analysis', [
            'exam'          => $exam,
            'question'      => $question,
            'answers'       => $answersWithUsers,
            'optionStats'   => $optionStats,
            'shortAnswers'  => $shortAnswers,
            'compoundStats' => $compoundStats,
        ]);
    }

}
