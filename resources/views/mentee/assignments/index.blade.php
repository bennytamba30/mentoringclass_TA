@extends('mentee.layout')

@section('content')
<div class="space-y-4">
    @forelse($assignments as $assignment)
        <a href="{{ route('mentee.assignments.show', $assignment->id) }}" class="block bg-white p-5 shadow rounded hover:shadow-md transition">
            <h3 class="text-lg font-semibold">{{ $assignment->title }}</h3>
            <p class="text-sm text-gray-600">{{ Str::limit($assignment->description, 100) }}</p>
            <p class="text-sm text-gray-500 mt-1">🕒 Deadline: {{ $assignment->deadline ?? 'Tidak ditentukan' }}</p>
        </a>
    @empty
        <p class="text-gray-500">Belum ada tugas.</p>
    @endforelse
</div>
@endsection
