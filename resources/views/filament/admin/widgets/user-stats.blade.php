<x-filament::widget>
    <x-filament::card>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="p-4 bg-white rounded-lg shadow text-center">
                <div class="text-xl font-bold text-blue-600">{{ $totalMentors }}</div>
                <div class="text-gray-700 mt-1">Total Mentor</div>
            </div>
            <div class="p-4 bg-white rounded-lg shadow text-center">
                <div class="text-xl font-bold text-green-600">{{ $totalMentees }}</div>
                <div class="text-gray-700 mt-1">Total Mentee</div>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>
