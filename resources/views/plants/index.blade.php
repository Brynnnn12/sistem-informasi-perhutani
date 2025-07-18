@extends('layouts.app')

@section('title', 'Database Tanaman - Sistem Informasi Perhutani')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Database Tanaman
                </h1>
                <p class="text-xl text-green-100 max-w-3xl mx-auto">
                    Jelajahi koleksi lengkap spesies tanaman dalam ekosistem hutan Indonesia
                </p>
            </div>
        </div>
    </section>

    <!-- Search and Filter Section -->
    <section class="bg-white py-8 border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row gap-4 items-center justify-between">
                <div class="flex-1">
                    <div class="relative">
                        <input type="text" id="searchPlants" placeholder="Cari nama tanaman..."
                            class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex gap-4">
                    <select id="filterForest"
                        class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="">Semua Hutan</option>
                        @foreach (\App\Models\Forest::all() as $forest)
                            <option value="{{ $forest->id }}">{{ $forest->name }}</option>
                        @endforeach
                    </select>
                    <select id="sortBy"
                        class="px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent">
                        <option value="name">Nama A-Z</option>
                        <option value="scientific_name">Nama Ilmiah</option>
                        <option value="created_at">Terbaru</option>
                    </select>
                </div>
            </div>
        </div>
    </section>

    <!-- Plants Grid Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $plants = \App\Models\Plant::with('forest')->paginate(12);
            @endphp

            <div id="plantsContainer">
                @if ($plants->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                        @foreach ($plants as $plant)
                            <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 plant-card"
                                data-name="{{ strtolower($plant->name) }}"
                                data-scientific="{{ strtolower($plant->scientific_name) }}"
                                data-forest="{{ $plant->forest_id }}">
                                @if ($plant->image)
                                    <img class="w-full h-48 object-cover"
                                        src="{{ Storage::disk('public')->url($plant->image) }}" alt="{{ $plant->name }}">
                                @else
                                    <div
                                        class="w-full h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                            </path>
                                        </svg>
                                    </div>
                                @endif
                                <div class="p-6">
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                        {{ $plant->name }}
                                    </h3>
                                    <p class="text-sm font-medium text-green-600 mb-2">
                                        {{ $plant->scientific_name }}
                                    </p>
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ Str::limit($plant->description, 100) }}
                                    </p>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                            {{ $plant->forest->name ?? 'Tidak ada lokasi' }}
                                        </span>
                                        <button onclick="openPlantModal({{ $plant->id }})"
                                            class="text-green-600 hover:text-green-700 font-medium text-sm">
                                            Detail →
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $plants->links() }}
                    </div>
                @else
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Data Tanaman</h3>
                        <p class="text-gray-600 mb-6">Belum ada data tanaman yang tersedia saat ini.</p>
                        @auth
                            <a href="/admin/plants/create"
                                class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                Tambah Data Tanaman
                            </a>
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Plant Detail Modal -->
    <div id="plantModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4">
            <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div id="modalContent">
                    <!-- Content will be loaded here -->
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchPlants');
            const forestFilter = document.getElementById('filterForest');
            const sortSelect = document.getElementById('sortBy');
            const plantCards = document.querySelectorAll('.plant-card');

            function filterPlants() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedForest = forestFilter.value;

                plantCards.forEach(card => {
                    const name = card.dataset.name;
                    const scientific = card.dataset.scientific;
                    const forest = card.dataset.forest;

                    const matchesSearch = name.includes(searchTerm) || scientific.includes(searchTerm);
                    const matchesForest = !selectedForest || forest === selectedForest;

                    if (matchesSearch && matchesForest) {
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
            }

            searchInput.addEventListener('input', filterPlants);
            forestFilter.addEventListener('change', filterPlants);
        });

        function openPlantModal(plantId) {
            // Simple modal implementation - you can enhance this with actual plant details
            const modal = document.getElementById('plantModal');
            const modalContent = document.getElementById('modalContent');

            modalContent.innerHTML = `
            <div class="p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold">Detail Tanaman</h3>
                    <button onclick="closePlantModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <p class="text-gray-600">Loading detail tanaman...</p>
            </div>
        `;

            modal.style.display = 'flex';
            modal.classList.remove('hidden');

            // You can make an AJAX call here to load actual plant details
            // For now, we'll show a placeholder
        }

        function closePlantModal() {
            const modal = document.getElementById('plantModal');
            modal.style.display = 'none';
            modal.classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('plantModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePlantModal();
            }
        });
    </script>
@endpush
