<?php

namespace App\Filament\Mentor\Pages;

use Filament\Pages\Page;

class BulkAttendancePage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';
    protected static ?string $title = 'Absensi';
    protected static ?string $slug = 'bulk-attendance';
    protected static ?string $navigationGroup = '📆 Pertemuan';
    protected static string $view = 'filament.mentor.pages.bulk-attendance-page';
}
