@extends('mentee.layout')

@section('content')
    <!-- Dashboard Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <!-- Total Kursus -->
        <div
            class="bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📘 Total Kursus</h2>
                    <p class="text-5xl font-bold text-blue-600 leading-none">{{ $totalCourses ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Total Tugas -->
        <div
            class="bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📝 Tugas Aktif</h2>
                    <p class="text-5xl font-bold text-green-600 leading-none">{{ $totalAssignments ?? 0 }}</p>
                </div>
            </div>
        </div>

        <!-- Persentase Kehadiran -->
        <div
            class="bg-white p-6 rounded-2xl shadow-xl hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-slate-700 mb-2">📆 Kehadiran</h2>
                    <p class="text-5xl font-bold text-purple-600 leading-none">{{ $attendanceRate ?? '0%' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Announcement Section -->
    <div class="bg-white p-6 rounded-2xl shadow-xl">
        <h2 class="text-xl font-semibold text-slate-700 mb-4">📢 Pengumuman Terbaru</h2>
        @if ($latestAnnouncement)
            <div class="bg-indigo-50 border-l-4 border-indigo-400 p-5 rounded-lg text-slate-800">
                <p class="font-medium text-indigo-800 text-lg mb-1">{{ $latestAnnouncement->content }}</p>
                <!-- Assuming $latestAnnouncement might have a title or date field, adjust as needed -->
                <p class="text-sm text-indigo-700 opacity-90">
                    {{-- Example: {{ $latestAnnouncement->created_at->format('d M Y') }} --}}
                    <!-- You can add more details here if your announcement object has them -->
                </p>
            </div>
        @else
            <p class="text-slate-500 italic p-4 bg-slate-50 rounded-lg text-center">Belum ada pengumuman terbaru.</p>
        @endif
    </div>
@endsection
