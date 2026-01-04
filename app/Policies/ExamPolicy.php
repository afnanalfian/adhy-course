<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Exam;
use App\Models\Meeting;

class ExamPolicy
{
    public function view(User $user, Exam $exam): bool
    {
        if (! $user->hasRole('siswa')) {
            return true;
        }

        return match ($exam->type) {

            // Tryout → global
            'tryout' => $user->hasTryoutAccess($exam->id),

            // Quiz harian → global
            'quiz'   => $user->hasQuizAccess(),

            // Post-test → ikut akses meeting
            'post_test' => $this->canAccessPostTest($user, $exam),

            default => false,
        };
    }

    protected function canAccessPostTest(User $user, Exam $exam): bool
    {
        if ($exam->type !== 'post_test') {
            return false;
        }

        /**
         * ======================================
         * 1. Resolve meeting dari exam owner
         * ======================================
         */
        $meeting = null;

        try {
            $meeting = $exam->owner;
        } catch (\Throwable $e) {
            $meeting = null;
        }

        if (! $meeting && $exam->owner_id) {
            $meeting = Meeting::find($exam->owner_id);
        }

        if (! $meeting instanceof Meeting) {
            return false;
        }

        /**
         * ======================================
         * 2. COURSE GRATIS → POST TEST GRATIS
         * ======================================
         */
        if ($meeting->course && $meeting->course->is_free) {
            return true;
        }

        /**
         * ======================================
         * 3. MEETING GRATIS → POST TEST GRATIS
         * ======================================
         */
        if ($meeting->is_free) {
            return true;
        }

        /**
         * ======================================
         * 4. BELI COURSE
         * ======================================
         */
        if ($meeting->course_id && $user->hasCourse($meeting->course_id)) {
            return true;
        }

        /**
         * ======================================
         * 5. BELI MEETING SATUAN
         * ======================================
         */
        return $user->hasEntitlement('meeting', $meeting->id);
    }

}

