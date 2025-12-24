<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Models\Meeting;
use App\Models\MeetingAttendance;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Course;

class MeetingAttendanceController extends Controller
{
    /**
     * Show attendance form (create / edit)
     */
    public function index(Meeting $meeting)
    {
        // Ambil hanya user dengan role siswa yang MEMILIKI AKSES ke meeting ini
        $eligibleStudents = User::role('siswa')
            ->where(function($query) use ($meeting) {
                // Siswa yang memiliki akses ke course ini
                $query->whereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'course')
                      ->where('entitlement_id', $meeting->course_id);
                })
                // ATAU siswa yang membeli meeting satuan ini
                ->orWhereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'meeting')
                      ->where('entitlement_id', $meeting->id);
                });
            })
            ->orderBy('name')
            ->get();

        // Ambil absensi yang sudah ada untuk siswa yang eligible
        $attendances = MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereIn('user_id', $eligibleStudents->pluck('id'))
            ->get()
            ->keyBy('user_id');

        return view('meetings.attendance', [
            'meeting'     => $meeting,
            'eligibleStudents'    => $eligibleStudents, // Menggunakan eligibleStudents, bukan semua siswa
            'attendances' => $attendances,
        ]);
    }

    /**
     * Store / update attendance
     */
    public function store(Request $request, Meeting $meeting)
    {
        // Validasi: hanya boleh ada attendances untuk siswa yang eligible
        $eligibleStudentIds = User::role('siswa')
            ->where(function($query) use ($meeting) {
                $query->whereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'course')
                      ->where('entitlement_id', $meeting->course_id);
                })
                ->orWhereHas('entitlements', function($q) use ($meeting) {
                    $q->where('entitlement_type', 'meeting')
                      ->where('entitlement_id', $meeting->id);
                });
            })
            ->pluck('id')
            ->toArray();

        // Filter hanya attendances untuk siswa yang eligible
        $validAttendances = array_intersect_key(
            $request->attendances ?? [],
            array_flip($eligibleStudentIds)
        );

        foreach ($eligibleStudentIds as $studentId) {
            MeetingAttendance::updateOrCreate(
                [
                    'meeting_id' => $meeting->id,
                    'user_id'    => $studentId,
                ],
                [
                    'is_present' => isset($validAttendances[$studentId]),
                    'marked_by'  => auth()->id(),
                    'marked_at'  => now(),
                ]
            );
        }

        // Hapus absensi untuk siswa yang tidak eligible (jika ada)
        MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereNotIn('user_id', $eligibleStudentIds)
            ->delete();

        toast('success', 'Absensi berhasil disimpan');
        return redirect()->route('meeting.show', $meeting);
    }
    public function courseAttendanceReport(Request $request)
    {
        $courses = Course::orderBy('name')->get();
        $selectedCourseId = $request->query('course_id');

        $attendanceData = collect();

        if ($selectedCourseId) {
            $course = Course::findOrFail($selectedCourseId);

            // Ambil semua meeting yang sudah done di course ini
            $doneMeetings = Meeting::where('course_id', $selectedCourseId)
                ->where('status', 'done')
                ->get();

            // Ambil semua siswa yang memiliki akses ke course ini
            $students = User::role('siswa')
                ->with(['attendances' => function($q) use ($doneMeetings) {
                    $q->whereIn('meeting_id', $doneMeetings->pluck('id'))
                    ->where('is_present', true);
                }])
                ->get();

            $totalDoneMeetings = $doneMeetings->count();

            // Hitung persentase kehadiran per siswa
            foreach ($students as $student) {
                $attendedCount = $student->attendances->count();
                $percentage = $totalDoneMeetings > 0
                    ? round(($attendedCount / $totalDoneMeetings) * 100, 1)
                    : null;

                $attendanceData->push([
                    'student' => $student,
                    'attended_count' => $attendedCount,
                    'total_done_meetings' => $totalDoneMeetings,
                    'percentage' => $percentage,
                    'attended_meetings' => $student->attendances->pluck('meeting_id')->toArray()
                ]);
            }

            // Urutkan dari yang paling sering hadir ke paling jarang
            $attendanceData = $attendanceData->sortByDesc('percentage');
        }

        return view('reports.course-attendance', compact(
            'courses',
            'selectedCourseId',
            'attendanceData'
        ));
    }

}
