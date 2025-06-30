@extends('mentee.layout')

@section('content')
<table class="w-full bg-white shadow rounded">
    <thead class="bg-gray-100 text-left">
        <tr>
            <th class="p-3">Tanggal</th>
            <th class="p-3">Pertemuan</th>
            <th class="p-3">Status</th>
            <th class="p-3">Catatan</th>
        </tr>
    </thead>
    <tbody>
        @forelse($attendances as $att)
            <tr class="border-t">
                <td class="p-3">{{ $att->meeting->date }}</td>
                <td class="p-3">{{ $att->meeting->title }}</td>
                <td class="p-3 capitalize">{{ $att->status }}</td>
                <td class="p-3 text-sm text-gray-600">{{ $att->note ?? '-' }}</td>
            </tr>
        @empty
            <tr><td colspan="4" class="p-4 text-center text-gray-500">Belum ada data absensi.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
