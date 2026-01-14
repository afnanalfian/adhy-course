<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamQuestion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExamResultController extends Controller
{
    /**
     * ======================================================
     * 1. ADMIN - RESULT EXAM
     * ======================================================
     */
    public function adminResult(Exam $exam, Request $request)
    {
        $perPage = $request->integer('per_page', 20);

        // ========================
        // AGREGASI
        // ========================
        $attemptsQuery = ExamAttempt::with('user')
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true);

        $totalParticipants = $attemptsQuery->count();

        $averageScore = round($attemptsQuery->avg('score'), 2);
        $maxScore     = $attemptsQuery->max('score');
        $minScore     = $attemptsQuery->min('score');

        // ========================
        // RANKING (TRYOUT ONLY)
        // ========================
        $ranking = null;

        $rankingQuery = ExamAttempt::with('user')
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true);

        if (
            $exam->type === 'tryout' &&
            in_array($exam->test_type, ['skd', 'mtk_stis'])
        ) {
            // Lulus dulu, baru score
            $rankingQuery
                ->orderByDesc('is_passed')
                ->orderByDesc('score');
        } else {
            // Semua exam lain
            $rankingQuery->orderByDesc('score');
        }

        $ranking = $rankingQuery
            ->get()
            ->values()
            ->map(function ($attempt, $index) {
                $attempt->rank = $index + 1;
                return $attempt;
            });

        // ========================
        // SOAL + AKURASI
        // ========================
        $questions = ExamQuestion::with('question')
            ->where('exam_id', $exam->id)
            ->paginate($perPage);

        $questionStats = [];

        foreach ($questions as $examQuestion) {
            $qid = $examQuestion->question_id;

            $totalAnswered = DB::table('exam_answers')
                ->join('exam_attempts', 'exam_answers.attempt_id', '=', 'exam_attempts.id')
                ->where('exam_attempts.exam_id', $exam->id)
                ->where('exam_answers.question_id', $qid)
                ->whereNotNull('exam_answers.selected_options')
                ->count();

            $totalCorrect = DB::table('exam_answers')
                ->join('exam_attempts', 'exam_answers.attempt_id', '=', 'exam_attempts.id')
                ->where('exam_attempts.exam_id', $exam->id)
                ->where('exam_answers.question_id', $qid)
                ->where('exam_answers.is_correct', true)
                ->count();

            $questionStats[$qid] = [
                'answered' => $totalAnswered,
                'correct'  => $totalCorrect,
                'accuracy' => $totalAnswered > 0
                    ? round(($totalCorrect / $totalAnswered) * 100, 2)
                    : 0,
            ];
        }

        return view('exams.results.admin', compact(
            'exam',
            'totalParticipants',
            'averageScore',
            'maxScore',
            'minScore',
            'ranking',
            'questions',
            'questionStats',
            'perPage'
        ));
    }

    /**
     * ======================================================
     * 2. ADMIN - ANALISIS SOAL
     * ======================================================
     */
    public function adminQuestionAnalysis(Exam $exam, ExamQuestion $examQuestion)
    {
        $question = $examQuestion->question;

        $attempts = ExamAttempt::with(['user', 'answers' => function ($q) use ($question) {
                $q->where('question_id', $question->id);
            }])
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true)
            ->get();

        $summary = [
            'correct' => 0,
            'wrong'   => 0,
            'empty'   => 0,
        ];

        foreach ($attempts as $attempt) {
            $answer = $attempt->answers->first();

            if (!$answer || $answer->isEmpty) {
                $summary['empty']++;
            } elseif ($answer->is_correct) {
                $summary['correct']++;
            } else {
                $summary['wrong']++;
            }
        }

        return view('exams.results.analysis', compact(
            'exam',
            'examQuestion',
            'question',
            'attempts',
            'summary'
        ));
    }

    /**
     * ======================================================
     * 3. SISWA - RESULT PRIBADI
     * ======================================================
     */
    public function studentResult(Exam $exam, Request $request)
    {
        $perPage = $request->integer('per_page', 20);

        $attempt = ExamAttempt::with('answers')
            ->where('exam_id', $exam->id)
            ->where('user_id', auth()->id())
            ->where('is_submitted', true)
            ->firstOrFail();

        $duration = optional($attempt->submitted_at)
            ->diffInSeconds($attempt->started_at);

        $questions = ExamQuestion::with('question')
            ->where('exam_id', $exam->id)
            ->paginate($perPage);

        return view('exams.results.student', compact(
            'exam',
            'attempt',
            'duration',
            'questions',
            'perPage'
        ));
    }

    /**
     * ======================================================
     * 4. SISWA - PERINGKAT
     * ======================================================
     */
    public function studentRanking(Exam $exam)
    {
        $query = ExamAttempt::with('user')
            ->where('exam_id', $exam->id)
            ->where('is_submitted', true);

        // ============================
        // SORTING LOGIC
        // ============================
        if (
            $exam->type === 'tryout' &&
            in_array($exam->test_type, ['skd', 'mtk_stis'])
        ) {
            // Lulus dulu, baru score
            $query->orderByDesc('is_passed')
                ->orderByDesc('score');
        } else {
            // Semua exam lain
            $query->orderByDesc('score');
        }

        $attempts = $query
            ->get()
            ->values()
            ->map(function ($attempt, $index) {
                $attempt->rank = $index + 1;
                return $attempt;
            });

        $myAttempt = $attempts->firstWhere('user_id', auth()->id());

        return view('exams.results.ranking', [
            'exam'        => $exam,
            'attempts'    => $attempts,
            'myAttemptId' => optional($myAttempt)->id,
            'myRank'      => optional($myAttempt)->rank,
        ]);
    }

}
