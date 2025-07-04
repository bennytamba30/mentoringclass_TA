@extends('mentee.layout')

@section('content')
<div class="max-w-4xl mx-auto bg-white shadow-xl p-6 sm:p-10 rounded-2xl mt-10">
    <h2 class="text-3xl font-bold text-slate-800 mb-10 text-center">⚙️ Pengaturan Profil</h2>

    @if (session('success'))
        <div class="mb-6 text-green-800 bg-green-100 border border-green-300 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('mentee.profile.update') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
        @csrf

        {{-- Foto Profil --}}
        <div class="flex flex-col items-center gap-4 col-span-1">
            <div class="w-full aspect-square border border-gray-300 rounded-lg overflow-hidden bg-gray-100">
                <img id="photo-preview"
                     src="{{ $user->photo ? asset('storage/' . $user->photo) : 'https://via.placeholder.com/300x300?text=Foto' }}"
                     alt="Foto Profil"
                     class="w-full h-full object-cover">
            </div>

            <input type="file" name="photo" accept="image/*"
                   class="mt-2 w-full border border-gray-300 file:border-0 file:bg-blue-600 file:text-white file:py-2 file:px-4 file:rounded-lg p-2 rounded-lg"
                   onchange="previewPhoto(event)">
        </div>

        {{-- Biodata --}}
        <div class="col-span-1 md:col-span-2 space-y-6">
            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                       class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 p-3 rounded-lg text-slate-800"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">NIM</label>
                <input type="text" name="nim" value="{{ old('nim', $user->nim) }}"
                       class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 p-3 rounded-lg text-slate-800"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
                <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}"
                       class="w-full border border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200/50 p-3 rounded-lg text-slate-800"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                <input type="text" value="{{ $user->email }}"
                       class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg cursor-not-allowed"
                       disabled>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Mentor</label>
                <input type="text" value="{{ $user->mentor->name ?? '-' }}"
                       class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg cursor-not-allowed"
                       disabled>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </div>
    </form>
</div>

{{-- Script Preview Foto --}}
<script>
    function previewPhoto(event) {
        const [file] = event.target.files;
        if (file) {
            const preview = document.getElementById('photo-preview');
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
@endsection
