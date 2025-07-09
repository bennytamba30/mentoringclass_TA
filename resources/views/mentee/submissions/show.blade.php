    @extends('mentee.layout')

    @section('content')
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-semibold">{{ $submission->assignment->title }}</h2>
        <p class="text-sm text-gray-600">Dikirim pada: {{ $submission->submitted_at }}</p>

        <div class="mt-4">
            <a href="{{ asset('storage/' . $submission->file) }}" class="text-blue-600 hover:underline">📄 Lihat File</a>
        </div>

        <div class="mt-4">
            <p><strong>Nilai:</strong> {{ $submission->score ?? 'Belum dinilai' }}</p>
            <p><strong>Feedback:</strong></p>
            <p class="text-gray-700">{{ $submission->feedback ?? '-' }}</p>
        </div>
    </div>
    @endsection
