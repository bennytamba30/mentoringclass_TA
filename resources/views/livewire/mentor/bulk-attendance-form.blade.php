<div class="space-y-6">
    {{-- Flash Messages --}}
    @if (session()->has('success'))
        <div class="p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session()->has('error'))
        <div class="p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Pilih Pertemuan --}}
    <div>
        <label class="block font-medium text-sm text-gray-700">Pilih Pertemuan</label>
        <select wire:model.lazy="meetingId" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">-- Pilih Pertemuan --</option>
            @foreach ($meetings as $meeting)
                <option value="{{ $meeting->id }}">{{ $meeting->title }} ({{ $meeting->date }})</option>
            @endforeach
        </select>
    </div>

    {{-- Form Absensi --}}
    @if ($mentees->isNotEmpty())
        <form wire:submit.prevent="submit" class="space-y-4 mt-6">
            <table class="min-w-full border border-gray-300 rounded text-sm">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="p-2 border text-left">Nama</th>
                        <th class="p-2 border text-left">Status</th>
                        <th class="p-2 border text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mentees as $mentee)
                        <tr>
                            <td class="p-2 border">{{ $mentee->name }}</td>
                            <td class="p-2 border">
                                <select wire:model="statuses.{{ $mentee->id }}"
                                    class="w-full rounded border-gray-300">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alfa">Alfa</option>
                                </select>
                            </td>
                            <td class="p-2 border">
                                <input type="text" wire:model="notes.{{ $mentee->id }}"
                                    class="w-full rounded border-gray-300" placeholder="Catatan (opsional)">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="border p-4 bg-blue-900">
                <button type="submit"
                    class="bg-primary-600 hover:bg-primary-700 text-white px-4 py-2 rounded text-sm">Submit</button>
            </div>
        </form>
    @elseif($meetingId)
        <div class="text-gray-500 mt-4">Tidak ada mentee ditemukan.</div>
    @endif
    {{-- Tombol Buka Rekap --}}
    @if ($meetingId && $mentees->isNotEmpty())
        <button wire:click="toggleRecap"
            class="bg-slate-200 text-slate-800 px-4 py-2 rounded hover:bg-slate-300 transition">
            {{ $showRecap ? 'Tutup Rekap' : 'Buka Rekap' }}
        </button>
    @else
        <div class="text-gray-500 mt-4">Pilih pertemuan terlebih dahulu.</div>
    @endif

    {{-- Rekap Absensi --}}
    @if ($showRecap && $meetingId && $mentees->isNotEmpty())
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-slate-800 mb-3">📋 Rekap Absensi</h3>

            <table class="min-w-full border border-gray-300 text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-2 border text-left">Nama</th>
                        <th class="p-2 border text-left">Status</th>
                        <th class="p-2 border text-left">Catatan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mentees as $mentee)
                        @php
                            $attendance = \App\Models\Attendance::where('meeting_id', $meetingId)
                                ->where('mentee_id', $mentee->id)
                                ->first();
                        @endphp
                        <tr>
                            <td class="p-2 border">{{ $mentee->name }}</td>
                            <td class="p-2 border capitalize">
                                @if ($attendance)
                                    <span
                                        class="px-2 py-1 rounded text-xs font-semibold
                                        @if ($attendance->status === 'hadir') @elseif($attendance->status === 'izin') 
                                        @elseif($attendance->status === 'sakit') 
                                        @elseif($attendance->status === 'alfa') @endif">
                                        {{ $attendance->status }}
                                    </span>
                                @else
                                    <span class="text-gray-400">-</span>
                                @endif
                            </td>
                            <td class="p-2 border">{{ $attendance->note ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
