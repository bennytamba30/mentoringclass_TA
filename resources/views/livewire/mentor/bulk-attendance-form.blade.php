<div class="space-y-6">
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

    <div>
        <label class="block font-medium text-sm text-gray-700">Pilih Pertemuan</label>
        <select wire:model="meetingId" class="mt-1 block w-full rounded border-gray-300 shadow-sm">
            <option value="">-- Pilih Pertemuan --</option>
            @foreach ($meetings as $meeting)
                <option value="{{ $meeting->id }}">{{ $meeting->title }} ({{ $meeting->date }})</option>
            @endforeach
        </select>
    </div>

    @if ($mentees && $meetingId)
        <form wire:submit.prevent="submit" class="space-y-4">
            <table class="min-w-full border border-gray-300 rounded">
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
                                <select wire:model="statuses.{{ $mentee->id }}" class="w-full rounded border-gray-300">
                                    <option value="hadir">Hadir</option>
                                    <option value="izin">Izin</option>
                                    <option value="sakit">Sakit</option>
                                    <option value="alfa">Alfa</option>
                                </select>
                            </td>
                            <td class="p-2 border">
                                <input type="text" wire:model="notes.{{ $mentee->id }}" class="w-full rounded border-gray-300" placeholder="Catatan (opsional)">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button type="submit" class="px-4 py-2 bg-amber-500 text-white rounded hover:bg-amber-600">
                Simpan Absensi
            </button>
        </form>
    @elseif($meetingId)
        <div class="text-center text-gray-500 mt-4">
            Tidak ada mentee ditemukan untuk mentor ini.
        </div>
    @endif
</div>
