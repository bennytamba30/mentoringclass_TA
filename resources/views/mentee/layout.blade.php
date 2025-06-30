<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard Mentee' }}</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts - Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }
        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f0f2f5; /* Light grey background for track */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; /* Slate-300 equivalent for thumb */
            border-radius: 10px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; /* Slate-400 equivalent on hover */
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800 antialiased">
    <div class="flex flex-col md:flex-row min-h-screen">

        <!-- Sidebar Desktop & Mobile -->
        @include('mentee.partials.sidebar')

        <!-- Mobile Sidebar Overlay (active only on small screens) -->
        <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden md:hidden"></div>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header for both Mobile & Desktop -->
            @include('mentee.partials.header')

            <!-- Main Content Container -->
            <main class="flex-1 p-6 md:p-8 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        // Sidebar toggle
        const menuToggle = document.getElementById('menuToggle');
        const closeSidebar = document.getElementById('closeSidebar');
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebar-overlay'); // Get the new overlay element

        function openSidebar() {
            if (sidebar) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            }
            if (sidebarOverlay && window.innerWidth < 768) { // Only show overlay on mobile
                sidebarOverlay.classList.remove('hidden');
            }
        }

        function closeSidebarHandler() {
            if (sidebar) {
                sidebar.classList.remove('translate-x-0');
                sidebar.classList.add('-translate-x-full');
            }
            if (sidebarOverlay) {
                sidebarOverlay.classList.add('hidden');
            }
        }

        if (menuToggle) {
            menuToggle.addEventListener('click', openSidebar);
        }
        if (closeSidebar) {
            closeSidebar.addEventListener('click', closeSidebarHandler);
        }
        if (sidebarOverlay) {
            sidebarOverlay.addEventListener('click', closeSidebarHandler); // Close sidebar when clicking overlay
        }

        // Close sidebar when clicking outside on mobile (redundant with overlay click, but kept for robustness)
        document.addEventListener('click', (event) => {
            if (sidebar && menuToggle && !sidebar.classList.contains('-translate-x-full') &&
                !sidebar.contains(event.target) &&
                !menuToggle.contains(event.target) &&
                window.innerWidth < 768
            ) {
                closeSidebarHandler();
            }
        });

        // Close sidebar on desktop if resized from mobile
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) { // md breakpoint
                if (sidebar) {
                    sidebar.classList.remove('-translate-x-full');
                    sidebar.classList.add('translate-x-0');
                }
                if (sidebarOverlay) { // Hide overlay on desktop
                    sidebarOverlay.classList.add('hidden');
                }
            } else {
                if (sidebar) {
                    sidebar.classList.add('-translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                }
                // When resizing to mobile, overlay should be hidden initially
                if (sidebarOverlay) {
                    sidebarOverlay.classList.add('hidden');
                }
            }
        });

        // Initial check for desktop view on load
        if (window.innerWidth >= 768) {
            if (sidebar) {
                sidebar.classList.remove('-translate-x-full');
                sidebar.classList.add('translate-x-0');
            }
        }

        // Profile Dropdown Toggle
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        if (profileButton) {
            profileButton.addEventListener('click', function (e) {
                e.stopPropagation(); // Prevent document click from immediately closing
                if (profileDropdown) {
                    profileDropdown.classList.toggle('hidden');
                }
            });
        }

        document.addEventListener('click', function (e) {
            if (profileDropdown && profileButton && !profileButton.contains(e.target) && !profileDropdown.contains(e.target)) {
                profileDropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
