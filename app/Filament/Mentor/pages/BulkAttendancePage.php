<?php

namespace App\Filament\Mentor\Pages;

use App\Models\User;
use App\Models\Meeting;
use App\Models\Attendance;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Auth;

class BulkAttendancePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    protected static string $view = 'filament.mentor.pages.bulk-attendance';

    protected static ?string $title = 'Absensi Massal';

    protected static ?string $navigationGroup = '📆 Absensi';

    public ?int $meetingId = null;
    public array $statuses = [];
    public array $notes = [];
    public array $mentees = [];

    public function updatedMeetingId(): void
    {
        if (!$this->meetingId) {
            $this->mentees = [];
            return;
        }

        $this->mentees = User::where('mentor_id', Auth::id())
            ->orderBy('name')
            ->get()
            ->map(fn ($mentee) => [
                'id' => $mentee->id,
                'name' => $mentee->name,
            ])
            ->toArray();

        foreach ($this->mentees as $mentee) {
            $this->statuses[$mentee['id']] = 'hadir';
            $this->notes[$mentee['id']] = '';
        }
    }

    public function submit(): void
    {
        foreach ($this->statuses as $menteeId => $status) {
            Attendance::updateOrCreate(
                [
                    'meeting_id' => $this->meetingId,
                    'mentee_id' => $menteeId,
                ],
                [
                    'mentor_id' => Auth::id(),
                    'status' => $status,
                    'note' => $this->notes[$menteeId] ?? '',
                ]
            );
        }

        $this->notify('success', 'Absensi berhasil disimpan.');
    }

    public function getMeetingsProperty()
    {
        return Meeting::orderBy('date')->get();
    }
}
