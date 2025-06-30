@extends('mentee.layout')

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-semibold">{{ $assignment->title }}</h2>
    <p class="text-gray-700 mb-4">{{ $assignment->description }}</p>
    <p class="text-sm text-gray-500 mb-2">🕒 Deadline: {{ $assignment->deadline ?? 'Tidak ditentukan' }}</p>

    @if ($assignment->attachment)
        <a href="{{ asset('storage/' . $assignment->attachment) }}" class="text-blue-600 hover:underline">📎 Unduh Lampiran</a>
    @endif

    <div class="mt-6">
        <a href="{{ route('mentee.submissions.create', $assignment->id) }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Kumpulkan Tugas</a>
    </div>
</div>
@endsection
