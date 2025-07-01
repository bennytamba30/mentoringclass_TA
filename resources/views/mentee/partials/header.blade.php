<header class="w-full bg-white shadow-lg p-4 flex items-center justify-between border-b border-slate-200">
    <!-- Mobile menu toggle for smaller screens (moved to far left on mobile) -->
    <button id="menuToggle" class="md:hidden text-slate-600 focus:outline-none p-2 rounded-lg hover:bg-slate-100 transition duration-200 order-first">
        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
    </button>

    <!-- Salam dan Nama (hidden on mobile, block on md and up) -->
    <div class="hidden md:block">
        <h1 class="text-xl md:text-2xl font-semibold text-slate-800">Halo, {{ Auth::user()->name ?? 'Pengguna' }}!</h1>
        <p class="text-sm text-slate-500">Selamat datang kembali di Mentoring Class.</p>
    </div>

    <!-- Profile and Dropdown (remains on right, pushed by ml-auto on mobile) -->
    <div class="flex items-center gap-4 ml-auto md:ml-0">
        <div class="relative">
            <!-- Tombol Profil -->
            <button id="profileButton" class="flex items-center gap-2 focus:outline-none bg-slate-50 p-2 rounded-full hover:bg-slate-100 transition duration-200">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name ?? 'U') }}&background=6366F1&color=fff"
                    alt="Avatar"
                    class="w-9 h-9 rounded-full border border-slate-200 shadow-sm">
                <span class="text-base font-medium text-gray-700 hidden sm:block">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                <svg class="w-4 h-4 text-gray-500 hidden sm:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>

            <!-- Dropdown -->
            <div id="profileDropdown"
                class="hidden absolute right-0 mt-2 w-48 bg-white border border-slate-200 rounded-lg shadow-xl z-50 overflow-hidden">
                <a href="#" class="block px-4 py-3 text-sm text-slate-700 hover:bg-slate-100 transition duration-200">
                    ⚙️ Pengaturan Profil
                </a>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition duration-200">
                        🚪 Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</header>
