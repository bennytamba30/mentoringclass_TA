<?php

namespace App\Filament\Mentor\Pages;

use Filament\Pages\Page;
use App\Models\Meeting;

class ViewMeetings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';
    protected static string $view = 'filament.mentor.pages.view-meetings';
    protected static ?string $navigationGroup = '📆 Pertemuan';
    protected static ?string $title = 'Daftar Pertemuan';

    public $meetings;

    public function mount(): void
    {
        $this->meetings = Meeting::orderBy('date')->get(); // atau sesuai struktur field kamu
    }
}

