<x-filament::page>
    <h2 class="text-xl font-bold mb-4">Daftar Pertemuan</h2>

    <div class="space-y-4">
        @foreach ($meetings as $meeting)
            <x-filament::card>
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-semibold">{{ $meeting->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $meeting->description }}</p>
                    </div>

                    <a href="{{ route('filament.mentor.resources.courses.create', ['meeting_id' => $meeting->id]) }}"
                        class="inline-flex items-center px-3 py-2 bg-primary-600 text-white rounded-md hover:bg-primary-500">
                        + Tambah Course
                    </a>
                </div>
            </x-filament::card>
        @endforeach
    </div>
</x-filament::page>
