@auth
    <section class="py-12 bg-gradient-to-r from-green-50 to-blue-50" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-lg p-6 lg:p-8">
                <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
                    <!-- User Info -->
                    <div class="flex items-center space-x-4">
                        <div
                            class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center">
                            <span class="text-white text-xl font-semibold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <div>
                            <h3 class="text-xl font-semibold text-gray-900">
                                Selamat Datang, {{ Auth::user()->name }}!
                            </h3>
                            <p class="text-gray-600">{{ Auth::user()->email }}</p>
                            <p class="text-sm text-green-600 font-medium">
                                Bergabung sejak {{ Auth::user()->created_at->format('F Y') }}
                            </p>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                        <button @click="$dispatch('open-report-modal')"
                            class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors text-center">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                            Laporkan Masalah
                        </button>
                        <button @click="$dispatch('open-submission-modal')"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors text-center">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                            Ajukan Permohonan
                        </button>
                        <a href="{{ route('profile.edit') }}"
                            class="border-2 border-gray-300 text-gray-700 hover:border-green-500 hover:text-green-600 px-6 py-3 rounded-lg font-semibold transition-colors text-center">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Kelola Profil
                        </a>
                    </div>
                </div>

                <!-- Profile Stats -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">5</div>
                            <div class="text-sm text-gray-600">Laporan Dibuat</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">3</div>
                            <div class="text-sm text-gray-600">Permohonan Aktif</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-yellow-600">12</div>
                            <div class="text-sm text-gray-600">Artikel Dibaca</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">8</div>
                            <div class="text-sm text-gray-600">Poin Kontribusi</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endauth
