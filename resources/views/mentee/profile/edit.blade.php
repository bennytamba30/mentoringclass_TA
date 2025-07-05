@extends('mentee.layout')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white shadow-xl rounded-2xl p-6 sm:p-10">
    <h2 class="text-3xl font-bold text-slate-800 mb-8 text-center">⚙️ Pengaturan Akun</h2>

    <div class="flex border-b mb-8">
        <button onclick="switchTab('profile-tab')" id="tab-profile"
                class="px-5 py-3 text-sm font-medium text-blue-600 border-b-2 border-blue-600 focus:outline-none">
            👤 Profil Saya
        </button>
        <button onclick="switchTab('password-tab')" id="tab-password"
                class="px-5 py-3 text-sm font-medium text-slate-600 hover:text-blue-600 focus:outline-none">
            🔒 Ubah Password
        </button>
    </div>

    {{-- Profil Tab --}}
    <div id="profile-tab">
        @if (session('success'))
            <div class="mb-6 text-green-800 bg-green-100 border border-green-300 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('mentee.profile.update') }}" method="POST" enctype="multipart/form-data"
              class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
            @csrf

            <div class="flex flex-col items-center gap-4 col-span-1">
                <div class="w-full aspect-square border border-gray-300 rounded-full overflow-hidden bg-gray-100">
                    <img id="photo-preview"
                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.png') }}"
                        alt="Foto Profil"
                        class="w-full h-full object-cover">
                </div>
                <input type="file" name="photo" accept="image/*"
                    class="mt-2 w-full border border-gray-300 file:border-0 file:bg-blue-600 file:text-white file:py-2 file:px-4 file:rounded-lg p-2 rounded-lg"
                    onchange="previewPhoto(event)">
                <div id="file-error" class="hidden mt-2 text-red-600 text-sm font-medium"></div>
            </div>


            <div class="col-span-1 md:col-span-2 space-y-6">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}"
                           class="w-full border border-gray-300 p-3 rounded-lg text-slate-800" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">NIM</label>
                    <input type="text" name="nim" value="{{ old('nim', $user->nim) }}"
                           class="w-full border border-gray-300 p-3 rounded-lg text-slate-800" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kelas</label>
                    <input type="text" name="kelas" value="{{ old('kelas', $user->kelas) }}"
                           class="w-full border border-gray-300 p-3 rounded-lg text-slate-800" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                    <input type="text" value="{{ $user->email }}"
                           class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg" disabled>
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Mentor</label>
                    <input type="text" value="{{ $user->mentor->name ?? '-' }}"
                           class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg" disabled>
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    {{-- Password Tab --}}
    <div id="password-tab" class="hidden">
        @if (session('password_success'))
            <div class="mb-6 text-green-800 bg-green-100 border border-green-300 px-4 py-3 rounded">
                {{ session('password_success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-6 bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded">
                <ul class="list-disc pl-5 space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('mentee.profile.updatePassword') }}" method="POST" class="space-y-6 max-w-2xl">
            @csrf

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
                <input type="password" name="current_password"
                       class="w-full border border-gray-300 p-3 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                <input type="password" name="new_password"
                       class="w-full border border-gray-300 p-3 rounded-lg" required>
            </div>

            <div>
                <label class="block text-sm font-medium text-slate-700 mb-1">Konfirmasi Password Baru</label>
                <input type="password" name="new_password_confirmation"
                       class="w-full border border-gray-300 p-3 rounded-lg" required>
            </div>

            <div>
                <button type="submit"
                        class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                    🔐 Simpan Password Baru
                </button>
            </div>
        </form>
    </div>
</div>

{{-- JS Preview & Tab --}}
<script>
    function previewPhoto(event) {
        const [file] = event.target.files;
        const errorDiv = document.getElementById('file-error');
        const previewImg = document.getElementById('photo-preview');

        if (file) {
            // Validasi ukuran maksimal 2MB
            if (file.size > 2 * 1024 * 1024) {
                errorDiv.innerText = "❌ Ukuran foto maksimal 2MB.";
                errorDiv.classList.remove('hidden');
                event.target.value = "";
                previewImg.src = "{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.png') }}";
                return;
            }

            // Validasi ekstensi file
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            if (!validTypes.includes(file.type)) {
                errorDiv.innerText = "❌ Hanya file JPG, JPEG, atau PNG yang diperbolehkan.";
                errorDiv.classList.remove('hidden');
                event.target.value = "";
                previewImg.src = "{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.png') }}";
                return;
            }

            // Jika lolos semua validasi
            errorDiv.classList.add('hidden');
            previewImg.src = URL.createObjectURL(file);
        }
    }

    function switchTab(tabId) {
        const tabs = ['profile-tab', 'password-tab'];
        tabs.forEach(id => {
            document.getElementById(id).classList.add('hidden');
            document.getElementById('tab-' + id.split('-')[0]).classList.remove('border-blue-600', 'text-blue-600');
            document.getElementById('tab-' + id.split('-')[0]).classList.add('text-slate-600');
        });

        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById('tab-' + tabId.split('-')[0]).classList.add('border-blue-600', 'text-blue-600');
        document.getElementById('tab-' + tabId.split('-')[0]).classList.remove('text-slate-600');
    }
</script>

@endsection
