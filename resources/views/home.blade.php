@extends('layouts.app')

@section('title', 'Beranda - Sistem Informasi Perhutani')

@section('content')
    <!-- Hero Section -->
    <x-hero />

    <!-- Profile Section (untuk user yang login) -->
    {{-- <x-profile-section /> --}}

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Fitur Utama Sistem
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Platform terintegrasi untuk pengelolaan informasi perhutani yang efektif dan berkelanjutan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Pelaporan Online</h3>
                    <p class="text-gray-600">Laporkan masalah kehutanan secara real-time dengan sistem yang terintegrasi dan
                        responsif.</p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Database Tanaman</h3>
                    <p class="text-gray-600">Akses informasi lengkap mengenai berbagai spesies tanaman dan karakteristiknya.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Pengajuan Izin</h3>
                    <p class="text-gray-600">Ajukan permohonan izin pemanfaatan lahan dengan proses yang transparan dan
                        efisien.</p>
                </div>

                <!-- Feature 4 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Dashboard Analitik</h3>
                    <p class="text-gray-600">Monitor dan analisis data kehutanan dengan visualisasi yang komprehensif.</p>
                </div>

                <!-- Feature 5 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Kolaborasi Komunitas</h3>
                    <p class="text-gray-600">Bangun jejaring dengan sesama pegiat lingkungan dan masyarakat peduli hutan.
                    </p>
                </div>

                <!-- Feature 6 -->
                <div class="bg-white p-8 rounded-xl shadow-lg border hover:shadow-xl transition-shadow">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-6">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Edukasi & Artikel</h3>
                    <p class="text-gray-600">Akses artikel edukatif dan panduan praktis tentang konservasi dan pengelolaan
                        hutan.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Articles Section -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Artikel Terbaru
                </h2>
                <p class="text-xl text-gray-600">
                    Baca informasi terkini seputar kehutanan dan konservasi alam
                </p>
            </div>

            @if ($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($articles->take(3) as $article)
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            @if ($article->cover_image)
                                <img class="w-full h-48 object-cover"
                                    src="{{ Storage::disk('public')->url($article->cover_image) }}"
                                    alt="{{ $article->title }}">
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                    <span
                                        class="text-white text-lg font-semibold">{{ substr($article->title, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $article->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ strip_tags(Str::limit($article->content, 150)) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                    </span>
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="text-green-600 hover:text-green-700 font-medium">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="text-center mt-12">
                    <a href="{{ route('articles.index') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-8 py-3 rounded-lg font-semibold transition-colors">
                        Lihat Semua Artikel
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="text-gray-500 text-lg">Belum ada artikel yang tersedia.</div>
                    <a href="/admin/articles/create"
                        class="inline-block mt-4 bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg">
                        Tambah Artikel Pertama
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-green-600" x-data="{}">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Bergabunglah dalam Menjaga Kelestarian Hutan
            </h2>
            <p class="text-xl text-green-100 mb-8 max-w-3xl mx-auto">
                Daftarkan diri Anda dan mulai berkontribusi dalam upaya konservasi dan pengelolaan hutan yang berkelanjutan
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                @guest
                    <a href="{{ route('register') }}"
                        class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                        Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}"
                        class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                        Masuk
                    </a>
                @else
                    <button @click="$dispatch('open-report-modal')"
                        class="bg-white text-green-600 hover:bg-gray-100 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                        Laporkan Masalah
                    </button>
                    <button @click="$dispatch('open-submission-modal')"
                        class="border-2 border-white text-white hover:bg-white hover:text-green-600 px-8 py-4 rounded-lg font-semibold text-lg transition-colors">
                        Ajukan Permohonan
                    </button>
                @endguest
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Data hutan untuk modal
        window.forestsData = @json($forests ?? []);
    </script>
@endpush
