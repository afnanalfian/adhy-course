<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Productable;
use App\Models\Course;
use App\Models\Meeting;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /**
         * ===============================
         * PRODUCT UNTUK COURSE
         * ===============================
         */
        Course::each(function (Course $course) {

            $product = Product::create([
                'type'        => 'course_package',
                'name'        => 'Paket Course ' . $course->name,
                'description' => 'Akses penuh semua meeting pada course ' . $course->name,
                'is_active'   => true,
            ]);

            Productable::create([
                'product_id'       => $product->id,
                'productable_type' => Course::class,
                'productable_id'   => $course->id,
            ]);
        });

        /**
         * ===============================
         * PRODUCT UNTUK MEETING
         * ===============================
         */
        Meeting::each(function (Meeting $meeting) {

            $product = Product::create([
                'type'        => 'meeting',
                'name'        => 'Meeting: ' . $meeting->title,
                'description' => 'Akses untuk meeting ' . $meeting->title,
                'is_active'   => true,
            ]);

            Productable::create([
                'product_id'       => $product->id,
                'productable_type' => Meeting::class,
                'productable_id'   => $meeting->id,
            ]);
        });
    }
}
