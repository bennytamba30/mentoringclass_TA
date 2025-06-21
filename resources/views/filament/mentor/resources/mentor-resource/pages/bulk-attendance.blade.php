<x-filament::page>
    <h2 class="text-xl font-bold mb-4">📝 Absensi Massal</h2>

    <form wire:submit.prevent="save">
        <div class="space-y-4">
            <x-filament::form>
                <x-filament::form.section>
                    <x-slot name="heading">Pilih Pertemuan</x-slot>

                    <x-filament::form.components.select label="Pertemuan" wire:model="selectedMeetingId">
                        <option value="">-- Pilih Pertemuan --</option>
                        @foreach ($meetings as $meeting)
                            <option value="{{ $meeting->id }}">{{ $meeting->title }}</option>
                        @endforeach
                    </x-filament::form.components.select>
                </x-filament::form.section>

                @if ($mentees && $selectedMeetingId)
                    <x-filament::form.section>
                        <x-slot name="heading">Daftar Kehadiran</x-slot>

                        <table class="w-full table-auto text-sm border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="p-2 text-left">Nama Mentee</th>
                                    <th class="p-2 text-left">Status Kehadiran</th>
                                    <th class="p-2 text-left">Catatan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mentees as $mentee)
                                    <tr class="border-t">
                                        <td class="p-2">{{ $mentee->name }}</td>
                                        <td class="p-2">
                                            <select wire:model="attendances.{{ $mentee->id }}.status"
                                                class="w-full border rounded">
                                                <option value="">Pilih</option>
                                                <option value="hadir">Hadir</option>
                                                <option value="izin">Izin</option>
                                                <option value="sakit">Sakit</option>
                                                <option value="alfa">Alfa</option>
                                            </select>
                                        </td>
                                        <td class="p-2">
                                            <input type="text" wire:model="attendances.{{ $mentee->id }}.note"
                                                class="w-full border rounded" placeholder="Catatan (opsional)">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </x-filament::form.section>
                @endif
            </x-filament::form>

            @if ($selectedMeetingId && $mentees)
                <x-filament::button type="submit" color="primary">Simpan Absensi</x-filament::button>
            @endif
        </div>
    </form>
</x-filament::page>
