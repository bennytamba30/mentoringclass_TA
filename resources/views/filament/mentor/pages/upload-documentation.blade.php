<x-filament::page>
    <div class="space-y-6">
        <h2 class="text-2xl font-bold tracking-tight">
            Upload Dokumentasi Per Pertemuan
        </h2>

        <div class="bg-white dark:bg-gray-800 p-6 shadow rounded-lg space-y-6">
            {{-- Render form --}}
            {{ $this->form }}

            {{-- Tombol manual, panggil method Livewire --}}
            <x-filament::button wire:click="submit" color="primary">
                Upload
            </x-filament::button>
        </div>
    </div>
</x-filament::page>
