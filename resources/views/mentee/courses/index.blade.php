@extends('mentee.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @forelse($courses as $course)
        <a href="{{ route('mentee.courses.show', $course->id) }}" class="block p-6 bg-white shadow rounded-lg hover:shadow-md transition">
            <h2 class="text-xl font-semibold">{{ $course->title }}</h2>
            <p class="text-sm text-gray-600 mt-2">{{ Str::limit($course->description, 100) }}</p>
        </a>
    @empty
        <p class="text-gray-500">Belum ada kursus.</p>
    @endforelse
</div>
@endsection
