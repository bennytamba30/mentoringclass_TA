<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Submission;

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

        // ✅ Ambil data submission jika sudah ada
        $submission = Submission::where('assignment_id', $assignment->id)
            ->where('mentee_id', $user->id)
            ->first();

        return view('mentee.assignments.show', compact('assignment', 'submission'))->with('title', $assignment->title);
    }

        public function submit(Request $request, $assignmentId)
    {
        $request->validate([
            'file' => 'required|file|max:2048',
        ]);

        $user = Auth::user();
        $assignment = Assignment::findOrFail($assignmentId);

        // ✅ Cegah pengumpulan jika sudah lewat deadline
        if ($assignment->deadline && now()->greaterThan($assignment->deadline)) {
            return redirect()->back()->with('error', '⛔ Batas waktu pengumpulan tugas telah berakhir.');
        }

        // ✅ Cegah duplikat pengumpulan
        $existing = Submission::where('assignment_id', $assignmentId)
            ->where('mentee_id', $user->id)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', '⚠️ Kamu sudah mengumpulkan tugas ini.');
        }

        $filePath = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignmentId,
            'mentee_id' => $user->id,
            'file' => $filePath,
            'submitted_at' => now(),
        ]);

        return redirect()->back()->with('success', '✅ Tugas berhasil dikumpulkan.');
    }


}
