<?php

namespace App\Filament\Admin\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class UserStats extends StatsOverviewWidget
{
    /**
     * Mengatur interval polling untuk widget agar data diperbarui secara otomatis.
     * Atur ke null untuk menonaktifkan.
     *
     * @var string|null
     */
    protected static ?string $pollingInterval = '15s';

    /**
     * Aktifkan lazy loading untuk widget ini.
     * Ini membantu mempercepat waktu muat awal halaman dasbor.
     *
     * @var bool
     */
    protected static bool $isLazy = true;

    /**
     * Mendapatkan statistik untuk ditampilkan di widget.
     *
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        // --- Langkah 1: Optimasi Query ---
        // Ambil semua jumlah pengguna berdasarkan peran dalam satu query untuk efisiensi.
        $userCounts = User::query()
            ->select('role', DB::raw('count(*) as count'))
            ->groupBy('role')
            ->pluck('count', 'role');

        // --- Langkah 2: Data untuk Grafik Tren ---
        // Ambil data tren pengguna baru dalam 7 hari terakhir.
        $trendData = User::query()
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count')
            ->toArray();

        // --- Langkah 3: Bangun Kartu Statistik ---
        // Buat setiap kartu dengan data, deskripsi, warna, ikon, dan grafik tren.
        return [
            Stat::make('Total Admin', $userCounts->get('admin', 0))
                ->description('Pengguna dengan hak akses admin')
                ->descriptionIcon('heroicon-m-shield-check')
                ->color('danger')
                ->chart($trendData)
                ->url(route('filament.admin.resources.administrators.index')),

            Stat::make('Total Mentor', $userCounts->get('mentor', 0))
                ->description('Pengguna dengan peran sebagai mentor')
                ->descriptionIcon('heroicon-m-academic-cap')
                ->color('info')
                ->chart($trendData)
                ->url(route('filament.admin.resources.users.index', ['tableFilters[role][value]' => 'mentor'])),

            Stat::make('Total Mentee', $userCounts->get('mentee', 0))
                ->description('Pengguna dengan peran sebagai mentee')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart($trendData)
                ->url(route('filament.admin.resources.users.index', ['tableFilters[role][value]' => 'mentee'])),
        ];
    }
}
