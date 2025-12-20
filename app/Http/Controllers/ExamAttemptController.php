<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;
use App\Services\ExamScoringService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ExamAttemptController extends Controller
{
    public function start(Exam $exam)
    {
        if (!$exam->isActive()) {
            abort(403, 'Ujian belum aktif');
        }

        if (!$exam->hasTimeWindow()) {
            abort(403, 'Ujian belum tersedia saat ini');
        }

        $attempt = $exam->attempts()
            ->firstOrCreate(
                ['user_id' => auth()->id()],
                [
                    'started_at' => now(),
                    'duration_seconds' => $exam->duration_minutes * 60,
                ]
            );

        // kalau sudah submit → dilarang
        if ($attempt->is_submitted) {
            abort(403, 'Ujian sudah disubmit');
        }

        return redirect()
            ->route('exams.attempt', $exam);
    }
    protected function forceSubmit(ExamAttempt $attempt)
    {
        if ($attempt->is_submitted) return;

        $result = app(ExamScoringService::class)
            ->scoreAttempt($attempt);

        $attempt->update([
            'is_submitted'   => true,
            'submitted_at'   => now(),
            'score'          => $result['score'],
            'correct_count'  => $result['correct'],
            'wrong_count'    => $result['wrong'],
        ]);
    }
    public function attempt(Exam $exam)
    {
        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->firstOrFail();

        if ($attempt->isExpired()) {
            $this->forceSubmit($attempt);

            return redirect()
                ->route('exams.result.student', $exam)
                ->with('info', 'Waktu ujian telah habis');
        }

        $questions = $exam->questions()
            ->with('question.options')
            ->orderBy('order')
            ->get();

        return view('exams.attempt', compact(
            'exam',
            'attempt',
            'questions'
        ));
    }

    public function submit(Exam $exam, ExamScoringService $scoring)
    {
        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', false)
            ->firstOrFail();
        if ($attempt->is_submitted) {
            return redirect()->route('exams.result.student', $exam);
        }

        if (!$exam->isActive()) {
            abort(403);
        }

        $result = $scoring->scoreAttempt($attempt);

        $attempt->update([
            'is_submitted'   => true,
            'submitted_at'   => now(),
            'score'          => $result['score'],
            'correct_count'  => $result['correct'],
            'wrong_count'    => $result['wrong'],
        ]);

        return redirect()
            ->route('exams.result.student', $exam);
    }

    public function saveAnswer(Request $request, Exam $exam)
    {
        if (!$exam->isActive()) {
            abort(403);
        }

        $request->validate([
            'question_id'       => 'required|integer',
            'selected_options'  => 'array',
            'selected_options.*'=> 'integer',
        ]);

        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', false)
            ->firstOrFail();

        // waktu habis → autosubmit
        if ($attempt->isExpired()) {
            $this->forceSubmit($attempt);
            return response()->json(['expired' => true], 403);
        }

        // pastikan soal milik exam
        $examQuestion = $exam->questions()
            ->where('question_id', $request->question_id)
            ->with('question.options')
            ->first();

        abort_unless($examQuestion, 403);

        // filter option hanya milik soal
        $validOptionIds = $examQuestion->question
            ->options
            ->pluck('id')
            ->toArray();

        $selected = array_values(array_intersect(
            $request->selected_options ?? [],
            $validOptionIds
        ));

        // simpan
        $attempt->answers()->updateOrCreate(
            ['question_id' => $request->question_id],
            ['selected_options' => $selected]
        );

        return response()->noContent();
    }

}
