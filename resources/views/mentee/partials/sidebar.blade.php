<aside id="sidebar" class="w-64 bg-white shadow-2xl fixed inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-transform duration-300 ease-in-out z-50 rounded-r-2xl md:rounded-none">
    <div class="h-16 flex items-center px-6 border-b border-slate-200">
        <div class="flex items-center gap-3">
            <!-- SVG Icon for Mentoring Class Logo -->
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="none" stroke="currentColor"
                stroke-width="2" class="text-indigo-600">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
            </svg>
            <span class="text-xl font-bold text-slate-800">Mentoring Class</span>
        </div>
        <!-- Close button for mobile sidebar -->
        <button id="closeSidebar" class="md:hidden absolute top-4 right-4 text-slate-500 hover:text-slate-700 p-1 rounded-full hover:bg-slate-100 transition duration-200">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>
    <nav class="flex-1 overflow-y-auto py-6">
        <ul class="space-y-2 px-4">
            <li>
                <!-- Active link styling for Dasbor (replace with actual Laravel route check) -->
                <a href="{{ route('mentee.dashboard') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.dashboard') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <span class="text-lg">🏠</span> <span>Dasbor</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mentee.courses.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.courses.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <span class="text-lg">📚</span> <span>Kursus Saya</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mentee.announcements.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.announcements.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <span class="text-lg">📢</span> <span>Pengumuman</span>
                </a>
            </li>
            <li>
                <a href="{{ route('mentee.attendances.index') }}"
                   class="flex items-center gap-3 px-4 py-3 rounded-xl transition duration-200 {{ request()->routeIs('mentee.attendances.*') ? 'bg-indigo-50 text-indigo-700 font-semibold shadow-sm' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-800' }}">
                    <span class="text-lg">📆</span> <span>Kehadiran</span>
                </a>
            </li>
            <li>
                <!-- Logout button (assuming a Laravel logout route) -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200">
                        <span class="text-lg">🚪</span> <span>Logout</span>
                    </button>
                </form>
            </li>
        </ul>
    </nav>
</aside>
