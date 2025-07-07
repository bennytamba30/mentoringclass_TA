@extends('mentee.layout')

@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-xl rounded-2xl p-6 sm:p-10">
    <h2 class="text-3xl font-bold text-slate-800 mb-6 text-center">⚙️ Pengaturan Akun</h2>

    {{-- Tab Navigation --}}
    <div class="flex justify-center border-b mb-8 space-x-4">
        <button onclick="switchTab('profile-tab')" id="tab-profile"
            class="px-6 py-2 text-sm font-semibold text-blue-600 border-b-2 border-blue-600">
            👤 Profil Saya
        </button>
        <button onclick="switchTab('password-tab')" id="tab-password"
            class="px-6 py-2 text-sm font-semibold text-slate-600 hover:text-blue-600 border-b-2 border-transparent">
            🔒 Ubah Password
        </button>
    </div>

    {{-- Profile Tab --}}
    <div id="profile-tab">
        @if (session('success'))
        <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
            {{ session('success') }}
        </div>
        @endif

        <form action="{{ route('mentee.profile.update') }}" method="POST" enctype="multipart/form-data"
            class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @csrf

            {{-- Photo Upload --}}
            <div class="flex flex-col items-center col-span-1">
                <div class="w-40 h-40 border border-gray-300 rounded-full overflow-hidden">
                    <img id="photo-preview"
                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/default.png') }}"
                        class="w-full h-full object-cover" alt="Foto Profil">
                </div>
                <input type="file" name="photo" accept="image/*"
                    class="mt-3 text-sm border border-gray-300 p-2 rounded-lg w-full"
                    onchange="previewPhoto(event)">
                <div id="file-error" class="hidden mt-2 text-red-600 text-sm"></div>
            </div>

            {{-- Profile Form --}}
            <div class="col-span-1 md:col-span-2 space-y-4">
                @foreach ([['name', 'Nama', $user->name], ['nim', 'NIM', $user->nim], ['kelas', 'Kelas', $user->kelas]] as [$field, $label, $value])
                <div>
                    <label class="text-sm font-medium text-slate-700">{{ $label }}</label>
                    <input type="text" name="{{ $field }}" value="{{ old($field, $value) }}"
                        class="w-full border border-gray-300 p-3 rounded-lg" required>
                </div>
                @endforeach

                <div>
                    <label class="text-sm font-medium text-slate-700">Email</label>
                    <input type="email" value="{{ $user->email }}"
                        class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg" disabled>
                </div>

                <div>
                    <label class="text-sm font-medium text-slate-700">Mentor</label>
                    <input type="text" value="{{ $user->mentor->name ?? '-' }}"
                        class="w-full bg-gray-100 text-gray-500 border border-gray-300 p-3 rounded-lg" disabled>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                    💾 Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    {{-- Password Tab --}}
    <div id="password-tab" class="hidden max-w-xl mx-auto">
        @if (session('password_success'))
        <div class="mb-4 text-green-700 bg-green-100 p-3 rounded">
            {{ session('password_success') }}
        </div>
        @endif

        @if ($errors->any())
        <div class="mb-4 bg-red-100 text-red-800 p-3 rounded">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('mentee.profile.updatePassword') }}" method="POST" class="space-y-4">
            @csrf

            @foreach ([['current_password', 'Password Saat Ini'], ['new_password', 'Password Baru'], ['new_password_confirmation', 'Konfirmasi Password Baru']] as [$field, $label])
            <div class="relative">
                <label class="text-sm font-medium text-slate-700">{{ $label }}</label>
                <input type="password" name="{{ $field }}" id="{{ $field }}"
                    class="w-full border border-gray-300 p-3 rounded-lg pr-10" required>
                <button type="button" onclick="togglePassword('{{ $field }}')"
                    class="absolute right-3 top-9 text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" id="eye-{{ $field }}" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </button>
            </div>
            @endforeach

            <button type="submit"
                class="w-full bg-blue-600 text-white font-semibold py-3 rounded-lg hover:bg-blue-700 transition">
                🔐 Simpan Password Baru
            </button>
        </form>
    </div>
</div>

{{-- JS --}}
<script>
    function previewPhoto(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('photo-preview');
        const errorDiv = document.getElementById('file-error');

        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                errorDiv.innerText = "❌ Ukuran maksimal 2MB.";
                errorDiv.classList.remove('hidden');
                event.target.value = '';
                return;
            }

            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                errorDiv.innerText = "❌ Format harus JPG, JPEG, atau PNG.";
                errorDiv.classList.remove('hidden');
                event.target.value = '';
                return;
            }

            errorDiv.classList.add('hidden');
            preview.src = URL.createObjectURL(file);
        }
    }

    function switchTab(tabId) {
        ['profile-tab', 'password-tab'].forEach(id => {
            document.getElementById(id).classList.add('hidden');
            document.getElementById('tab-' + id.split('-')[0]).classList.remove('border-blue-600', 'text-blue-600');
            document.getElementById('tab-' + id.split('-')[0]).classList.add('text-slate-600');
        });

        document.getElementById(tabId).classList.remove('hidden');
        document.getElementById('tab-' + tabId.split('-')[0]).classList.add('border-blue-600', 'text-blue-600');
        document.getElementById('tab-' + tabId.split('-')[0]).classList.remove('text-slate-600');
    }

    function togglePassword(fieldId) {
        const input = document.getElementById(fieldId);
        const eyeIcon = document.getElementById('eye-' + fieldId);

        if (input.type === 'password') {
            input.type = 'text';
            eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.965 9.965 0 012.642-4.362M6.634 6.634A9.955 9.955 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.974 9.974 0 01-4.097 5.362M3 3l18 18" />`;
        } else {
            input.type = 'password';
            eyeIcon.innerHTML = `
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            `;
        }
    }

    // Auto switch to password tab on error/success
    @if(session('password_success') || $errors->any())
        window.addEventListener('DOMContentLoaded', () => {
            switchTab('password-tab');
        });
    @endif
</script>
@endsection
