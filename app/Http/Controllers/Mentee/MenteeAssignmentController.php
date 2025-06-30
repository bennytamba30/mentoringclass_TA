<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;

class MenteeAssignmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') abort(403);

        $assignments = Assignment::whereHas('course', fn($q) => $q->where('mentor_id', $user->mentor_id))->get();

        return view('mentee.assignments.index', compact('assignments'))->with('title', 'Tugas');
    }

    public function show($id)
    {
        $user = Auth::user();
        $assignment = Assignment::whereHas('course', fn($q) => $q->where('mentor_id', $user->mentor_id))->findOrFail($id);

        return view('mentee.assignments.show', compact('assignment'))->with('title', $assignment->title);
    }
}
