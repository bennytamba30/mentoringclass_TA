<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;
use App\Models\Assignment;

class MenteeSubmissionController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') abort(403);

        $submissions = Submission::where('mentee_id', $user->id)
            ->with('assignment')
            ->get();

        return view('mentee.submissions.index', compact('submissions'))
            ->with('title', 'Pengumpulan Tugas');
    }

    public function create($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        return view('mentee.submissions.create', compact('assignment'))
            ->with('title', 'Kumpulkan Tugas');
    }

    public function store(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'file' => 'required|file|mimes:pdf,doc,docx,zip,png,jpg,jpeg'
        ]);

        $assignment = Assignment::findOrFail($request->assignment_id);

        // ✅ Validasi deadline
        if (now()->gt($assignment->deadline)) {
            return back()->withErrors([
                'file' => 'Deadline pengumpulan sudah lewat. Kamu tidak bisa mengumpulkan tugas.'
            ]);
        }

        // ✅ Cek apakah sudah pernah mengumpulkan (opsional)
        $existing = Submission::where('assignment_id', $assignment->id)
            ->where('mentee_id', Auth::id())
            ->first();

        if ($existing) {
            return back()->withErrors([
                'file' => 'Tugas ini sudah pernah dikumpulkan.'
            ]);
        }

        $filePath = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'assignment_id' => $assignment->id,
            'mentee_id' => Auth::id(),
            'file' => $filePath,
            'submitted_at' => now(),
        ]);

        return redirect()->route('mentee.submissions.index')->with('success', 'Tugas berhasil dikumpulkan.');
    }

    public function show($id)
    {
        $submission = Submission::where('mentee_id', Auth::id())
            ->with('assignment')
            ->findOrFail($id);

        return view('mentee.submissions.show', compact('submission'))
            ->with('title', 'Detail Tugas');
    }
}
