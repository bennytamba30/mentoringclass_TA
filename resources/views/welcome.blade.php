<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mentoring Class - Tingkatkan Potensimu</title>
     @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0A0A0A; /* Slightly darker for more depth */
            color: #f5f5f5;
        }

        .text-indigo-gradient {
            background: linear-gradient(90deg, #818cf8, #a78bfa);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .dashboard-shadow {
            box-shadow: 0 25px 50px -12px rgba(99, 102, 241, 0.25), 0 0 15px rgba(0, 0, 0, 0.5);
        }

        .nav-link-hover::after {
            content: '';
            display: block;
            width: 0;
            height: 2px;
            background: #818cf8;
            transition: width .3s;
        }

        .nav-link-hover:hover::after {
            width: 100%;
        }

        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in { animation: fadeIn 1s ease-out forwards; }
        .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-400 { animation-delay: 0.4s; }
        .delay-600 { animation-delay: 0.6s; }

        /* Flow diagram active button style */
        .flow-btn.active {
            background-color: #6366f1;
            color: white;
        }

        /* Gallery item transition */
        .gallery-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
    </style>
</head>

<body class="overflow-x-hidden">
    <!-- Header/Navbar -->
    <header class="sticky top-0 left-0 right-0 z-50 bg-slate-950/80 backdrop-blur-lg border-b border-slate-800">
        <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="flex items-center space-x-3">
                <img src="{{ asset('image/LOGO.png') }}" alt="Logo Mentoring Class" class="w-8 h-8 rounded-lg">
                <div class="text-xl font-bold text-slate-100">
                    Mentoring <span class="text-indigo-400">Class</span>
                </div>
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <ul class="flex space-x-8 text-sm font-medium text-gray-300">
                    <li><a href="#about" class="nav-link-hover">Tentang</a></li>
                    <li><a href="#documentation" class="nav-link-hover">Dokumentasi</a></li>
                    <li><a href="#alur" class="nav-link-hover">Alur Sistem</a></li>
                </ul>
                <a href="{{ route('login') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg shadow-indigo-500/20">
                    Login
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path></svg>
                </button>
            </div>
        </nav>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
            <ul class="flex flex-col space-y-4 text-sm font-medium text-gray-300">
                <li><a href="#about" class="block py-2 hover:text-indigo-400">Tentang</a></li>
                <li><a href="#documentation" class="block py-2 hover:text-indigo-400">Dokumentasi</a></li>
                <li><a href="#alur" class="block py-2 hover:text-indigo-400">Alur Sistem</a></li>
            </ul>
            <a href="{{ route('login') }}" class="block mt-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-5 rounded-lg text-center transition-all duration-300">
                Login
            </a>
        </div>
    </header>

    <!-- Hero -->
    <main id="hero-section" class="relative pt-24 pb-12 md:py-32 overflow-hidden">
        <div class="absolute inset-0 -z-10 h-full w-full bg-slate-950 bg-[linear-gradient(to_right,#8080800a_1px,transparent_1px),linear-gradient(to_bottom,#8080800a_1px,transparent_1px)] bg-[size:14px_24px]"></div>
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between">
            <div class="w-full md:w-1/2 text-center md:text-left mb-12 md:mb-0">
                <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 fade-in-up">
                    Belajar dan Berkembang Bersama di <span class="text-indigo-gradient">Mentoring Class</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-400 mb-8 max-w-lg mx-auto md:mx-0 fade-in-up delay-200">
                    Platform resmi HMPS Manajemen Informatika untuk mempermudah proses mentoring. Hubungkan mentor dan mentee dalam satu sistem terintegrasi.
                </p>
                <div class="fade-in-up delay-400">
                    <a href="{{ route('login') }}"
                        class="inline-block bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-10 rounded-lg transition-all duration-300 transform hover:-translate-y-1 shadow-2xl shadow-indigo-500/30">
                        Mulai Sekarang
                    </a>
                </div>
            </div>
            <div class="w-full md:w-1/2 flex justify-center md:justify-end relative fade-in-up delay-600">
                <img src="{{ asset('image/landing.png') }}" alt="Mockup Dashboard Mentoring Class"
                    class="max-w-full h-auto rounded-xl dashboard-shadow object-cover">
            </div>
        </div>
    </main>

    <!-- About Section -->
    <section id="about" class="py-20 bg-slate-900 border-y border-slate-800">
        <div class="container mx-auto px-6 max-w-4xl text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Tentang Mentoring Class</h2>
            <p class="text-gray-400 text-lg leading-relaxed">
                Mentoring Class adalah adalah program dan sistem yang dikembangkan oleh HMPS Manajemen Informatika untuk membantu mahasiswa baru manajemen informatika meningkatkan kemampuan akademik dan soft skill.
                Sistem ini memungkinkan proses belajar-mengajar antara mentor dan mentee berlangsung secara terstruktur, terukur, dan terdokumentasi. Setiap mentee bisa mengakses materi,
                 melihat pengumuman, dan mengerjakan tugas kapan saja dan di mana saja.
            </p>
        </div>
    </section>

    <!-- Documentation Section -->
    <section id="documentation" class="py-20 bg-slate-950">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-12">Dokumentasi Kegiatan Mentoring</h2>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="group rounded-lg overflow-hidden shadow-lg transform transition-transform duration-300 hover:-translate-y-2">
                    <img src="image/pengenalan.jpg" alt="Kegiatan 1" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="p-4 bg-slate-800">
                        <p class="text-sm font-semibold text-gray-300">Sesi Mentoring Pertama - Pengantar dan Perkenalan</p>
                    </div>
                </div>
                <div class="group rounded-lg overflow-hidden shadow-lg transform transition-transform duration-300 hover:-translate-y-2">
                    <img src="image/pembukaan.jpg" alt="Kegiatan 2" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="p-4 bg-slate-800">
                        <p class="text-sm font-semibold text-gray-300">Workshop Penggunaan Sistem Mentoring</p>
                    </div>
                </div>
                <div class="group rounded-lg overflow-hidden shadow-lg transform transition-transform duration-300 hover:-translate-y-2">
                    <img src="https://placehold.co/600x400/312e81/ffffff?text=Evaluasi" alt="Kegiatan 3" class="w-full h-56 object-cover transition-transform duration-300 group-hover:scale-105">
                    <div class="p-4 bg-slate-800">
                        <p class="text-sm font-semibold text-gray-300">Evaluasi dan Refleksi Mentees Minggu ke-4</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Flow Section -->
    <section id="alur" class="py-20 bg-slate-900 border-y border-slate-800">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center mb-4">Alur Sistem Panel</h2>
            <p class="text-center text-gray-400 mb-10 max-w-2xl mx-auto">Tampilan alur visual dari masing-masing panel untuk memahami proses mentoring secara menyeluruh.</p>

            <!-- Filter Buttons -->
            <div class="flex justify-center flex-wrap gap-4 mb-12">
                <button onclick="filterFlow('mentor', this)" class="flow-btn px-5 py-2 text-sm font-semibold text-gray-300 bg-slate-800 hover:bg-slate-700 rounded-md transition">Panel Mentor</button>
                <button onclick="filterFlow('mentee', this)" class="flow-btn px-5 py-2 text-sm font-semibold text-gray-300 bg-slate-800 hover:bg-slate-700 rounded-md transition">Panel Mentee</button>
            </div>

            <!-- Gallery Grid -->
            <div id="flow-gallery" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Mentor Items -->
                <div class="gallery-item group" data-category="mentor">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/dashboard_admin.png" alt="Mentor Dashboard" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Dashboard Utama Mentor</h3></div>
                    </div>
                </div>
                <div class="gallery-item group" data-category="mentor">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/course.png" alt="Mentor Materi" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Manajemen Materi & Tugas</h3></div>
                    </div>
                </div>
                <div class="gallery-item group" data-category="mentor">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/progress.png" alt="Mentor Progres" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Pemantauan Progres Mentee</h3></div>
                    </div>
                </div>

                <!-- Mentee Items -->
                <div class="gallery-item group" data-category="mentee">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/dashboard_mentee.png" alt="Mentee Dashboard" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Dashboard Utama Mentee</h3></div>
                    </div>
                </div>
                <div class="gallery-item group" data-category="mentee">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/image.png" alt="Mentee Materi" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Akses Materi & Pengumpulan Tugas</h3></div>
                    </div>
                </div>
                <div class="gallery-item group" data-category="mentee">
                    <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden transform transition-transform duration-300 hover:-translate-y-2">
                        <img src="image/image1.png" alt="Mentee Progres" class="w-full h-auto object-cover transition-transform duration-300 group-hover:scale-105">
                        <div class="p-4"><h3 class="font-semibold text-white">Melihat Progres Belajar</h3></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-slate-950 text-gray-400 pt-16 pb-10 border-t border-slate-800">
        <div class="container mx-auto px-6 grid md:grid-cols-3 gap-12">
            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Mentoring Class</h3>
                <p class="text-sm leading-relaxed">
                    Platform ini dirancang untuk mempermudah proses bimbingan antara mentor dan mentee secara digital, efisien, dan menyenangkan.
                </p>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Navigasi Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#hero-section" class="hover:text-indigo-400">Beranda</a></li>
                    <li><a href="#about" class="hover:text-indigo-400">Tentang</a></li>
                    <li><a href="#documentation" class="hover:text-indigo-400">Dokumentasi</a></li>
                    <li><a href="{{ route('login') }}" class="hover:text-indigo-400">Login</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white text-lg font-semibold mb-4">Hubungi Kami</h3>
                <ul class="text-sm space-y-3">
                    <li class="flex items-center gap-3">
                        <i class="fas fa-envelope fa-fw"></i>
                        <span>polmedhmpsmi@gmail.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fab fa-instagram fa-fw"></i>
                        <a href="https://www.instagram.com/mipolmed/" class="text-indigo-400 hover:underline">@hmpsmi_polmed</a>
                    </li>
                    <li class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt fa-fw"></i>
                        <span>Kampus Polmed, Gedung MI Lt. 2</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-12 text-center text-xs text-gray-500 border-t border-slate-800 pt-8">
            &copy; 2025 Mentoring Class • HMPS Manajemen Informatika. All rights reserved.
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenuButton.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });

        // Flow gallery filter
        function filterFlow(category, buttonElement) {
            const galleryItems = document.querySelectorAll('#flow-gallery .gallery-item');
            
            // Filter logic
            galleryItems.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.classList.remove('hidden');
                } else {
                    item.classList.add('hidden');
                }
            });

            // Update button styles
            const buttons = document.querySelectorAll('.flow-btn');
            buttons.forEach(btn => {
                btn.classList.remove('active');
                btn.classList.add('bg-slate-800', 'text-gray-300');
            });
            buttonElement.classList.add('active');
            buttonElement.classList.remove('bg-slate-800', 'text-gray-300');
        }

        // Initialize with 'all' shown
        document.addEventListener('DOMContentLoaded', () => {
            filterFlow('all', document.querySelector('.flow-btn.active'));
        });
    </script>
</body>

</html>
