@extends('mentee.layout')

@section('content')
<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100">
        <tr>
            <th class="p-3">Tugas</th>
            <th class="p-3">Dikirim</th>
            <th class="p-3">Nilai</th>
            <th class="p-3">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($submissions as $sub)
            <tr class="border-t">
                <td class="p-3">{{ $sub->assignment->title }}</td>
                <td class="p-3">{{ $sub->submitted_at ?? '-' }}</td>
                <td class="p-3">{{ $sub->score ?? 'Belum dinilai' }}</td>
                <td class="p-3">
                    <a href="{{ route('mentee.submissions.show', $sub->id) }}" class="text-blue-600 hover:underline text-sm">Lihat</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-500">Belum ada pengumpulan.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
