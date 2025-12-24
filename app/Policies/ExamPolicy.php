<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exam;

class ExamPolicy
{
    public function view(User $user, Exam $exam): bool
    {
        if (! $user->hasRole('siswa')) {
            return true;
        }
        return match ($exam->type) {

            // Tryout → global
            'tryout' => $user->hasTryoutAccess(),

            // Quiz harian → global
            'quiz'   => $user->hasQuizAccess(),

            default  => false,
        };
    }
}
