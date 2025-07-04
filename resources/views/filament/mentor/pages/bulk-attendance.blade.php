<x-filament::page>
    <x-filament::form wire:submit="submit" class="space-y-6">

        <x-filament::select
            label="Pilih Pertemuan"
            wire:model="meetingId"
            placeholder="-- Pilih Pertemuan --"
        >
            @foreach ($this->meetings as $meeting)
                <option value="{{ $meeting->id }}">
                    {{ $meeting->title }} ({{ \Carbon\Carbon::parse($meeting->date)->format('d M Y') }})
                </option>
            @endforeach
        </x-filament::select>

        @if ($mentees)
            <div class="space-y-4">
                @foreach ($mentees as $mentee)
                    <x-filament::card>
                        <x-slot name="header">
                            <h3 class="text-lg font-bold">{{ $mentee['name'] }}</h3>
                        </x-slot>

                        <x-filament::select
                            label="Status Kehadiran"
                            wire:model="statuses.{{ $mentee['id'] }}"
                        >
                            <option value="hadir">Hadir</option>
                            <option value="izin">Izin</option>
                            <option value="sakit">Sakit</option>
                            <option value="alfa">Alfa</option>
                        </x-filament::select>

                        <x-filament::textarea
                            label="Catatan (Opsional)"
                            wire:model="notes.{{ $mentee['id'] }}"
                            rows="2"
                        />
                    </x-filament::card>
                @endforeach
            </div>

            <x-filament::button type="submit" color="primary">
                Simpan Absensi
            </x-filament::button>
        @endif

    </x-filament::form>
</x-filament::page>
