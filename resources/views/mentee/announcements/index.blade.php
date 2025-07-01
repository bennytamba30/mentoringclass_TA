@extends('mentee.layout')

@section('content')
<div class="space-y-4">
    @forelse($announcements as $ann)
        <a href="{{ route('mentee.announcements.show', $ann->id) }}" class="block bg-white p-5 shadow rounded hover:shadow-md">
            <h3 class="text-lg font-semibold">{{ $ann->title }}</h3>
            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($ann->content, 100) }}</p>
            <p class="text-xs text-gray-400 mt-1">
                Dipublikasikan pada {{ $ann->created_at->format('d M Y') }}
            </p>
        </a>
    @empty
        <p class="text-gray-500">Belum ada pengumuman.</p>
    @endforelse
</div>
@endsection
