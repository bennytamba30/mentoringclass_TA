<div class="space-y-6">

    @if (session()->has('success'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        x-transition
        class="p-4 rounded-md bg-green-100 text-green-800 border border-green-300 shadow-md">
        ✅ {{ session('success') }}
    </div>
@endif

@if (session()->has('error'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
        x-transition
        class="p-4 rounded-md bg-red-100 text-red-800 border border-red-300 shadow-md">
        ❌ {{ session('error') }}
    </div>
@endif


    {{-- ✅ Dropdown Pilih Pertemuan --}}
    <div>
        <label class="block font-semibold text-sm text-slate-700 mb-1">🗓 Pilih Pertemuan</label>
        <select wire:model.lazy="meetingId"
            class="w-full rounded-lg border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm">
            <option value="">-- Pilih Pertemuan --</option>
            @foreach ($meetings as $meeting)
                <option value="{{ $meeting->id }}">{{ $meeting->title }} ({{ $meeting->date }})</option>
            @endforeach
        </select>
    </div>

    {{-- ✅ Form Absensi --}}
    @if ($mentees->isNotEmpty())
        <form wire:submit.prevent="submit" class="space-y-4 mt-6">
            <div class="overflow-x-auto rounded-lg border border-slate-200 shadow-sm">
                <table class="min-w-full text-sm divide-y divide-slate-200">
                    <thead class="bg-slate-100 text-slate-700">
                        <tr>
                            <th class="p-3 text-left font-semibold">Nama</th>
                            <th class="p-3 text-left font-semibold">Status</th>
                            <th class="p-3 text-left font-semibold">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($mentees as $mentee)
                            <tr>
                                <td class="p-3">{{ $mentee->name }}</td>
                                <td class="p-3">
                                    <select wire:model="statuses.{{ $mentee->id }}"
                                        class="w-full rounded border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="hadir">Hadir</option>
                                        <option value="izin">Izin</option>
                                        <option value="sakit">Sakit</option>
                                        <option value="alfa">Alfa</option>
                                    </select>
                                </td>
                                <td class="p-3">
                                    <input type="text" wire:model="notes.{{ $mentee->id }}"
                                        placeholder="Catatan (opsional)"
                                        class="w-full rounded border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- ✅ Tombol Submit --}}
            <div class="text-right">
                <button type="submit"
                    class="bg-indigo-600 hover:bg-indigo-700 text-black px-5 py-2 rounded-md shadow font-medium transition duration-200 ease-in-out">
                    ✅ Simpan Absensi
                </button>
            </div>

        </form>
    @elseif($meetingId)
        <div class="text-slate-500 mt-4 italic">Tidak ada mentee ditemukan untuk pertemuan ini.</div>
    @endif

    {{-- ✅ Tombol Toggle Rekap --}}
    @if ($meetingId && $mentees->isNotEmpty())
        <button wire:click="toggleRecap"
            class="bg-slate-100 border border-slate-300 text-slate-700 px-4 py-2 rounded hover:bg-slate-200 transition font-medium">
            {{ $showRecap ? '⬆️ Tutup Rekap' : '⬇️ Buka Rekap' }}
        </button>
    @else
        <div class="text-slate-500 mt-4 italic">Pilih pertemuan terlebih dahulu.</div>
    @endif

    {{-- ✅ Rekap Absensi --}}
    @if ($showRecap && $meetingId && $mentees->isNotEmpty())
        <div class="mt-8">
            <h3 class="text-lg font-semibold text-slate-800 mb-4">📋 Rekap Absensi</h3>
            <div class="overflow-x-auto rounded-lg border border-slate-200 shadow-sm">
                <table class="min-w-full text-sm divide-y divide-slate-200">
                    <thead class="bg-slate-100 text-slate-700">
                        <tr>
                            <th class="p-3 text-left font-semibold">Nama</th>
                            <th class="p-3 text-left font-semibold">Status</th>
                            <th class="p-3 text-left font-semibold">Catatan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @foreach ($mentees as $mentee)
                            @php
                                $attendance = \App\Models\Attendance::where('meeting_id', $meetingId)
                                    ->where('mentee_id', $mentee->id)
                                    ->first();
                            @endphp
                            <tr>
                                <td class="p-3">{{ $mentee->name }}</td>
                                <td class="p-3 capitalize">
                                    @if ($attendance)
                                        <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full
                                            @switch($attendance->status)
                                                @case('hadir') @break
                                                @case('izin')  @break
                                                @case('sakit')  @break
                                                @case('alfa')  @break
                                                @default 
                                            @endswitch">
                                            {{ $attendance->status }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-3">{{ $attendance->note ?? '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
