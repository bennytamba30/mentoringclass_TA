<?php

namespace App\Filament\Mentor\Pages;

use App\Models\Attendance;
use App\Models\Meeting;
use App\Models\User;
use Filament\Pages\Page;
use Illuminate\Support\Collection;

class BulkAttendance extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Absensi Massal';
    protected static ?string $navigationGroup = '📆 Pertemuan';
    protected static ?string $slug = 'absensi-massal';
    protected static string $view = 'filament.mentor.pages.bulk-attendance';

    public $selectedMeetingId = null;
    public $attendances = [];

    public function getMeetingsProperty(): Collection
    {
        return Meeting::latest()->get();
    }

    public function getMenteesProperty(): Collection
    {
        if (!$this->selectedMeetingId) return collect();

        return User::where('role', 'mentee')->get();
    }

    public function save()
    {
        $meetingId = $this->selectedMeetingId;

        foreach ($this->attendances as $menteeId => $data) {
            if (!isset($data['status'])) {
                continue;
            }

            Attendance::updateOrCreate(
                [
                    'meeting_id' => $meetingId,
                    'mentee_id' => $menteeId,
                ],
                [
                    'status' => $data['status'],
                    'note' => $data['note'] ?? null,
                ]
            );
        }

        session()->flash('success', 'Absensi berhasil disimpan.');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
