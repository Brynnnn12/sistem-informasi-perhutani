<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-green-600 to-green-800 text-white overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-black opacity-20"></div>
    <div class="absolute inset-0"
        style="background-image: url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2071&q=80'); background-size: cover; background-position: center; opacity: 0.3;">
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 lg:py-32">
        <div class="text-center">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                Sistem Informasi
                <span class="block text-green-200">Perhutani Indonesia</span>
            </h1>
            <p class="text-xl md:text-2xl mb-8 text-green-100 max-w-3xl mx-auto leading-relaxed">
                Platform digital untuk pengelolaan hutan berkelanjutan, konservasi alam, dan pemberdayaan masyarakat di
                Indonesia
            </p>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('articles.index') }}"
                    class="bg-white text-green-700 hover:bg-green-50 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    Jelajahi Artikel
                </a>
                <a href="{{ route('plants.index') }}"
                    class="border-2 border-white text-white hover:bg-white hover:text-green-700 px-8 py-4 rounded-lg font-semibold text-lg transition-all duration-300 transform hover:scale-105">
                    Lihat Tanaman
                </a>
            </div>
        </div>

        <!-- Stats -->
        <div class="mt-16 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6">
                <div class="text-3xl font-bold text-green-200">{{ \App\Models\Forest::count() }}</div>
                <div class="text-green-100">Hutan Terdaftar</div>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6">
                <div class="text-3xl font-bold text-green-200">{{ \App\Models\Plant::count() }}</div>
                <div class="text-green-100">Spesies Tanaman</div>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6">
                <div class="text-3xl font-bold text-green-200">{{ \App\Models\Article::count() }}</div>
                <div class="text-green-100">Artikel</div>
            </div>
            <div class="bg-white bg-opacity-10 backdrop-blur-sm rounded-lg p-6">
                <div class="text-3xl font-bold text-green-200">{{ \App\Models\User::count() }}</div>
                <div class="text-green-100">Pengguna Aktif</div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2">
        <div class="animate-bounce">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3">
                </path>
            </svg>
        </div>
    </div>
</section>
