<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckExamPause
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        
        // Hanya untuk user yang login
        if (!auth()->check()) {
            return $response;
        }
        
        // Cek jika route memiliki parameter 'exam'
        $exam = $request->route('exam');
        if (!$exam) {
            return $response;
        }
        
        // Cek jika user sedang mengerjakan exam
        $attempt = $exam->attempts()
            ->where('user_id', auth()->id())
            ->where('is_submitted', false)
            ->first();
            
        // Auto-pause jika exam sedang berjalan dan belum di-pause
        if ($attempt && !$attempt->isPaused() && $attempt->hasStarted()) {
            // Cek apakah request dari refresh atau navigasi (GET request)
            if ($request->method() === 'GET') {
                $attempt->pause();
                
                // Log untuk debugging
                Log::info('Exam auto-paused', [
                    'attempt_id' => $attempt->id,
                    'user_id' => auth()->id(),
                    'exam_id' => $exam->id,
                    'url' => $request->fullUrl()
                ]);
            }
        }
        
        return $response;
    }
}