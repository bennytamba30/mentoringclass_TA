@extends('mentee.layout')

@section('content')
    <!-- Statistik -->
    <div class="flex justify-center mb-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full max-w-5xl">
            <!-- Total Kursus -->
            <a href="{{ route('mentee.courses.index') }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-1 border border-blue-200">
                <div class="flex items-center space-x-4">
                    <div class="bg-blue-100 text-blue-600 p-4 rounded-full text-3xl">📘</div>
                    <div>
                        <p class="text-slate-500 text-sm">Total Kursus</p>
                        <h2 class="text-3xl font-bold text-blue-600">{{ $totalCourses ?? 0 }}</h2>
                    </div>
                </div>
            </a>

            <!-- Tugas Aktif -->
            <a href="{{ route('mentee.assignments.index') }}"
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition hover:-translate-y-1 border border-green-200">
                <div class="flex items-center space-x-4">
                    <div class="bg-green-100 text-green-600 p-4 rounded-full text-3xl">📝</div>
                    <div>
                        <p class="text-slate-500 text-sm">Tugas Aktif</p>
                        <h2 class="text-3xl font-bold text-green-600">{{ $totalAssignments ?? 0 }}</h2>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Pengumuman Terbaru -->
    <div class="max-w-6xl mx-auto bg-white border border-indigo-100 shadow-md rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-slate-800 mb-6 text-center">📢 Pengumuman Terbaru</h2>

        @if ($latestAnnouncements->count())
            <div class="space-y-6">
                @foreach ($latestAnnouncements as $announcement)
                    <div class="relative bg-indigo-50 border-l-4 border-indigo-500 p-5 rounded-xl shadow-sm hover:bg-indigo-100 transition">
                        <p class="text-indigo-900 text-base leading-relaxed font-medium mb-2 line-clamp-3 break-words">
                            {{ $announcement->content }}
                        </p>
                        <span class="absolute top-4 right-5 bg-white border border-indigo-300 text-indigo-700 text-xs font-semibold px-3 py-1 rounded-full shadow-sm">
                            {{ $announcement->created_at->format('d M Y') }}
                        </span>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8">
                <a href="{{ route('mentee.announcements.index') }}"
                   class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:underline transition text-sm">
                    📄 Lihat Semua Pengumuman
                </a>
            </div>
        @else
            <div class="bg-slate-50 text-slate-500 italic text-center py-6 rounded-xl shadow-inner">
                Belum ada pengumuman terbaru.
            </div>
        @endif
    </div>
@endsection
