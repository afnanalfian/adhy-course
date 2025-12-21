<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use Illuminate\Http\Request;

class MeetingAttendanceController extends Controller
{
    /**
     * Show attendance form (create / edit)
     */
    public function index(Meeting $meeting)
    {
        // Ambil hanya user dengan role siswa
        $students = User::role('siswa')
            ->orderBy('name')
            ->get();

        // Ambil absensi yang sudah ada (jika ada)
        $attendances = $meeting->attendances()
            ->whereIn('user_id', $students->pluck('id'))
            ->get()
            ->keyBy('user_id');

        return view('meetings.attendance', [
            'meeting'     => $meeting,
            'students'    => $students,
            'attendances' => $attendances,
        ]);
    }

    /**
     * Store / update attendance
     */
    public function store(Request $request, Meeting $meeting)
    {
        $students = User::role('siswa')->get();

        foreach ($students as $student) {
            MeetingAttendance::updateOrCreate(
                [
                    'meeting_id' => $meeting->id,
                    'user_id'    => $student->id,
                ],
                [
                    'is_present' => isset($request->attendances[$student->id]),
                ]
            );
        }

        toast('success', 'Absensi berhasil disimpan');
        return redirect()->route('meeting.show', $meeting);
    }
}
