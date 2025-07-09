@extends('mentee.layout')

@section('content')
@php
    use Carbon\Carbon;
@endphp


@if (Carbon::parse($assignment->deadline)->isFuture())
    <form action="{{ route('mentee.submissions.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
        @csrf
        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

        <label for="file" class="block font-semibold mb-2">Upload Jawaban</label>
        <input type="file" name="file" id="file" class="border p-2 rounded w-full mb-4" required>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
            Kirim Tugas
        </button>
    </form>
@else
    <div class="bg-red-100 text-red-700 p-4 rounded shadow">
        ⛔ Maaf, deadline pengumpulan tugas ini sudah lewat.
    </div>
@endif
@endsection
