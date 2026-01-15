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
        $search = request()->get('search', '');

        // Ambil semua user dengan role 'siswa'
        $studentsQuery = User::role('siswa')
            ->orderBy('name');

        // Filter berdasarkan pencarian nama
        if (!empty($search)) {
            $studentsQuery->where('name', 'like', '%' . $search . '%');
        }

        $eligibleStudents = $studentsQuery->paginate(20);

        // Ambil absensi yang sudah ada
        $attendances = MeetingAttendance::where('meeting_id', $meeting->id)
            ->whereIn('user_id', $eligibleStudents->pluck('id'))
            ->get()
            ->keyBy('user_id');

        return view('meetings.attendance', [
            'meeting'           => $meeting,
            'eligibleStudents'  => $eligibleStudents,
            'attendances'       => $attendances,
            'search'           => $search,
        ]);
    }

    /**
     * Store / update attendance
     */
    public function store(Request $request, Meeting $meeting)
    {
        // Ambil semua ID siswa yang ada di sistem
        $allStudentIds = User::role('siswa')->pluck('id')->toArray();

        // Filter hanya attendances untuk siswa yang ada di sistem
        $validAttendances = array_intersect_key(
            $request->attendances ?? [],
            array_flip($allStudentIds)
        );

        foreach ($allStudentIds as $studentId) {
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

        toast('success', 'Absensi berhasil disimpan');
        return redirect()->route('meeting.show', $meeting);
    }

    /**
     * API untuk pencarian siswa (autocomplete)
     */
    public function searchStudents(Request $request)
    {
        $search = $request->get('q', '');

        $students = User::role('siswa')
            ->when($search, function($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->select('id', 'name', 'email')
            ->limit(10)
            ->get()
            ->map(function($student) {
                return [
                    'id'    => $student->id,
                    'text'  => $student->name . ' (' . $student->email . ')'
                ];
            });

        return response()->json(['results' => $students]);
    }

    /**
     * Quick attendance - toggle kehadiran satu siswa
     */
    public function quickToggle(Request $request, Meeting $meeting)
    {
        $request->validate([
            'student_id' => 'required|exists:users,id',
            'status'     => 'required|boolean',
        ]);

        $student = User::role('siswa')->findOrFail($request->student_id);

        MeetingAttendance::updateOrCreate(
            [
                'meeting_id' => $meeting->id,
                'user_id'    => $student->id,
            ],
            [
                'is_present' => $request->status,
                'marked_by'  => auth()->id(),
                'marked_at'  => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Absensi ' . $student->name . ' berhasil diupdate',
            'status'  => $request->status ? 'hadir' : 'tidak hadir'
        ]);
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
