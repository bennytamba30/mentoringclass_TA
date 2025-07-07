<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mentoring Class</title>
    {{-- Assuming 'resources/css/app.css' is compiled by Vite/Laravel Mix with Tailwind --}}
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles that aren't easily achieved with direct Tailwind utilities */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0F172A;
            /* Tailwind: bg-slate-900 */
            background-image: radial-gradient(circle at top, #1E293B, #0F172A);
            /* Tailwind: from-slate-800 to-slate-900 for gradient (requires custom config or JIT) */
        }

        .glowing-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 0.75rem;
            /* Tailwind: rounded-xl */
            border: 1px solid transparent;
            background: linear-gradient(45deg, #818CF8, #C084FC) border-box;
            /* Tailwind: from-indigo-400 to-purple-400 (requires custom config or JIT) */
            -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            -webkit-mask-composite: xor;
            mask-composite: exclude;
            z-index: -1;
            opacity: 0.4;
            transition: opacity 0.3s ease-in-out;
            /* Tailwind: transition-opacity duration-300 ease-in-out */
        }

        .glowing-card:hover::before {
            opacity: 0.8;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-20px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .notification {
            animation: slideIn 0.5s ease-out forwards;
        }
    </style>
</head>

<body class="flex items-center justify-center min-h-screen p-4">

    <div class="relative w-full max-w-md">

        @if (session('error'))
            <div class="notification absolute -top-20 left-0 right-0 flex items-center p-4 mb-4 text-sm text-red-200 rounded-lg bg-red-900/50 backdrop-blur-sm border border-red-500/30"
                role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <div>
                    <span class="font-medium">Login Gagal!</span> {{ session('error') }}
                </div>
            </div>
        @endif

        <div
            class="glowing-card relative bg-slate-800/50 backdrop-blur-md p-8 rounded-xl shadow-2xl shadow-indigo-500/10">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-100">Selamat Datang</h1>
                <p class="text-gray-400">Login ke <span class="font-semibold text-indigo-400">Mentoring Class</span></p>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-7" id="login-form">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                        class="w-full px-4 py-2.5 bg-slate-900/80 border border-slate-700 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all"
                        placeholder="nama@email.com">
                    @error('email')
                        <span class="text-sm text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                    <div class="relative">
                        <input type="password" name="password" id="password" required
                            class="w-full px-4 py-2.5 bg-slate-900/80 border border-slate-700 rounded-lg text-gray-200 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all pr-10"
                            placeholder="••••••••">
                        <button type="button" id="toggle-password"
                            class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-indigo-400 transition-colors">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-sm text-red-400 mt-1">{{ $message }}</span>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-lg focus:outline-none focus:ring-4 focus:ring-indigo-500/50 transition-all transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/20">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const passwordInput = document.getElementById('password');
            const togglePasswordButton = document.getElementById('toggle-password');

            togglePasswordButton.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);

                const icon = this.querySelector('i');
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });

            // Optional: Hide notification after a few seconds
            const notification = document.querySelector('.notification');
            if (notification) {
                setTimeout(() => {
                    notification.style.opacity = '0';
                    notification.style.transform = 'translateY(-20px)';
                    setTimeout(() => notification.remove(), 500); // Remove after transition
                }, 5000); // Hide after 5 seconds
            }
        });
    </script>
</body>

</html>
