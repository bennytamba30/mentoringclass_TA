<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Mentee\DashboardController;
use App\Http\Controllers\Mentee\MenteeCourseController;
use App\Http\Controllers\Mentee\MenteeAssignmentController;
use App\Http\Controllers\Mentee\MenteeAttendanceController;
use App\Livewire\Mentor\Attendance\BulkAttendancePage;
use App\Http\Controllers\Mentee\MenteeAnnouncementController;
use App\Http\Controllers\Mentee\MenteeProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ✅ Halaman Awal (Welcome)
Route::get('/', function () {
    return view('welcome');
});

// ✅ Redirect login Filament ke login custom
Route::redirect('/admin/login', '/login');
Route::redirect('/mentor/login', '/login');

// ✅ ROUTES UNTUK GUEST (belum login)
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

// ✅ ROUTES UNTUK YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {

    // ✅ Logout
    Route::post('/logout', function () {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');



    /*
    |--------------------------------------------------------------------------
    | PANEL MENTEE
    |--------------------------------------------------------------------------
    */
    Route::middleware('mentee.role') // Pastikan middleware ini sesuai
        ->prefix('mentee')
        ->name('mentee.')
        ->group(function () {

        // ✅ Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        //profil
        Route::get('/profile', [MenteeProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [MenteeProfileController::class, 'update'])->name('profile.update');
        Route::post('/profile/password', [MenteeProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    


        // ✅ Kursus Saya
        Route::get('/courses', [MenteeCourseController::class, 'index'])->name('courses.index');
        Route::get('/courses/{id}', [MenteeCourseController::class, 'show'])->name('courses.show');

        // ✅ Tugas
        Route::get('/assignments', [MenteeAssignmentController::class, 'index'])->name('assignments.index');
        Route::get('/assignments/{id}', [MenteeAssignmentController::class, 'show'])->name('assignments.show');
        Route::post('/assignments/{id}/submit', [MenteeAssignmentController::class, 'submit'])->name('assignments.submit');

        //✅ Kehadiran
        Route::get('/attendances', [MenteeAttendanceController::class, 'index'])->name('attendances.index');

        // ✅ Pengumuman
         Route::get('/announcements', [MenteeAnnouncementController::class, 'index'])->name('announcements.index');
        Route::get('/announcements/{id}', [MenteeAnnouncementController::class, 'show'])->name('announcements.show');

    });


    return redirect('/login')->with('status', 'Logout berhasil!');
});
