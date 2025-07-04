@extends('mentee.layout')

@php 
    use Carbon\Carbon;
    $deadlinePassed = $assignment->deadline && Carbon::parse($assignment->deadline)->isPast();
@endphp

@section('content')
<div class="bg-white p-6 shadow rounded">
    <h2 class="text-2xl font-semibold">{{ $assignment->title }}</h2>
    <p class="text-gray-700 mb-4">{{ $assignment->description }}</p>
    <p class="text-sm text-gray-500 mb-2">🕒 Deadline: {{ $assignment->deadline ? $assignment->deadline->format('d M Y H:i') : 'Tidak ditentukan' }}</p>

    @if ($assignment->attachment)
        <a href="{{ asset('storage/' . $assignment->attachment) }}" class="text-blue-600 hover:underline">📎 Unduh Lampiran</a>
    @endif

    <div class="mt-6">
        {{-- ✅ Jika sudah mengumpulkan --}}
        @if ($submission)
            <div class="p-4 bg-green-100 border border-green-400 rounded mb-4">
                <p class="text-green-800 font-medium">
                    ✅ Kamu sudah mengumpulkan tugas ini pada {{ $submission->submitted_at->format('d M Y H:i') }}
                </p>
                <p>
                    <a href="{{ asset('storage/' . $submission->file) }}" class="text-blue-600 hover:underline">
                        📄 Lihat File yang Dikirim
                    </a>
                </p>
                <p class="mt-2">Nilai: <strong>{{ $submission->score ?? 'Belum dinilai' }}</strong></p>
                <p>Feedback: {{ $submission->feedback ?? '-' }}</p>
            </div>

        {{-- ✅ Jika belum mengumpulkan dan deadline belum lewat --}}
        @elseif (!$deadlinePassed)
            <form action="{{ route('mentee.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <label for="file" class="block text-gray-700 font-medium">Unggah File Tugas (PDF, max 2MB)</label>
                <input type="file" name="file" id="file" class="block w-full border rounded p-2" required>

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    Kumpulkan Tugas
                </button>
            </form>
        @endif
    </div>
</div>
@endsection
