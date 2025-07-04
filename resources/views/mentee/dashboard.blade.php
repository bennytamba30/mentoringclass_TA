@extends('mentee.layout')

@section('content')
    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Kursus -->
        <a href="{{ route('mentee.courses.index') }}"
           class="block bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📘 Total Kursus</h2>
                    <p class="text-5xl font-bold text-blue-600 leading-none">{{ $totalCourses ?? 0 }}</p>
                </div>
            </div>
        </a>

        <!-- Total Tugas -->
        <a href="{{ route('mentee.assignments.index') }}"
           class="block bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📝 Tugas Aktif</h2>
                    <p class="text-5xl font-bold text-green-600 leading-none">{{ $totalAssignments ?? 0 }}</p>
                </div>
            </div>
        </a>

        {{-- <!-- Persentase Kehadiran -->
        <a href="{{ route('mentee.attendance.index') }}"
           class="block bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📆 Kehadiran</h2>
                    <p class="text-5xl font-bold text-purple-600 leading-none">{{ $attendanceRate ?? '0%' }}</p>
                </div>
            </div>
        </a>
    </div> --}}

    <!-- Latest Announcement Section -->
    <div class="bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-xl font-semibold text-slate-700 mb-4">📢 Pengumuman Terbaru</h2>
        @if ($latestAnnouncement)
            <a href="{{ route('mentee.announcements.index') }}" class="block bg-indigo-50 border-l-4 border-indigo-400 p-5 rounded-lg text-slate-800 hover:bg-indigo-100 transition">
                <p class="font-medium text-indigo-800 text-lg mb-1">{{ $latestAnnouncement->content }}</p>
                <p class="text-sm text-indigo-700 opacity-90">
                    {{ $latestAnnouncement->created_at->format('d M Y') }}
                </p>
            </a>
        @else
            <p class="text-slate-500 italic p-4 bg-slate-50 rounded-lg text-center">Belum ada pengumuman terbaru.</p>
        @endif
    </div>
@endsection
