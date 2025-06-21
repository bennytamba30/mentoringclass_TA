<x-filament::page>
    <h2 class="text-xl font-bold mb-4">📄 Laporan Tugas</h2>

    <table class="w-full text-sm border border-gray-200">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Tugas</th>
                <th class="p-2 text-left">Course</th>
                <th class="p-2 text-left">Mentee</th>
                <th class="p-2 text-left">Status</th>
                <th class="p-2 text-left">Nilai</th>
                <th class="p-2 text-left">Tanggal Kirim</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($this->submissions as $submission)
                <tr class="border-t">
                    <td class="p-2">{{ $submission->assignment->title ?? '-' }}</td>
                    <td class="p-2">{{ $submission->assignment->course->title ?? '-' }}</td>
                    <td class="p-2">{{ $submission->mentee->name ?? '-' }}</td>
                    <td class="p-2">
                        @if ($submission->submitted_at)
                            ✅ Terkumpul
                        @else
                            ❌ Belum
                        @endif
                    </td>
                    <td class="p-2">{{ $submission->score ?? '-' }}</td>
                    <td class="p-2">{{ $submission->submitted_at?->format('d M Y H:i') ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-filament::page>
