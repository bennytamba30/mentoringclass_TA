<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mentoring Class</title>
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Memuat Font Awesome untuk ikon mata -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d;
            /* Warna latar belakang gelap */
            color: #f5f5f5;
            /* Warna teks terang */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            /* Pastikan halaman mengisi tinggi viewport */
            /* Menambahkan sedikit gradien radial untuk kesan lebih dalam */
            background: radial-gradient(circle at center, #1a1a1a, #0d0d0d);
            overflow: hidden; /* Penting untuk memastikan glow tidak menyebabkan scroll */
        }

        .login-card {
            position: relative; /* Penting untuk positioning pseudo-element */
            background-color: #1a1a1a;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.7), 0 10px 10px -5px rgba(0, 0, 0, 0.4);
            /* Shadow lebih dalam */
            padding: 2.5rem;
            /* Menambah padding sedikit */
            border-radius: 1rem;
            /* Lebih melengkung */
            border: 1px solid rgba(99, 102, 241, 0.2);
            /* Border tipis biru */
            transition: transform 0.3s ease-in-out;
            /* Transisi untuk interaktivitas */
            overflow: hidden; /* Memastikan glow tidak meluber keluar dari batas card */
            z-index: 1; /* Pastikan konten kartu di atas glow */
        }

        .login-card:hover {
            transform: translateY(-5px);
            /* Sedikit naik saat hover */
        }

        /* Gaya untuk efek glow ungu */
        .login-card::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 250%; /* Perbesar untuk efek glow yang lebih luas */
            height: 250%;
            background: radial-gradient(circle at center, rgba(168, 85, 247, 0.6), rgba(139, 92, 246, 0.4), transparent 70%); /* Gradien ungu terang */
            filter: blur(150px); /* Semakin blur, semakin besar dan lembut glow-nya */
            transform: translate(-50%, -50%); /* Posisikan di tengah */
            z-index: -1; /* Letakkan di belakang konten kartu */
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out; /* Transisi untuk interaktivitas glow */
            opacity: 0.8; /* Opasitas awal */
            pointer-events: none; /* Penting agar tidak mengganggu interaksi mouse */
        }

        .login-card:hover::before {
            transform: translate(-50%, -50%) scale(1.05); /* Sedikit membesar saat hover */
            opacity: 1; /* Lebih terang saat hover */
        }


        .text-blue-modern {
            color: #6366f1;
            /* Warna biru yang modern */
        }

        .input-field {
            background-color: #2a2a2a;
            border: 1px solid #3a3a3a;
            color: #f5f5f5;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            /* Transisi untuk focus */
            padding-left: 1.25rem;
            padding-right: 1.25rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
            border-radius: 0.5rem;
            width: 100%;
        }

        .input-field:focus {
            outline: none;
            border-color: #6366f1;
            /* Border biru saat focus */
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.4);
            /* Ring biru saat focus */
        }

        .submit-button {
            background-color: #6366f1;
            /* Warna biru modern */
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 10px rgba(99, 102, 241, 0.4);
            /* Shadow untuk tombol */
        }

        .submit-button:hover {
            background-color: #4f46e5;
            /* Biru lebih gelap saat hover */
            transform: translateY(-2px);
            /* Sedikit naik saat hover */
            box-shadow: 0 6px 15px rgba(99, 102, 241, 0.6);
            /* Shadow lebih besar saat hover */
        }

        .password-input-container {
            position: relative;
            /* Penting untuk penempatan ikon */
        }

        .toggle-password-icon {
            position: absolute;
            right: 0.75rem;
            /* px-3 */
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #9ca3af;
            /* gray-400 */
            transition: color 0.2s ease;
        }

        .toggle-password-icon:hover {
            color: #f5f5f5;
            /* white */
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <div class="login-card w-full max-w-md mx-4">
        <h2 class="text-4xl font-bold text-white text-center mb-10">
            Login ke <span class="text-blue-modern">Mentoring Class</span>
        </h2>

        <!-- Form utama untuk login -->
        <form method="POST" action="{{ route('login') }}" class="space-y-7">
            @csrf

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input type="email" name="email" id="email" required class="input-field"
                    placeholder="Masukkan email Anda">
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <div class="password-input-container">
                    <input type="password" name="password" id="password" required class="input-field pr-10"
                        placeholder="Masukkan password Anda"> <!-- Menambah pr-10 untuk ikon -->
                    <span class="toggle-password-icon" id="toggle-password">
                        <i class="fas fa-eye"></i> <!-- Ikon mata terbuka -->
                    </span>
                </div>
            </div>

            <!-- Tombol Login -->
            <button type="submit"
                class="w-full submit-button text-white font-semibold py-3 px-4 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-modern focus:ring-opacity-50">
                Login
            </button>
        </form>
    </div>

    <script>
        const passwordInput = document.getElementById('password');
        const togglePassword = document.getElementById('toggle-password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);

            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
</body>

</html>
