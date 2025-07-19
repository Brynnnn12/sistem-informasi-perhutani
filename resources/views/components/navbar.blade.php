<nav class="bg-white shadow-lg border-b border-green-100" x-data="{ mobileOpen: false }" @click.away="mobileOpen = false">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <div class="flex-shrink-0 flex items-center">
                    <img class="h-8 w-8" src="https://cdn-icons-png.flaticon.com/512/1598/1598431.png" alt="Perhutani">
                    <span class="ml-2 text-lg sm:text-xl font-bold text-green-700">
                        <span class="hidden sm:inline">Sistem Informasi Perhutani</span>
                        <span class="sm:hidden">Perhutani</span>
                    </span>
                </div>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex md:items-center md:space-x-8">
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

                    <button @click="$dispatch('open-report-modal')"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Laporan
                    </button>
                    <button @click="$dispatch('open-submission-modal')"
                        class="text-gray-700 hover:text-green-600 px-3 py-2 rounded-md text-sm font-medium transition-colors">
                        Pengajuan

                    </button>
                @endauth

                @auth
                    <!-- User Dropdown -->
                    <div class="relative" x-data="{ userOpen: false }">
                        <button @click="userOpen = !userOpen"
                            class="flex items-center text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-green-500">
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->getAvatarUrl() }}"
                                alt="{{ Auth::user()->name }}"
                                onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=16a34a&background=dcfce7'">
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
                            @if (Auth::user()->hasAnyRole(['admin', 'petugas']))
                                <a href="/admin" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                        </path>
                                    </svg>
                                    Panel Admin
                                </a>
                            @endif
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
            <div class="md:hidden flex items-center">
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
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 transform -translate-y-1"
        x-transition:enter-end="opacity-100 transform translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 transform translate-y-0"
        x-transition:leave-end="opacity-0 transform -translate-y-1" class="md:hidden">
        <div class="pt-2 pb-3 space-y-1 bg-white border-t border-gray-200 shadow-lg">
            <a href="{{ route('home') }}" @click="mobileOpen = false"
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    Beranda
                </div>
            </a>
            <a href="{{ route('plants.index') }}" @click="mobileOpen = false"
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    Tanaman
                </div>
            </a>
            <a href="{{ route('articles.index') }}" @click="mobileOpen = false"
                class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                        </path>
                    </svg>
                    Artikel
                </div>
            </a>
            @auth
                <button @click="console.log('Mobile report clicked'); $dispatch('open-report-modal'); mobileOpen = false"
                    class="block w-full text-left px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        Laporan
                    </div>
                </button>
                <button
                    @click="console.log('Mobile submission clicked'); $dispatch('open-submission-modal'); mobileOpen = false"
                    class="block w-full text-left px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15">
                            </path>
                        </svg>
                        Pengajuan
                    </div>
                </button>
            @endauth
        </div>

        @auth
            <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
                <div class="flex items-center px-4 py-3">
                    <img class="h-12 w-12 rounded-full border-2 border-green-200"
                        src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->name }}"
                        onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=16a34a&background=dcfce7'">
                    <div class="ml-3 flex-1">
                        <div class="text-base font-semibold text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="text-sm text-gray-600">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-3 space-y-1">
                    <a href="{{ route('profile.edit') }}" @click="mobileOpen = false"
                        class="flex items-center px-4 py-3 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Profile
                    </a>
                    @if (Auth::user()->hasAnyRole(['admin', 'petugas']))
                        <a href="/admin" @click="mobileOpen = false"
                            class="flex items-center px-4 py-3 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                            Panel Admin
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex items-center w-full px-4 py-3 text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                                </path>
                            </svg>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
                <div class="space-y-1">
                    <a href="{{ route('login') }}" @click="mobileOpen = false"
                        class="flex items-center px-4 py-3 text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-white transition-colors">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" @click="mobileOpen = false"
                        class="flex items-center px-4 py-3 text-base font-medium text-white bg-green-600 hover:bg-green-700 transition-colors rounded-lg mx-4">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z">
                            </path>
                        </svg>
                        Register
                    </a>
                </div>
            </div>
        @endauth
    </div>
</nav>
