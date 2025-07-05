<?php

namespace App\Livewire\Mentor;

use Livewire\Component;
use App\Models\User;
use App\Models\Meeting;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class BulkAttendanceForm extends Component
{
    public $meetingId = null;
    public $mentees = [];
    public $statuses = [];
    public $notes = [];

    public function updatedMeetingId($value)
    {
        if (!$value) {
            $this->mentees = [];
            $this->statuses = [];
            $this->notes = [];
            return;
        }

        $mentorId = Auth::id();

        $this->mentees = User::where('mentor_id', $mentorId)
            ->where('role', 'mentee')
            ->orderBy('name')
            ->get();

        // Inisialisasi status & notes default
        foreach ($this->mentees as $mentee) {
            $this->statuses[$mentee->id] = 'hadir';
            $this->notes[$mentee->id] = '';
        }
    }

    public function submit()
    {
        $mentorId = Auth::id();

        if (!$this->meetingId) {
            session()->flash('error', 'Silakan pilih pertemuan terlebih dahulu.');
            return;
        }

        foreach ($this->statuses as $menteeId => $status) {
            Attendance::updateOrCreate(
                [
                    'meeting_id' => $this->meetingId,
                    'mentee_id' => $menteeId,
                ],
                [
                    'mentor_id' => $mentorId,
                    'status' => $status,
                    'note' => $this->notes[$menteeId] ?? '',
                ]
            );
        }

        session()->flash('success', 'Absensi berhasil disimpan.');
    }

    public function render()
    {
        return view('livewire.mentor.bulk-attendance-form', [
            'meetings' => Meeting::orderBy('date')->get(),
        ]);
    }
}
