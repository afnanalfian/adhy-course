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
        $exam->load([
            'questions.question.options',
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

            $questionId = $examQuestion->question_id;

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
                'total'   => $total,
                'correct' => $correct,
            ];
        }

        return view('exams.result-admin', compact(
            'exam',
            'attempts',
            'questionStats'
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

        $exam->load([
            'questions.question.options',
        ]);

        return view('exams.result-student', compact(
            'exam',
            'attempt'
        ));
    }
}
