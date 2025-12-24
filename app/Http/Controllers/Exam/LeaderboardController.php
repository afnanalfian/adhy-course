<?php

namespace App\Http\Controllers\Exam;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Exam;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $leaderboard = User::role('siswa')
            ->select('users.id', 'users.name')

            // POST TEST
            ->selectSub(function ($q) {
                $q->from('exam_attempts')
                ->join('exams', 'exams.id', '=', 'exam_attempts.exam_id')
                ->whereColumn('exam_attempts.user_id', 'users.id')
                ->where('exams.type', 'post_test')
                ->where('exam_attempts.is_submitted', true)
                ->selectRaw('AVG(score)');
            }, 'post_test_avg')

            // QUIZ
            ->selectSub(function ($q) {
                $q->from('exam_attempts')
                ->join('exams', 'exams.id', '=', 'exam_attempts.exam_id')
                ->whereColumn('exam_attempts.user_id', 'users.id')
                ->where('exams.type', 'quiz')
                ->where('exam_attempts.is_submitted', true)
                ->selectRaw('AVG(score)');
            }, 'quiz_avg')

            // TRYOUT
            ->selectSub(function ($q) {
                $q->from('exam_attempts')
                ->join('exams', 'exams.id', '=', 'exam_attempts.exam_id')
                ->whereColumn('exam_attempts.user_id', 'users.id')
                ->where('exams.type', 'tryout')
                ->where('exam_attempts.is_submitted', true)
                ->selectRaw('AVG(score)');
            }, 'tryout_avg')

            ->get()
            ->map(function ($row) {
                $post  = $row->post_test_avg ?? 0;
                $quiz  = $row->quiz_avg ?? 0;
                $tryout = $row->tryout_avg ?? 0;

                $row->total_avg = round(($post + $quiz + $tryout) / 3, 2);
                return $row;
            })
            ->sortByDesc('total_avg')
            ->values();

        return view('leaderboard.index', compact('leaderboard'));
    }
    public function detail()
    {
        return view('leaderboard.detail');
    }
    public function loadExams(Request $request)
    {
        $type = $request->type;

        $exams = Exam::with('owner')
            ->where('type', $type)
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($exam) use ($type) {
                return [
                    'id'    => $exam->id,
                    'title' => $type === 'post_test'
                        ? optional($exam->owner)->title ?? 'Post Test'
                        : $exam->title ?? 'Tanpa Judul',
                ];
            });

        return response()->json($exams);
    }

    public function loadRanking(Request $request)
    {
        $exam = Exam::findOrFail($request->exam_id);

        $attempts = $exam->attempts()
            ->where('is_submitted', true)
            ->with('user')
            ->orderByDesc('score')
            ->get();

        return view('leaderboard.partials.ranking-table', compact('exam', 'attempts'));
    }

}
