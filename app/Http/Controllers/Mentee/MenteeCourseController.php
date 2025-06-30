<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;

class MenteeCourseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') abort(403);

        $courses = Course::where('mentor_id', $user->mentor_id)->get();

        return view('mentee.courses.index', compact('courses'))->with('title', 'Kursus Saya');
    }

    public function show($id)
    {
        $user = auth()->user();

        // Ambil kursus yang dimiliki mentor mentee
        $course = \App\Models\Course::with(['modules', 'assignments' => function ($q) {
            $q->orderBy('deadline');
        }])->where('id', $id)
        ->where('mentor_id', $user->mentor_id)
        ->firstOrFail();

        // Ambil submissions milik mentee terhadap semua tugas di course ini
        $submissions = \App\Models\Submission::where('mentee_id', $user->id)
            ->whereIn('assignment_id', $course->assignments->pluck('id'))
            ->get()
            ->keyBy('assignment_id'); // Agar mudah dicocokkan di view

        return view('mentee.courses.show', compact('course', 'submissions'));
    }

}
