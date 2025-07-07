@extends('mentee.layout')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <h2 class="text-2xl font-bold text-slate-800 mb-4">📢 Daftar Pengumuman</h2>

    @forelse($announcements as $ann)
        <a href="{{ route('mentee.announcements.show', $ann->id) }}"
           class="block bg-white p-6 rounded-xl shadow-sm hover:shadow-md transition border border-slate-100">
            <h3 class="text-lg font-semibold text-slate-900 mb-1">{{ $ann->title }}</h3>
            <p class="text-slate-600 text-sm mb-2 line-clamp-2">
                {{ Str::limit(strip_tags($ann->content), 120) }}
            </p>
            <p class="text-xs text-gray-400">
                📅 Dipublikasikan pada {{ $ann->created_at->format('d M Y') }}
            </p>
        </a>
    @empty
        <div class="bg-slate-50 text-center py-10 rounded-xl border border-dashed text-slate-500 italic">
            Belum ada pengumuman yang tersedia.
        </div>
    @endforelse
</div>
@endsection
