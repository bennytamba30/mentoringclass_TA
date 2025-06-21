@php
    $file = $record->file_path ?? null;
    $ext = pathinfo($file, PATHINFO_EXTENSION);
@endphp
@if (isset($record) && $record->file_path)
    <iframe src="{{ asset('storage/' . $record->file_path) }}" width="100%" height="600px" frameborder="0"></iframe>
@else
    <p>Tidak ada file yang tersedia untuk ditampilkan.</p>
@endif
