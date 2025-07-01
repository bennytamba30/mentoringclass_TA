@extends('mentee.layout')

@section('content')
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between">
        <!-- Back Button -->
        <a href="{{ route('mentee.courses.index') }}"
            class="inline-flex items-center px-4 py-2 bg-indigo-500 text-white rounded-lg shadow-md hover:bg-indigo-600 transition duration-300 mb-4 md:mb-0">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke Daftar Kursus
        </a>

        <!-- Course Title & Description -->
        <div class="md:text-right">
            <h1 class="text-3xl font-bold text-slate-800">{{ $course->title }}</h1>
            <p class="text-slate-600 mt-1">{{ $course->description }}</p>
        </div>
    </div>

    <!-- Modul Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
        <h2 class="text-2xl font-semibold text-slate-700 mb-5 border-b pb-3">📚 Modul Pembelajaran</h2>
        @if ($course->modules->isEmpty())
            <p class="text-slate-500 italic py-4 text-center">Belum ada modul untuk kursus ini.</p>
        @else
            <ul class="space-y-4">
                @foreach ($course->modules as $module)
                    <li
                        class="bg-slate-50 p-5 rounded-lg border border-slate-100 hover:bg-slate-100 transition duration-200 shadow-sm">
                        <h3 class="font-bold text-lg text-slate-800 mb-1">{{ $module->title }}</h3>
                        <p class="text-sm text-slate-600 mb-2">{{ $module->description }}</p>
                        @if ($module->file_path)
                            <a href="{{ asset('storage/' . $module->file_path) }}" target="_blank"
                                class="inline-flex items-center text-blue-600 text-sm font-medium hover:underline hover:text-blue-700 transition duration-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                </svg>
                                Download Materi
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <!-- Tugas Section -->
    <div class="bg-white p-6 rounded-xl shadow-lg">
        <h2 class="text-2xl font-semibold text-slate-700 mb-5 border-b pb-3">📝 Tugas Kursus</h2>
        @if ($course->assignments->isEmpty())
            <p class="text-slate-500 italic py-4 text-center">Belum ada tugas untuk kursus ini.</p>
        @else
            <ul class="space-y-6">
                @foreach ($course->assignments as $assignment)
                    <li class="border-b border-slate-200 pb-6 last:border-b-0 last:pb-0">
                        <div class="flex flex-col md:flex-row md:items-start justify-between">
                            <div class="mb-4 md:mb-0 md:w-3/5">
                                <h3 class="font-bold text-lg text-slate-800 mb-1">{{ $assignment->title }}</h3>
                                <p class="text-sm text-slate-600 mb-2">{{ $assignment->description }}</p>
                                <p class="text-xs text-slate-500">Deadline: <span
                                        class="font-medium">{{ $assignment->deadline }}</span></p>
                            </div>

                            @php
                                $submission = $submissions[$assignment->id] ?? null;
                            @endphp

                            <div class="md:w-2/5 md:pl-6 text-left md:text-right">
                                @if ($submission)
                                    <p class="text-sm text-green-600 font-semibold mb-1">Sudah dikumpulkan ✅</p>
                                    @if ($submission->score !== null)
                                        <p class="text-sm">Nilai: <span
                                                class="font-bold text-blue-600 text-base">{{ $submission->score }}</span>
                                        </p>
                                        <p class="text-sm text-slate-500">Feedback: {{ $submission->feedback ?? '-' }}</p>
                                    @else
                                        <p class="text-sm text-yellow-600 italic">Belum dinilai...</p>
                                    @endif
                                    <p class="text-xs mt-2">
                                        File: <a href="{{ asset('storage/' . $submission->file) }}" target="_blank"
                                            class="text-blue-600 underline hover:text-blue-700 break-all">{{ basename($submission->file) }}</a>
                                    </p>
                                @else
                                    <!-- Form submit tugas -->
                                    <form action="{{ route('mentee.assignments.submit', $assignment->id) }}" method="POST"
                                        enctype="multipart/form-data" class="mt-2 space-y-3">
                                        @csrf
                                        <label class="block">
                                            <span class="sr-only">Choose file</span>
                                            <input type="file" name="file" required
                                                class="block w-full text-sm text-slate-700
                                                   file:mr-4 file:py-2 file:px-4
                                                   file:rounded-full file:border-0
                                                   file:text-sm file:font-semibold
                                                   file:bg-indigo-50 file:text-indigo-700
                                                   hover:file:bg-indigo-100 cursor-pointer" />
                                        </label>
                                        <button type="submit"
                                            class="w-full md:w-auto px-5 py-2 bg-indigo-600 text-white text-base font-semibold rounded-lg hover:bg-indigo-700 transition duration-300 shadow-md">
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
