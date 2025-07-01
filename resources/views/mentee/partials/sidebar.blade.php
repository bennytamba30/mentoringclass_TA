<aside id="sidebar"
    class="w-64 bg-white shadow-2xl fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-50 rounded-r-2xl md:rounded-none flex flex-col h-screen">
    <div class="h-16 flex items-center justify-between px-6 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <!-- SVG Icon for Mentoring Class Logo -->
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="currentColor"
                stroke-width="2" class="text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
            </svg>
            <!-- Adjusted text size for mobile (text-base) and larger screens (sm:text-lg md:text-xl) -->
            <span class="text-base sm:text-lg md:text-xl font-bold text-slate-800">Mentoring Class</span>
        </div>
        <!-- Close button for mobile sidebar (positioned by justify-between) -->
        <button id="closeSidebar"
            class="md:hidden text-slate-500 hover:text-slate-700 p-1 rounded-full hover:bg-slate-100 transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>
    <nav class="flex-1 overflow-y-auto py-6">
        <ul class="space-y-2 px-4">
            <li>
                <!-- Dasbor Icon (Home) -->
                <a href="{{ route('mentee.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-home">
                        <path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    <span>Dasbor</span>
                </a>
            </li>
            <li>
                <!-- Kursus Saya Icon (Book Open) -->
                <a href="{{ route('mentee.courses.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.courses.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-book-open">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                    </svg>
                    <span>Kursus Saya</span>
                </a>
            </li>
            <li>
                <!-- Pengumuman Icon (Megaphone) -->
                <a href="{{ route('mentee.announcements.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.announcements.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-megaphone">
                        <path d="m3 11 18-2L13 3 7 5 3 11Z" />
                        <path d="M11 9v11a1 1 0 0 1-2 0v-5a1 1 0 0 0-1-1H4a1 1 0 0 0-1 1v5a1 1 0 0 1-2 0v-7" />
                        <path d="M22 11v8a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-8a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2Z" />
                    </svg>
                    <span>Pengumuman</span>
                </a>
            </li>
            <li>
                <!-- Kehadiran Icon (Calendar Check) -->
                <a href="{{ route('mentee.attendances.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.attendances.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-calendar-check">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2" />
                        <line x1="16" x2="16" y1="2" y2="6" />
                        <line x1="8" x2="8" y1="2" y2="6" />
                        <line x1="3" x2="21" y1="10" y2="10" />
                        <path d="m9 16 2 2 4-4" />
                    </svg>
                    <span>Kehadiran</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- Logout button (always at the bottom) -->
    <div class="px-4 py-4 border-t border-slate-200">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
                class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200">
                <!-- Logout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="lucide lucide-log-out">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" x2="9" y1="12" y2="12" />
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </div>
</aside>
