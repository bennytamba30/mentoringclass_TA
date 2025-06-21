<x-filament::page>
    <h2 class="text-xl font-bold mb-4">📊 Laporan Absensi</h2>
    <h1>Pertemuan {{ $this->meeting->title }}</h1>
    <table class="w-full text-sm border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Pertemuan</th>
                <th class="p-2 text-left">Mentee</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Catatan</th>
                <th class="p-2 text-left">Waktu Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->attendances as $attendance)
                <tr class="border-t">
                    <td class="p-2">{{ $attendance->meeting->title ?? '-' }}</td>
                    <td class="p-2">{{ $attendance->mentee->name ?? '-' }}</td>
                    <td class="p-2">
                        @switch($attendance->status)
                            @case('hadir')
                                ✅ Hadir
                            @break

                            @case('izin')
                                🟡 Izin
                            @break

                            @case('sakit')
                                🔵 Sakit
                            @break

                            @case('alfa')
                                ❌ Alfa
                            @break

                            @default
                                -
                        @endswitch
                    </td>
                    <td class="p-2">{{ $attendance->note ?? '-' }}</td>
                    <td class="p-2">{{ $attendance->created_at?->format('d M Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
