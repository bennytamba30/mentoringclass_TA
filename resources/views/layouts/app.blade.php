<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'LMS BelajarKuy')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Tailwind CSS & AlpineJS for interactivity -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite('resources/css/app.css')

    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif']
                    },
                    colors: {
                        primary: {
                            '50': '#eff6ff',
                            '100': '#dbeafe',
                            '200': '#bfdbfe',
                            '300': '#93c5fd',
                            '400': '#60a5fa',
                            '500': '#3b82f6',
                            '600': '#2563eb',
                            '700': '#1d4ed8',
                            '800': '#1e40af',
                            '900': '#1e3a8a'
                        },
                    }
                }
            }
        }
    </script>
    <style>
        /* Styling for AlpineJS's [x-cloak] directive to prevent flash of unstyled content */
        [x-cloak] {
            display: none !important;
        }

        /* Custom scrollbar for better aesthetics */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Basic styling for prose content from a WYSIWYG editor */
        .prose {
            max-width: 65ch;
        }

        .prose h1,
        .prose h2,
        .prose h3 {
            font-weight: 600;
        }

        .prose ul {
            list-style-position: inside;
        }
    </style>
    @stack('styles')
    @livewireScripts
    @stack('scripts')
</head>

<body class="bg-slate-50 font-sans antialiased">
    <!-- Main application wrapper with AlpineJS state for mobile menu -->
    <div x-data="{ mobileMenuOpen: false }" class="flex h-screen bg-white">

        <!-- Sidebar Navigation (Desktop and Mobile) -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Header -->
            {{-- @include('layouts.partials.header') --}}

            <!-- Scrollable Main Content -->
            <main class="flex-1 overflow-y-auto bg-slate-50 p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto">
                    {{-- @yield('content') --}}
                </div>
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>
