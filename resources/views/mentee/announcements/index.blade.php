@extends('mentee.layout')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <h2 class="text-3xl font-bold text-slate-800 mb-6">📢 Pengumuman Terbaru</h2>

    @forelse($announcements as $ann)
        <a href="{{ route('mentee.announcements.show', $ann->id) }}"
           class="block bg-white p-6 rounded-xl shadow-sm hover:shadow-md hover:border-slate-200 transition border border-slate-100 group">
            <h3 class="text-xl font-semibold text-slate-900 mb-1 group-hover:text-indigo-600 transition">
                {{ $ann->title }}
            </h3>
            <p class="text-slate-600 text-sm mb-2 line-clamp-2">
                {{ Str::limit(strip_tags($ann->content), 120) }}
            </p>
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span>📅 {{ $ann->created_at->format('d M Y') }}</span>
                <span class="text-indigo-500 font-medium group-hover:underline">Lihat detail →</span>
            </div>
        </a>
    @empty
        <div class="bg-slate-50 text-center py-12 rounded-xl border border-dashed text-slate-500 italic">
            Belum ada pengumuman yang tersedia.
        </div>
    @endforelse
</div>
@endsection
