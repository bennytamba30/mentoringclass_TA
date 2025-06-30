<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring Class - Tingkatkan Potensimu</title>
    <!-- Memuat Tailwind CSS dari CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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
    <header class="bg-transparent absolute top-0 left-0 right-0 z-10 p-6">
        <nav class="container mx-auto flex justify-between items-center">
            <!-- Logo -->
            <div class="text-2xl font-bold text-white">
                Mentoring <span class="text-blue-modern">Class</span>
            </div>
            <!-- Tombol Login -->
            <div class="block">
                <a href="{{ route('login') }}"
                    class="inline-block bg-blue-modern hover:bg-indigo-700 text-white font-semibold py-2 px-6 rounded-lg transition duration-300">
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
                    Tingkatkan Potensimu dengan <br> Kelas Mentoring <br> <span
                        class="text-blue-modern">Berkualitas</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-lg mx-auto md:mx-0 animate-fade-in-up">
                    Mentoring Class adalah platform inovatif yang menghubungkan Anda dengan mentor ahli untuk membimbing
                    perjalanan belajar Anda. Akses materi eksklusif, sesi interaktif, dan laporan kemajuan terperinci.
                </p>
                <!-- Tombol Aksi -->
                <div
                    class="flex flex-col sm:flex-row justify-center md:justify-start space-y-4 sm:space-y-0 sm:space-x-4">
                    <!-- Menggunakan fungsi route() Laravel untuk menghasilkan URL dari nama rute -->
                    <a href="{{ route('login') }}"
                        class="inline-block bg-gray-800 btn-dark text-white font-semibold py-3 px-8 rounded-xl transition duration-300 border border-gray-700 text-center">
                        Log in
                    </a>
                </div>
            </div>

            <!-- Konten Kanan (Gambar/Dashboard Mockup) -->
            <div class="w-full md:w-1/2 flex justify-center md:justify-end relative">
                <!-- Gambar mockup dashboard -->
                <img src="{{ asset('images/test.ARW') }}" alt="Mockup Dashboard Mentoring Class"
                    class="max-w-full h-auto rounded-xl dashboard-shadow object-cover animate-fade-in-right"
                    onerror="this.src='https://placehold.co/700x500/1a1a1a/cccccc?text=Mockup+Dashboard+Error'">
            </div>
        </div>
    </main>
</body>

</html>
