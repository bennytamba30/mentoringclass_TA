<?php

namespace App\Filament\Mentor\Widgets;

use App\Models\Course;
use App\Models\User;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class MentorStats extends StatsOverviewWidget
{
    /**
     * Mengatur interval polling untuk widget agar data diperbarui secara otomatis.
     * Atur ke '15s', '30s', dll. atau null untuk menonaktifkan.
     *
     * @var string|null
     */
    protected static ?string $pollingInterval = '30s';

    /**
     * Aktifkan lazy loading untuk memuat widget ini setelah halaman utama dimuat.
     * Ini meningkatkan performa pemuatan halaman awal.
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
        // --- Langkah 1: Dapatkan Mentor yang Sedang Login ---
        $mentor = Filament::auth()->user();

        // --- Langkah 2: Ambil Data Statistik Utama ---
        // Hitung jumlah mentee dan kursus yang dimiliki oleh mentor.
        $totalMentees = User::where('mentor_id', $mentor->id)->count();
        $totalCourses = Course::where('mentor_id', 'like', '%' . $mentor->id . '%')->count();


        // --- Langkah 3: Data untuk Grafik Tren Mentee ---
        // Ambil data penambahan mentee baru dalam 7 hari terakhir untuk grafik.
        $menteeTrend = User::query()
            ->where('mentor_id', $mentor->id)
            ->where('created_at', '>=', Carbon::now()->subWeek())
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->pluck('count')
            ->toArray();

        // --- Langkah 4: Bangun Kartu Statistik ---
        // Buat setiap kartu dengan data, deskripsi, warna, ikon, dan grafik tren.
        return [
            Stat::make('Total Mentee', $totalMentees)
                ->description('Jumlah mentee yang Anda bimbing')
                ->descriptionIcon('heroicon-m-user-group')
                ->color('success')
                ->chart($menteeTrend)
                ->url(route('filament.mentor.resources.mentees.index')),

            Stat::make('Total Kursus', $totalCourses)
                ->description('Jumlah kursus yang Anda kelola')
                ->descriptionIcon('heroicon-m-book-open')
                ->color('primary')
                ->url(route('filament.mentor.resources.courses.index')),
        ];

    }
}
