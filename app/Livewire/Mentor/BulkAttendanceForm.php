<?php


namespace App\Livewire\Mentor;

use App\Models\User;
use App\Models\Meeting;
use Livewire\Component;
use App\Models\Attendance;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class BulkAttendanceForm extends Component
{
    public $meetingId = '';
    public $statuses = [];
    public $notes = [];
    public $showRecap = false;

    public function updatedMeetingId($value)
    {
        logger('updatedMeetingId dipanggil, value: ' . $value);

        // Reset status & notes
        $this->statuses = [];
        $this->notes = [];

        // Inisialisasi default untuk setiap mentee
        foreach ($this->mentees as $mentee) {
            $this->statuses[$mentee->id] = 'hadir';
            $this->notes[$mentee->id] = '';
        }
    }

    public function getMenteesProperty()
    {
        if (!$this->meetingId) {
            return collect(); // return koleksi kosong agar aman di blade
        }

        return User::where('mentor_id', Auth::id())
            ->where('role', 'mentee')
            ->orderBy('name')
            ->get();
    }

    public function submit()
    {
        if (!$this->meetingId) {
            session()->flash('error', 'Silakan pilih pertemuan terlebih dahulu.');
            return;
        }

        try {
            $mentorId = auth()->id();

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

            // reset input jika perlu
            $this->statuses = [];
            $this->notes = [];

        } catch (\Exception $e) {
            logger()->error('Gagal menyimpan absensi: ' . $e->getMessage());
            session()->flash('error', 'Terjadi kesalahan saat menyimpan absensi.');
        }
    }
    
public function toggleRecap()
{
    $this->showRecap = !$this->showRecap;
}




    public function render()
    {
        Log::info('Render Livewire:', [
            'meetingId' => $this->meetingId,
            'mentees_count' => $this->mentees->count()
        ]);

        return view('livewire.mentor.bulk-attendance-form', [
            'meetings' => Meeting::orderBy('date')->get(),
            'mentees' => $this->mentees,
        ]);
    }
}

