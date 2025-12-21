<?php

namespace App\Http\Controllers\Purchase;

use App\Http\Controllers\Controller;
use App\Models\UserEntitlement;
use App\Models\Course;
use App\Models\Meeting;
use App\Models\Exam;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Dashboard purchase (ringkasan)
     */
    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $summary = [
            'courses'  => UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'course')
                ->count(),

            'meetings' => UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'meeting')
                ->count(),

            'tryouts'  => UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'tryout')
                ->count(),

            'quiz'     => UserEntitlement::where('user_id', $userId)
                ->where('entitlement_type', 'quiz')
                ->exists(),
        ];

        return view('purchase.products.index', compact('summary'));
    }

    /**
     * List course yang dimiliki user
     */
    public function courses(Request $request)
    {
        $userId = $request->user()->id;

        $courseIds = UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'course')
            ->pluck('entitlement_id');

        $courses = Course::whereIn('id', $courseIds)
            ->whereNull('deleted_at')
            ->get();

        return view('purchase.products.courses', compact('courses'));
    }

    /**
     * List meeting yang dimiliki user
     */
    public function meetings(Request $request)
    {
        $userId = $request->user()->id;

        $meetingIds = UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'meeting')
            ->pluck('entitlement_id');

        $meetings = Meeting::with('course')
            ->whereIn('id', $meetingIds)
            ->whereNull('deleted_at')
            ->orderBy('scheduled_at')
            ->get();

        return view('purchase.products.meetings', compact('meetings'));
    }

    /**
     * List tryout yang dimiliki user
     */
    public function tryouts(Request $request)
    {
        $userId = $request->user()->id;

        $tryoutIds = UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'tryout')
            ->pluck('entitlement_id');

        $tryouts = Exam::where('type', 'tryout')
            ->whereIn('id', $tryoutIds)
            ->get();

        return view('purchase.products.tryouts', compact('tryouts'));
    }

    /**
     * Detail course (opsional, kalau mau)
     * Biasanya redirect ke halaman belajar
     */
    public function showCourse(Request $request, Course $course)
    {
        $hasAccess = UserEntitlement::where('user_id', $request->user()->id)
            ->where('entitlement_type', 'course')
            ->where('entitlement_id', $course->id)
            ->exists();

        abort_if(! $hasAccess, 403);

        return redirect()->route('courses.show', $course->slug);
    }
    /**
     * Etalase pembelian (browse course & tryout)
     */
    public function browse(Request $request)
    {
        $userId = $request->user()->id;

        // course yang sudah dimiliki (biar ga bisa dibeli lagi)
        $ownedCourseIds = UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'course')
            ->pluck('entitlement_id')
            ->toArray();

        // tryout yang sudah dimiliki
        $ownedTryoutIds = UserEntitlement::where('user_id', $userId)
            ->where('entitlement_type', 'tryout')
            ->pluck('entitlement_id')
            ->toArray();

        $courses = Course::whereNull('deleted_at')
            ->withCount('meetings')
            ->get();

        $tryouts = Exam::where('type', 'tryout')
            ->whereNull('deleted_at')
            ->get();

        return view('purchase.products.browse', compact(
            'courses',
            'tryouts',
            'ownedCourseIds',
            'ownedTryoutIds'
        ));
    }

}
