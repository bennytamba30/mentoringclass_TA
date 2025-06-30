@extends('mentee.layout')

@section('content')
<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-800">{{ $course->title }}</h1>
    <p class="text-slate-600 mt-1">{{ $course->description }}</p>
</div>

<!-- Modul -->
<div class="bg-white p-6 rounded-lg shadow mb-8">
    <h2 class="text-lg font-semibold text-slate-700 mb-4">📚 Modul</h2>
    @if ($course->modules->isEmpty())
        <p class="text-slate-500">Belum ada modul untuk kursus ini.</p>
    @else
        <ul class="space-y-3">
            @foreach ($course->modules as $module)
                <li class="p-4 bg-slate-50 rounded-lg">
                    <h3 class="font-medium text-slate-800">{{ $module->title }}</h3>
                    <p class="text-sm text-slate-600">{{ $module->description }}</p>
                    @if ($module->file_path)
                        <a href="{{ asset('storage/' . $module->file_path) }}" target="_blank"
                            class="text-blue-600 text-sm underline mt-1 inline-block">Download Materi</a>
                    @endif
                </li>
            @endforeach
        </ul>
    @endif
</div>

<!-- Tugas -->
<div class="bg-white p-6 rounded-lg shadow">
    <h2 class="text-lg font-semibold text-slate-700 mb-4">📝 Tugas</h2>
    @if ($course->assignments->isEmpty())
        <p class="text-slate-500">Belum ada tugas untuk kursus ini.</p>
    @else
        <ul class="space-y-6">
            @foreach ($course->assignments as $assignment)
                <li class="border-b pb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="font-medium text-slate-800">{{ $assignment->title }}</h3>
                            <p class="text-sm text-slate-600">{{ $assignment->description }}</p>
                            <p class="text-xs text-slate-500">Deadline: {{ $assignment->deadline }}</p>
                        </div>
                        @php
                            $submission = $submissions[$assignment->id] ?? null;
                        @endphp
                        <div class="text-right">
                            @if ($submission)
                                <p class="text-sm text-green-600 font-semibold">Sudah dikumpulkan</p>
                                @if ($submission->score !== null)
                                    <p class="text-sm">Nilai: <span class="font-bold text-blue-600">{{ $submission->score }}</span></p>
                                    <p class="text-sm text-slate-500">Feedback: {{ $submission->feedback ?? '-' }}</p>
                                @else
                                    <p class="text-sm text-yellow-600 italic">Belum dinilai</p>
                                @endif
                                <p class="text-xs mt-1">
                                    File: <a href="{{ asset('storage/' . $submission->file) }}" target="_blank" class="text-blue-600 underline">{{ basename($submission->file) }}</a>
                                </p>
                            @else
                                <!-- Form submit tugas -->
                                <form action="{{ route('mentee.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="mt-2 space-y-2">
                                    @csrf
                                    <input type="file" name="file" required class="block w-full text-sm text-slate-700">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-600 text-white text-sm rounded-lg hover:bg-blue-700">
                                        Kumpulkan Tugas
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
