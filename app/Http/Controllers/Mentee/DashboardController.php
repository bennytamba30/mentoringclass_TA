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

        $totalCourses = Course::where('mentor_id', $user->mentor_id)->count();

        $totalAssignments = Assignment::whereHas('course', function ($query) use ($user) {
            $query->where('mentor_id', $user->mentor_id);
        })->count();

        $totalAttendance = Attendance::where('mentee_id', $user->id)->count();
        $presentAttendance = Attendance::where('mentee_id', $user->id)
            ->where('status', 'hadir')->count();
        $attendanceRate = $totalAttendance > 0
            ? round(($presentAttendance / $totalAttendance) * 100, 1) . '%'
            : '0%';

        // Ambil 2 pengumuman terbaru
        $latestAnnouncements = Announcement::where('mentor_id', $user->mentor_id)
            ->latest()
            ->take(2)
            ->get();

        return view('mentee.dashboard', [
            'user' => $user,
            'totalCourses' => $totalCourses,
            'totalAssignments' => $totalAssignments,
            'attendanceRate' => $attendanceRate,
            'latestAnnouncements' => $latestAnnouncements,
            'title' => 'Dashboard Mentee',
        ]);
    }

}
