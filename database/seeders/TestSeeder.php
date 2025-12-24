<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\Product;
use App\Models\Productable;
use Carbon\Carbon;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Course "Kimia"
        $course = Course::create([
            'name' => 'Kimia',
            'slug' => Str::slug('Kimia'),
            'thumbnail' => null,
            'description' => 'Course Kimia dasar untuk siswa SMA',
        ]);

        // 2. Jadikan Course sebagai Product
        $courseProduct = Product::create([
            'type' => 'course_package',
            'name' => $course->name,
            'description' => $course->description,
            'is_active' => true,
        ]);

        Productable::create([
            'product_id' => $courseProduct->id,
            'productable_id' => $course->id,
            'productable_type' => Course::class,
        ]);

        // 3. Buat 20 Meetings untuk course ini
        for ($i = 1; $i <= 20; $i++) {
            $meeting = Meeting::create([
                'course_id' => $course->id,
                'title' => "Pertemuan $i - Kimia",
                'slug' => Str::slug("kimia-meeting-$i"),
                'scheduled_at' => Carbon::now()->addDays($i),
                'started_at' => null,
                'zoom_link' => "https://zoom.us/j/kimia-$i",
                'status' => 'upcoming',
                'created_by' => null, // bisa diisi user_id tentor/admin
            ]);

            // 4. Jadikan setiap Meeting sebagai Product
            $meetingProduct = Product::create([
                'type' => 'meeting',
                'name' => $meeting->title,
                'description' => "Produk untuk {$meeting->title}",
                'is_active' => true,
            ]);

            Productable::create([
                'product_id' => $meetingProduct->id,
                'productable_id' => $meeting->id,
                'productable_type' => Meeting::class,
            ]);
        }
    }
}
