@extends('mentee.layout')

@section('content')
<div class="max-w-3xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-slate-100">
    <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2 mb-2">
        📢 <span>{{ $announcement->title }}</span>
    </h2>

    <p class="text-sm text-slate-500 mb-6">
        Dipublikasikan pada {{ $announcement->created_at->format('d M Y') }}
    </p>

    <div class="prose prose-sm prose-slate max-w-none break-words whitespace-pre-wrap max-h-[600px] overflow-auto">
        {!! nl2br(e($announcement->content)) !!}
    </div>

    <div class="mt-6">
        <a href="{{ route('mentee.announcements.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-blue-600 text-white text-sm font-medium shadow hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7" />
            </svg>
            Kembali ke Daftar Pengumuman
        </a>
    </div>
</div>
@endsection
