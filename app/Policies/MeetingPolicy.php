<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Meeting;

class MeetingPolicy
{
    public function view(User $user, Meeting $meeting): bool
    {
        if (! $user->hasRole('siswa')) {
            return true;
        }
        // 1. Beli course → semua meeting terbuka
        if ($meeting->course_id && $user->hasCourse($meeting->course_id)) {
            return true;
        }

        // 2. Beli meeting satuan
        return $user->hasEntitlement('meeting', $meeting->id);
    }
}
