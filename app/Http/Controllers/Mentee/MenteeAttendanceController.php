<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;

class MenteeAttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') abort(403);

        $attendances = Attendance::where('mentee_id', $user->id)->with('meeting')->get();

        return view('mentee.attendances.index', compact('attendances'))->with('title', 'Riwayat Kehadiran');
    }

    public function show($id)
    {
        $user = Auth::user();
        $attendance = Attendance::where('mentee_id', $user->id)->with('meeting')->findOrFail($id);

        return view('mentee.attendances.show', compact('attendance'))->with('title', 'Detail Kehadiran');
    }
}
