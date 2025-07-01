@extends('mentee.layout')

@section('content')
<h1 class="text-3xl font-bold text-slate-800 mb-8 md:hidden">Kursus Saya</h1>

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
    @forelse($courses as $course)
        <a href="{{ route('mentee.courses.show', $course->id) }}"
           class="block bg-white p-6 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition-all duration-300 ease-in-out border border-transparent hover:border-indigo-200">
            <h2 class="text-xl font-semibold text-slate-800 mb-2">{{ $course->title }}</h2>
            <p class="text-sm text-slate-600 line-clamp-3">{{ Str::limit($course->description, 150) }}</p>
            <div class="mt-4 text-sm font-medium text-indigo-600 hover:text-indigo-700">
                Lihat Detail Kursus →
            </div>
        </a>
    @empty
        <div class="col-span-full bg-white p-8 rounded-xl shadow-lg text-center">
            <p class="text-slate-500 text-lg italic">Belum ada kursus yang tersedia saat ini.</p>
            <p class="text-slate-400 text-sm mt-2">Silakan cek kembali nanti atau hubungi administrator.</p>
        </div>
    @endforelse
</div>
@endsection
