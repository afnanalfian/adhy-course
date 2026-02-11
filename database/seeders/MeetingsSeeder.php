<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class MeetingsSeeder extends Seeder
{
    public function run(): void
    {
        $meetings = [

            /*
            |--------------------------------------------------------------------------
            | KELAS 1 (course_id = 1)
            |--------------------------------------------------------------------------
            */
            // SABTU, 7 FEB 2026
            ['course_id'=>1,'title'=>'PEMBAHASAN TO TIU','date'=>'2026-02-07','time'=>'10:30'],
            ['course_id'=>1,'title'=>'PEMBAHASAN TO TWK','date'=>'2026-02-07','time'=>'14:30'],

            // SABTU, 14 FEB 2026
            ['course_id'=>1,'title'=>'PEMBAHASAN TO TKP','date'=>'2026-02-14','time'=>'09:00'],
            ['course_id'=>1,'title'=>'HIMPUNAN 3','date'=>'2026-02-14','time'=>'10:30'],
            ['course_id'=>1,'title'=>'BTI 3','date'=>'2026-02-14','time'=>'13:30'],
            ['course_id'=>1,'title'=>'HUBUNGAN X DAN Y 2','date'=>'2026-02-14','time'=>'14:30'],

            // SABTU, 21 FEB 2026
            ['course_id'=>1,'title'=>'TKP 9','date'=>'2026-02-21','time'=>'09:00'],
            ['course_id'=>1,'title'=>'HITUNG DAGANG 3','date'=>'2026-02-21','time'=>'10:30'],
            ['course_id'=>1,'title'=>'NASIONALISME 3','date'=>'2026-02-21','time'=>'13:30'],
            ['course_id'=>1,'title'=>'KEC JARAK WAKTU 3','date'=>'2026-02-21','time'=>'14:30'],

            // SABTU, 28 FEB 2026
            ['course_id'=>1,'title'=>'INTEGRITAS 3','date'=>'2026-02-28','time'=>'09:00'],
            ['course_id'=>1,'title'=>'SILOGISME 3','date'=>'2026-02-28','time'=>'10:30'],
            ['course_id'=>1,'title'=>'BHS INDO TWK 4','date'=>'2026-02-28','time'=>'13:30'],
            ['course_id'=>1,'title'=>'FIGURAL 3','date'=>'2026-02-28','time'=>'14:30'],

            /*
            |--------------------------------------------------------------------------
            | KELAS 2 (course_id = 2)
            |--------------------------------------------------------------------------
            */
            // SABTU, 7 FEB 2026
            ['course_id'=>2,'title'=>'PEMBAHASAN TO TWK','date'=>'2026-02-07','time'=>'10:30'],
            ['course_id'=>2,'title'=>'PEMBAHASAN TO TIU','date'=>'2026-02-07','time'=>'14:30'],

            // SABTU, 14 FEB 2026
            ['course_id'=>2,'title'=>'HIMPUNAN 3','date'=>'2026-02-14','time'=>'09:00'],
            ['course_id'=>2,'title'=>'PEMBAHASAN TO TKP','date'=>'2026-02-14','time'=>'10:30'],
            ['course_id'=>2,'title'=>'HUBUNGAN X DAN Y 2','date'=>'2026-02-14','time'=>'13:30'],
            ['course_id'=>2,'title'=>'BTI 3','date'=>'2026-02-14','time'=>'14:30'],

            // SABTU, 21 FEB 2026
            ['course_id'=>2,'title'=>'HITUNG DAGANG 3','date'=>'2026-02-21','time'=>'09:00'],
            ['course_id'=>2,'title'=>'TKP 9','date'=>'2026-02-21','time'=>'10:30'],
            ['course_id'=>2,'title'=>'KEC JARAK WAKTU 3','date'=>'2026-02-21','time'=>'13:30'],
            ['course_id'=>2,'title'=>'NASIONALISME 3','date'=>'2026-02-21','time'=>'14:30'],

            // SABTU, 28 FEB 2026
            ['course_id'=>2,'title'=>'SILOGISME 3','date'=>'2026-02-28','time'=>'09:00'],
            ['course_id'=>2,'title'=>'INTEGRITAS 3','date'=>'2026-02-28','time'=>'10:30'],
            ['course_id'=>2,'title'=>'FIGURAL 3','date'=>'2026-02-28','time'=>'13:30'],
            ['course_id'=>2,'title'=>'BHS INDO TWK 4','date'=>'2026-02-28','time'=>'14:30'],

            /*
            |--------------------------------------------------------------------------
            | KELAS KAMIS JUMAT (course_id = 3)
            |--------------------------------------------------------------------------
            */
            ['course_id'=>3,'title'=>'PEMBAHASAN TO TIU','date'=>'2026-02-06','time'=>'16:30'],
            ['course_id'=>3,'title'=>'PEMBAHASAN TO TKP','date'=>'2026-02-06','time'=>'19:00'],
            ['course_id'=>3,'title'=>'HIMPUNAN 3','date'=>'2026-02-12','time'=>'16:30'],
            ['course_id'=>3,'title'=>'PEMBAHASAN TO TWK','date'=>'2026-02-12','time'=>'19:00'],
            ['course_id'=>3,'title'=>'HUBUNGAN X DAN Y 2','date'=>'2026-02-13','time'=>'16:30'],
            ['course_id'=>3,'title'=>'BTI 3','date'=>'2026-02-13','time'=>'19:00'],

            /*
            |--------------------------------------------------------------------------
            | KELAS ONLINE (course_id = 4)
            |--------------------------------------------------------------------------
            */
            ['course_id'=>4,'title'=>'PEMBAHASAN TO TIU','date'=>'2026-02-08','time'=>'13:00'],
            ['course_id'=>4,'title'=>'PEMBAHASAN TO TKP','date'=>'2026-02-08','time'=>'16:00'],
            ['course_id'=>4,'title'=>'PEMBAHASAN TO TWK','date'=>'2026-02-14','time'=>'16:00'],
            ['course_id'=>4,'title'=>'HIMPUNAN 3','date'=>'2026-02-14','time'=>'19:00'],
            ['course_id'=>4,'title'=>'HUBUNGAN X DAN Y 2','date'=>'2026-02-15','time'=>'13:00'],
            ['course_id'=>4,'title'=>'BTI 3','date'=>'2026-02-15','time'=>'15:00'],
        ];

        foreach ($meetings as $m) {
            DB::table('meetings')->insert([
                'course_id'   => $m['course_id'],
                'is_free'     => 0,
                'title'       => $m['title'],
                'slug'        => Str::slug($m['title'].'-'.$m['date'].'-'.$m['time']),
                'scheduled_at'=> Carbon::parse($m['date'])->startOfDay(),
                'started_at'  => Carbon::parse($m['date'].' '.$m['time']),
                'status'      => 'upcoming',
                'created_at'  => now(),
                'updated_at'  => now(),
            ]);
        }
    }
}
