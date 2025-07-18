<nav class="bg-white shadow-lg border-b border-green-100" x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-8" src="https://cdn-icons-png.flaticon.com/512/1598/1598431.png" alt="Perhutani">
                    <span class="ml-2 text-xl font-bold text-green-700">Sistem Informasi Perhutani</span>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden sm:flex sm:items-center sm:space-x-8">
                <a href="{{ route('home') }}"
                    class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Beranda
                </a>
                <a href="{{ route('plants.index') }}"
                    class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Tanaman
                </a>
                <a href="{{ route('articles.index') }}"
                    class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                    Artikel
                </a>
                @auth
                    <button onclick="openReportModal()"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Laporan
                    </button>
                    <button onclick="openSubmissionModal()"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Pengajuan
                    </button>
                @endauth

                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen"
                            class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
                            <img class="h-8 w-8 rounded-full"
                                src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=16a34a&background=dcfce7"
                                alt="{{ Auth::user()->name }}">
                            <span class="ml-2 text-gray-700">{{ Auth::user()->name }}</span>
                            <svg class="ml-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="userOpen" @click.away="userOpen = false" x-transition
                            class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 ring-1 ring-black ring-opacity-5 z-50">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Profile
                            </a>
                            <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                Dashboard Admin
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                    class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors">
                        Register
                    </a>
                @endauth
            </div>

            <!-- Mobile menu button -->
            <div class="sm:hidden flex items-center">
                <button @click="mobileOpen = !mobileOpen"
                    class="text-gray-700 hover:text-green-600 focus:outline-none focus:text-green-600">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path x-show="!mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path x-show="mobileOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div x-show="mobileOpen" x-transition class="sm:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            <a href="{{ route('home') }}"
                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                Beranda
            </a>
            <a href="{{ route('plants.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                Tanaman
            </a>
            <a href="{{ route('articles.index') }}"
                class="block px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                Artikel
            </a>
            @auth
                <button onclick="openReportModal()"
                    class="block w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                    Laporan
                </button>
                <button onclick="openSubmissionModal()"
                    class="block w-full text-left px-3 py-2 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-gray-50">
                    Pengajuan
                </button>
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <img class="h-10 w-10 rounded-full"
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=16a34a&background=dcfce7"
                        alt="{{ Auth::user()->name }}">
                    <div class="ml-3">
                        <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Profile
                    </a>
                    <a href="/admin"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Dashboard Admin
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200">
                <div class="space-y-1">
                    <a href="{{ route('login') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Login
                    </a>
                    <a href="{{ route('register') }}"
                        class="block px-4 py-2 text-base font-medium text-gray-500 hover:text-gray-800 hover:bg-gray-100">
                        Register
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
