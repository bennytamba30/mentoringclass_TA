<?php

namespace App\Filament\Admin\Resources\AdminResource\Pages;

use Filament\Pages\Page;
use App\Models\Attendance;

class AttendanceReport extends Page
{
    protected static string $view = 'filament.admin.resources.admin-resource.pages.attendance-report';

    public $attendances;

    public function mount(): void
    {
        $this->attendances = Attendance::with(['mentee', 'meeting'])->latest()->get();
    }

    // ✅ Konfigurasi Navigasi
    protected static ?string $navigationGroup = '📊 Laporan';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Absensi';
    protected static ?string $slug = 'laporan-absensi';
    protected static ?int $navigationSort = 1;

    // ✅ Pastikan ini diaktifkan agar muncul di sidebar
    public static function shouldRegisterNavigation(): bool
    {
        return true;
    }
}
