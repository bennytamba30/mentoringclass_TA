@extends('mentee.layout')

@section('content')
<div class="bg-white shadow rounded-xl p-6">
    <h2 class="text-2xl font-bold text-slate-800 mb-4">📅 Riwayat Absensi</h2>

    <div class="overflow-x-auto">
        <table class="w-full table-auto border-collapse">
            <thead class="bg-slate-100 text-slate-700 text-sm uppercase">
                <tr>
                    <th class="px-4 py-3 text-left">Tanggal</th>
                    <th class="px-4 py-3 text-left">Pertemuan</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Catatan</th>
                </tr>
            </thead>
            <tbody class="text-sm text-slate-700 divide-y divide-slate-100">
                @forelse($attendances as $att)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-4 py-3">{{ \Carbon\Carbon::parse($att->meeting->date)->format('d M Y') }}</td>
                        <td class="px-4 py-3">{{ $att->meeting->title }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-block px-2 py-1 rounded-full text-xs font-semibold capitalize
                                @switch($att->status)
                                    @case('hadir')  @break
                                    @case('izin')  @break
                                    @case('sakit')  @break
                                    @case('alfa')  @break
                                    @default 
                                @endswitch">
                                {{ $att->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-slate-600 italic">{{ $att->note ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-slate-500 italic">
                            Belum ada data absensi.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
