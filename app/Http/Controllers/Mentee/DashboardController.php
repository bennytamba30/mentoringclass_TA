<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role !== 'mentee') {
            abort(403, 'Akses hanya untuk mentee.');
        }

        // Kursus yang dibuat oleh mentor dari mentee ini
        $totalCourses = Course::where('mentor_id', $user->mentor_id)->count();

        // Tugas dari kursus milik mentor dari mentee ini
        $totalAssignments = Assignment::whereHas('course', function ($query) use ($user) {
            $query->where('mentor_id', $user->mentor_id);
        })->count();

        // Absensi berdasarkan mentee_id
        $totalAttendance = Attendance::where('mentee_id', $user->id)->count();
        $presentAttendance = Attendance::where('mentee_id', $user->id)
            ->where('status', 'hadir')->count();
        $attendanceRate = $totalAttendance > 0
            ? round(($presentAttendance / $totalAttendance) * 100, 1) . '%'
            : '0%';

        // Pengumuman terbaru dari mentor
        $latestAnnouncement = Announcement::where('mentor_id', $user->mentor_id)
            ->latest()
            ->first()?->title;

        return view('mentee.dashboard', [
            'user' => $user,
            'totalCourses' => $totalCourses,
            'totalAssignments' => $totalAssignments,
            'attendanceRate' => $attendanceRate,
            'latestAnnouncement' => $latestAnnouncement,
            'title' => 'Dashboard Mentee',
        ]);
    }
}
