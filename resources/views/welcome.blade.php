<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring Class - Tingkatkan Potensimu</title>
    @vite('resources/css/app.css')

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0d0d0d;
            /* Warna latar belakang gelap */
            color: #f5f5f5;
            /* Warna teks terang */
        }

        /* Penyesuaian untuk tombol yang lebih gelap saat hover */
        .btn-dark:hover {
            background-color: #2a2a2a;
        }

        /* Penyesuaian untuk teks biru pada judul */
        .text-blue-modern {
            color: #6366f1;
            /* Warna biru yang modern */
        }

        /* Styling untuk shadownya dashboard */
        .dashboard-shadow {
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5), 0 10px 10px -5px rgba(0, 0, 0, 0.4);
        }

        /* Styling untuk modal overlay */
        /* Catatan: Modal HTML tidak disertakan dalam kode ini, tetapi gaya disiapkan */
        .modal-overlay {
            background-color: rgba(0, 0, 0, 0.7);
        }

        .modal-content {
            background-color: #1a1a1a;
        }

        /* Keyframe untuk animasi fade-in-down */
        @keyframes fade-in-down {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Keyframe untuk animasi fade-in-up */
        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Keyframe untuk animasi fade-in-right */
        @keyframes fade-in-right {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-down {
            animation: fade-in-down 0.8s ease-out forwards;
            animation-delay: 0.2s;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
            animation-delay: 0.4s;
        }

        .animate-fade-in-right {
            animation: fade-in-right 0.8s ease-out forwards;
            animation-delay: 0.6s;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <!-- Header/Navbar -->
    <header class="sticky top-0 left-0 right-0 z-30 bg-slate-900/70 backdrop-blur-lg border-b border-slate-800">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!-- Logo dan Nama Brand -->
            <a href="#" class="flex items-center space-x-3">
                <img src="{{ asset('image/LOGO.png') }}" alt="Logo Mentoring Class" class="w-8 h-8">
                <div class="text-xl font-bold text-slate-100">
                    Mentoring <span class="text-indigo-400">Class</span>
                </div>
            </a>
            <!-- Tombol Login -->
            <div>
                <a href="{{ route('login') }}"
                    class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/20">
                    Login
                </a>
            </div>
        </nav>
    </header>

    <!-- Bagian Hero -->
    <main id="hero-section" class="relative pt-24 pb-12 md:py-32 overflow-hidden">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
            <!-- Konten Kiri (Teks) -->
            <div class="w-full md:w-1/2 text-center md:text-left mb-12 md:mb-0">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 animate-fade-in-down">
                    Belajar dan Berkembang Bersama di <span class="text-blue-modern">Mentoring Class</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-lg mx-auto md:mx-0 animate-fade-in-up">
                    Platform resmi HMPS Manajemen Informatika untuk mempermudah proses mentoring. Di sini, mentor dan
                    mentee terhubung dalam satu sistem untuk belajar,
                    mengakses materi, mengerjakan tugas, dan mencatat progres secara digital.
                </p>
                <!-- Tombol Aksi -->
                <div
                    class="flex flex-col sm:flex-row justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('login') }}"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-10 rounded-lg transition-all duration-300 transform hover:-translate-y-0.5 shadow-lg shadow-indigo-500/20">
                        Login
                    </a>
                </div>
            </div>

            <!-- Konten Kanan (Gambar/Dashboard Mockup) -->
            <div class="w-full md:w-1/2 flex justify-center md:justify-end relative">
                <!-- Gambar mockup dashboard -->
                <img src="{{ asset('image/landing.png') }}" alt="Mockup Dashboard Mentoring Class"
                    class="max-w-full h-auto rounded-xl dashboard-shadow object-cover animate-fade-in-right" </div>
            </div>
    </main>
</body>

</html>
