<?php

namespace App\Http\Controllers\Mentee;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Announcement;

class MenteeAnnouncementController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->role !== 'mentee') abort(403);

        $announcements = Announcement::where('mentor_id', $user->mentor_id)->latest()->get();

        return view('mentee.announcements.index', compact('announcements'))->with('title', 'Pengumuman');
    }

    public function show($id)
    {
        $user = Auth::user();
        $announcement = Announcement::where('mentor_id', $user->mentor_id)->findOrFail($id);

        return view('mentee.announcements.show', compact('announcement'))->with('title', $announcement->title);
    }
}

