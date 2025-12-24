<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Course;

class CoursePolicy
{
    public function view(User $user, Course $course): bool
    {
        if (! $user->hasRole('siswa')) {
            return true;
        }

        return $user->hasCourse($course->id);
    }
}
