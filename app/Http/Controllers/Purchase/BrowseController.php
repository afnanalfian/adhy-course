<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Course;
use App\Models\Meeting;
use Illuminate\Http\Request;

class BrowseController extends Controller
{
    /**
     * Tampilkan marketplace utama
     */
    public function index(Request $request)
    {
        // COURSE PACKAGE
        $courses = Course::with('product')
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($course) {
                return [
                    'id'          => $course->id,
                    'name'        => $course->name,
                    'description' => $course->description,
                    'product'     => $course->product,
                ];
            });

        // TRYOUT
        $tryouts = Exam::with('product')
            ->where('type', 'tryout')
            ->whereNull('deleted_at')
            ->get()
            ->map(function ($exam) {
                return [
                    'id'          => $exam->id,
                    'title'       => $exam->title,
                    'description' => $exam->exam_date,
                    'product'     => $exam->product,
                ];
            });

        return view('purchase.browse.index', compact(
            'courses',
            'tryouts'
        ));
    }

    /**
     * Page detail course: menampilkan daftar meeting + harga
     */
    public function course(Course $course)
    {
        $meetings = Meeting::with('product')
            ->where('course_id', $course->id)
            ->whereNull('deleted_at')
            ->orderBy('scheduled_at')
            ->get();

        return view('purchase.browse.course', compact(
            'course',
            'meetings'
        ));
    }
}
