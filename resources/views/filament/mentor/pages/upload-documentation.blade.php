<x-filament::page>
    <div class="space-y-6">

        {{-- Tombol ganti tab manual --}}
        <div class="flex gap-3">
            <x-filament::button wire:click="$set('viewingHistory', false)" :color="$viewingHistory ? 'gray' : 'primary'">
                Upload Dokumentasi
            </x-filament::button>

            <x-filament::button wire:click="$set('viewingHistory', true)" :color="$viewingHistory ? 'primary' : 'gray'">
                Riwayat Dokumentasi
            </x-filament::button>
        </div>

        {{-- Upload Form --}}
        @unless ($viewingHistory)
            <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg space-y-6">
                {{ $this->form }}

                <x-filament::button wire:click="submit" color="primary">
                    Upload
                </x-filament::button>
            </div>
        @endunless

        {{-- Riwayat --}}
        @if ($viewingHistory)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
                @forelse ($this->documentations as $doc)
                    <div class="bg-white dark:bg-gray-800 rounded shadow p-4">
                        <div class="mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                            Pertemuan: {{ $doc->meeting->title ?? '-' }}
                        </div>
                        <img src="{{ asset('storage/' . $doc->image_path) }}" alt="Dokumentasi"
                             class="rounded-md w-full h-40 object-cover">
                        <div class="mt-2 text-xs text-gray-500">
                            Diupload pada {{ \Carbon\Carbon::parse($doc->created_at)->format('d M Y H:i') }}
                        </div>
                    </div>
                @empty
                    <p class="text-gray-600 dark:text-gray-300">Belum ada dokumentasi yang diunggah.</p>
                @endforelse
            </div>
        @endif
    </div>
</x-filament::page>
