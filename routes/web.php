<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Front\LandingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TentorController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\MeetingMaterialController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\ExamAttemptController;
use App\Http\Controllers\ExamResultController;
use App\Http\Controllers\MeetingAttendanceController;
use App\Http\Controllers\MeetingVideoController;
use App\Http\Controllers\QuestionCategoryController;
use App\Http\Controllers\QuestionMaterialController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('home');
/*
|--------------------------------------------------------------------------
| AUTH DAN API ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| DASHBOARD ROUTES
|--------------------------------------------------------------------------
*/
// helper dashboard redirect
Route::get('/dashboard-redirect', function () {
    $user = auth()->user();

    if ($user->hasRole('admin')) {
        return redirect()->route('dashboard.admin');
    }

    if ($user->hasRole('tentor')) {
        return redirect()->route('dashboard.tentor');
    }

    return redirect()->route('dashboard.siswa'); // default
})->name('dashboard.redirect')->middleware(['auth', 'verified']);


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/get-regencies/{province_id}', function($province_id) {
        return \App\Models\Regency::where('province_id', $province_id)
            ->orderBy('id')
            ->get();
    })->name('get.regencies');
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD ROUTES
    |--------------------------------------------------------------------------
    */
    Route::get('/admin/dashboard', [DashboardController::class, 'admin'])
        ->name('dashboard.admin')
        ->middleware(['role:admin']);

    Route::get('/tentor/dashboard', [DashboardController::class, 'tentor'])
        ->name('dashboard.tentor')
        ->middleware(['role:tentor']);

    Route::get('/siswa/dashboard', [DashboardController::class, 'siswa'])
        ->name('dashboard.siswa')
        ->middleware(['role:siswa']);

    /*
    |--------------------------------------------------------------------------
    | PROFILES ROUTES
    |--------------------------------------------------------------------------
    */
        // Profile main
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

    // Edit profile
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');

    // Change password
    Route::get('/profile/password', [ProfileController::class, 'password'])->name('profile.password');
    Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // Delete account (deactivate)
    Route::get('/profile/delete', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::post('/profile/delete', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | MANAGE STUDENTS AND TEACHERS ROUTES
    |--------------------------------------------------------------------------
    */
    // SISWA
    Route::prefix('siswa')->middleware(['role:admin'])->group(function () {

        Route::get('/', [SiswaController::class, 'index'])->name('siswa.index');
        Route::get('/{id}', [SiswaController::class, 'show'])->name('siswa.show');
        Route::post('/{id}/toggle', [SiswaController::class, 'toggleActive'])->name('siswa.toggle');
    });
    // TENTOR
    Route::prefix('tentor')->middleware(['role:admin'])->group(function () {
        Route::get('/add', [TentorController::class, 'create'])->name('tentor.create');
        Route::post('/store', [TentorController::class, 'store'])->name('tentor.store');
        Route::get('/{id}/edit', [TentorController::class, 'edit'])->name('tentor.edit');
        Route::put('/{id}', [TentorController::class, 'update'])->name('tentor.update');
        Route::delete('/{id}', [TentorController::class, 'remove'])->name('tentor.remove');
        Route::post('/{id}/toggle', [TentorController::class, 'toggleActive'])->name('tentor.toggle');
    });
    Route::prefix('tentor')->middleware(['role:admin|siswa'])->group(function () {
        Route::get('/', [TentorController::class, 'index'])->name('tentor.index');
        Route::get('/{id}', [TentorController::class, 'show'])->name('tentor.show');
    });

    /*
    |--------------------------------------------------------------------------
    | COURSE ROUTES
    |--------------------------------------------------------------------------
    */
    // Admin-only
    Route::prefix('course')->middleware(['role:admin'])->group(function () {
        Route::get('/create',            [CourseController::class, 'create'])->name('course.create');
        Route::post('/store',            [CourseController::class, 'store'])->name('course.store');
        Route::get('/{slug}/edit',       [CourseController::class, 'edit'])->name('course.edit');
        Route::post('/{slug}/update',    [CourseController::class, 'update'])->name('course.update');
        Route::delete('/{slug}/delete',  [CourseController::class, 'destroy'])->name('course.delete');
    });

    // All roles can view course
    Route::prefix('course')->middleware(['role:admin|tentor|siswa'])->group(function () {
        Route::get('/',            [CourseController::class, 'index'])->name('course.index');
        Route::get('/{slug}',      [CourseController::class, 'show'])->name('course.show');
    });

    /*
    |--------------------------------------------------------------------------
    | MEETING ROUTES
    |--------------------------------------------------------------------------
    */

    //ADMIN & TENTOR
    Route::middleware(['role:admin|tentor'])->group(function () {
        // CREATE & EDIT MEETING
        Route::get('/course/{course}/meetings/create',[MeetingController::class, 'create'])->name('meeting.create');
        Route::post('/course/{course}/meetings',[MeetingController::class, 'store'])->name('meeting.store');
        Route::get('/meetings/{meeting}/edit',[MeetingController::class, 'edit'])->name('meeting.edit');
        Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])->name('meeting.update');
        Route::post('meetings/{meeting}/posttest',[MeetingController::class, 'storePostTest'])->name('meetings.posttest.store');

        // MEETING STATE
        Route::post('/meetings/{meeting}/start',[MeetingController::class, 'start'])->name('meeting.start');
        Route::post('/meetings/{meeting}/finish',[MeetingController::class, 'finish'])->name('meeting.finish');

        // DELETE (SOFT DELETE)
        Route::delete('/meetings/{meeting}',[MeetingController::class, 'destroy'])->name('meeting.destroy');
    });

    // ALL ROLES (ADMIN / TENTOR / SISWA)
    Route::middleware(['role:admin|tentor|siswa'])->group(function () {
        // VIEW MEETING
        Route::get('/meetings/{meeting}',[MeetingController::class, 'show'])->name('meeting.show');

        // JOIN ZOOM
        Route::get('/meetings/{meeting}/join-zoom',[MeetingController::class, 'joinZoom'])->name('meeting.joinZoom');
    });

    /*
    |--------------------------------------------------------------------------
    | MEETING ATTENDANCE
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin|tentor'])->group(function () {
        Route::get('/meetings/{meeting}/attendance',[MeetingAttendanceController::class, 'index'])->name('meeting.attendance.index');
        Route::post('/meetings/{meeting}/attendance',[MeetingAttendanceController::class, 'store'])->name('meeting.attendance.store');
    });

    /*
    |--------------------------------------------------------------------------
    | MEETING MATERIAL (PDF)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin|tentor'])->group(function () {
        Route::post('/meetings/{meeting}/material',[MeetingMaterialController::class, 'store'])->name('meeting.material.store');
        Route::delete('/meetings/{meeting}/material',[MeetingMaterialController::class, 'destroy'])->name('meeting.material.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | MEETING VIDEOS
    |--------------------------------------------------------------------------
    */

    // ADMIN / TENTOR
    Route::middleware(['role:admin|tentor'])->group(function () {
        // Form upload video (prepare)
        Route::get('/meetings/{meeting}/video/create',[MeetingVideoController::class, 'create'])->name('meetings.video.create');
        // Store video (create record + Bunny)
        Route::post('/meetings/{meeting}/video',[MeetingVideoController::class, 'store'])->name('meetings.video.store');
        // Edit metadata (optional)
        Route::get('/meetings/{meeting}/video/edit',[MeetingVideoController::class, 'edit'])->name('meetings.video.edit');
        // Update metadata (optional)
        Route::put('/meetings/{meeting}/video',[MeetingVideoController::class, 'update'])->name('meetings.video.update');
        // Delete video (hapus Bunny + DB)
        Route::delete('/meetings/{meeting}/video',[MeetingVideoController::class, 'destroy'])->name('meetings.video.destroy');
    });
    // STUDENT / GENERAL USER
    Route::get('/meetings/{meeting}/video/playback',[MeetingVideoController::class, 'playback'])->name('meetings.video.playback');

    /*
    |--------------------------------------------------------------------------
    | EXAMS ROUTE
    |--------------------------------------------------------------------------
    */
    Route::get('/tryouts', [ExamController::class, 'indexTryout'])->name('tryouts.index');
    Route::get('/quizzes', [ExamController::class, 'indexQuiz'])->name('quizzes.index');
    Route::get('/exams/{exam}', [ExamController::class, 'show'])->name('exams.show');
    Route::middleware('role:admin|tentor')->group(function () {
        Route::resource('exams', ExamController::class)->except(['show']);
        Route::post('exams/{exam}/activate', [ExamController::class, 'activate'])->name('exams.activate');
        Route::post('exams/{exam}/close', [ExamController::class, 'close'])->name('exams.close');
        // RESULT ADMIN
        Route::get('exams/{exam}/results',[ExamResultController::class, 'admin'])->name('exams.result.admin');
        // AJAX Question Picker
        Route::prefix('ajax/{exam}/questions')->group(function () {
            Route::get('by-material/{material}', [ExamQuestionController::class, 'byMaterial'])->name('ajax.exams.questions.byMaterial');
            Route::post('attach', [ExamQuestionController::class, 'attach'])->name('ajax.exams.questions.attach');
            Route::post('detach', [ExamQuestionController::class, 'detach'])->name('ajax.exams.questions.detach');
        });
    });
    Route::middleware('role:siswa')->group(function () {
        // Attempt
        Route::post('exams/{exam}/start', [ExamAttemptController::class, 'start'])->name('exams.start');
        Route::get('exams/{exam}/attempt', [ExamAttemptController::class, 'attempt'])->name('exams.attempt');
        Route::post('exams/{exam}/submit', [ExamAttemptController::class, 'submit'])->name('exams.submit');
        Route::post('exams/{exam}/answer',[ExamAttemptController::class, 'saveAnswer'])->name('exams.answer.save');
        // RESULT SISWA
        Route::get('exams/{exam}/result',[ExamResultController::class, 'student'])->name('exams.result.student');
    });

    /*
    |--------------------------------------------------------------------------
    | BANK SOAL (QUESTIONS) ROUTES
    |--------------------------------------------------------------------------
    */
    Route::middleware(['auth', 'role:admin|tentor'])
    ->prefix('ajax')
    ->group(function () {

        Route::get(
            'categories/{category}/materials',
            [QuestionMaterialController::class, 'ajaxByCategory']
        )->name('ajax.categories.materials');
    });
    Route::middleware(['role:admin|tentor'])->prefix('bank-soal')->name('bank.')->group(function () {

        // KATEGORI SOAL
        Route::prefix('categories')->name('category.')->group(function () {
            Route::get('/',[QuestionCategoryController::class, 'index'])->name('index');
            Route::get('/create',[QuestionCategoryController::class, 'create'])->name('create');
            Route::post('/store',[QuestionCategoryController::class, 'store'])->name('store');
            Route::get('/{category}/edit',[QuestionCategoryController::class, 'edit'])->name('edit');
            Route::put('/{category}',[QuestionCategoryController::class, 'update'])->name('update');
            Route::delete('/{category}',[QuestionCategoryController::class, 'destroy'])->name('delete');

            Route::get('/{category}/materials',[QuestionMaterialController::class, 'index'])->name('materials.index');
            Route::get('/{category}/materials/create',[QuestionMaterialController::class, 'create'])->name('materials.create');
            Route::post('/{category}/materials/store',[QuestionMaterialController::class, 'store'])->name('materials.store');
        });

        // MATERI SOAL UNTUK EDIT/UPDATE/DELETE
        Route::get('/materials/{material}/edit',[QuestionMaterialController::class, 'edit'])->name('material.edit');
        Route::put('/materials/{material}',[QuestionMaterialController::class, 'update'])->name('material.update');
        Route::delete('/materials/{material}',[QuestionMaterialController::class, 'destroy'])->name('material.delete');


        // SOAL SOAL
        Route::prefix('materials')->name('material.')->group(function () {
            Route::get('/{material}/questions',[QuestionController::class, 'index'])->name('questions.index');
            Route::get('/{material}/questions/create',[QuestionController::class, 'create'])->name('questions.create');
            Route::post('/{material}/questions/store',[QuestionController::class, 'store'])->name('questions.store');
        });

        Route::get('/questions/{question}/edit',[QuestionController::class, 'edit'])->name('question.edit');
        Route::put('/questions/{question}',[QuestionController::class, 'update'])->name('question.update');
        Route::delete('/questions/{question}',[QuestionController::class, 'destroy'])->name('question.delete');
    });
});


Route::get('/_test-b2', function () {
    Storage::disk('b2')->put(
        'test/hello.txt',
        'Hello from Laravel'
    );

    return 'OK';
});
