<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\Course;
use App\Models\Meeting;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        $courses = [
            'Matematika Dasar',
            'Fisika SMA',
            'Bahasa Inggris'
        ];

        foreach ($courses as $courseName) {
            $course = Course::create([
                'name' => $courseName,
                'slug' => Str::slug($courseName),
                'description' => 'Deskripsi singkat ' . $courseName,
            ]);

            // 3 meetings per course
            for ($i = 1; $i <= 3; $i++) {
                Meeting::create([
                    'course_id'   => $course->id,
                    'title'       => "Meeting $i - $courseName",
                    'slug'        => Str::slug($courseName . '-meeting-' . $i),
                    'scheduled_at'=> Carbon::now()->addDays($i),
                    'status'      => 'upcoming',
                ]);
            }
        }
    }
}
