@extends('mentee.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-8 rounded-2xl shadow-md border border-slate-100">
    <h2 class="text-3xl font-bold text-slate-800 flex items-start gap-3 mb-3">
        📢 <span>{{ $announcement->title }}</span>
    </h2>

    <p class="text-sm text-slate-500 mb-6">
        Dipublikasikan pada <strong>{{ $announcement->created_at->format('d M Y') }}</strong>
    </p>

    <div class="prose prose-base prose-slate max-w-none break-words whitespace-pre-wrap max-h-[600px] overflow-auto">
        {!! nl2br(e($announcement->content)) !!}
    </div>

    <div class="mt-8">
        <a href="{{ route('mentee.announcements.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium shadow hover:bg-indigo-700 transition">
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
