<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Sistem Informasi Perhutani')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional CSS -->
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Navigation -->
    <x-navbar />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Report Modal -->
    @auth
        <div id="reportModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center p-4"
            style="display: none;">
            <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                id="reportModalContent">
                <!-- Modal content will be loaded here -->
            </div>
        </div>

        <!-- Submission Modal -->
        <div id="submissionModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 z-50 items-center justify-center p-4"
            style="display: none;">
            <div class="bg-white rounded-xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto"
                id="submissionModalContent">
                <!-- Modal content will be loaded here -->
            </div>
        </div>
    @endauth

    <!-- Modal Scripts -->
    <script>
        // Report Modal Functions
        function openReportModal() {
            const modal = document.getElementById('reportModal');
            const modalContent = document.getElementById('reportModalContent');

            modalContent.innerHTML = `
                <div class="bg-white rounded-xl">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Buat Laporan</h2>
                            <p class="text-sm text-gray-500 mt-1">Laporkan masalah yang ditemukan di area hutan</p>
                        </div>
                        <button onclick="closeReportModal()" class="text-gray-400 hover:text-gray-600 rounded-full p-2 hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Form Content -->
                    <div class="p-6">
                        <form id="reportForm" onsubmit="submitReport(event)" class="space-y-6">
                            <!-- Grid Layout -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="report_title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Laporan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="report_title" name="title" required
                                        placeholder="Masukkan judul laporan..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div>
                                    <label for="report_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Laporan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="report_type" name="type" required
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih jenis laporan</option>
                                        <option value="kebakaran">🔥 Kebakaran Hutan</option>
                                        <option value="illegal_logging">🪓 Illegal Logging</option>
                                        <option value="hama_penyakit">🐛 Hama & Penyakit</option>
                                        <option value="kerusakan">💥 Kerusakan Lahan</option>
                                        <option value="pencemaran">🏭 Pencemaran</option>
                                        <option value="lainnya">📝 Lainnya</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="report_urgency" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tingkat Urgensi <span class="text-red-500">*</span>
                                    </label>
                                    <select id="report_urgency" name="urgency" required
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih tingkat urgensi</option>
                                        <option value="rendah" class="text-green-600">🟢 Rendah</option>
                                        <option value="sedang" class="text-yellow-600">🟡 Sedang</option>
                                        <option value="tinggi" class="text-orange-600">🟠 Tinggi</option>
                                        <option value="darurat" class="text-red-600">🔴 Darurat</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="report_location" name="location" required
                                        placeholder="Contoh: Hutan Lindung Gunung Gede, Blok A..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi Detail <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="report_description" name="description" rows="4" required
                                        placeholder="Jelaskan secara detail masalah yang ditemukan, waktu kejadian, kondisi saat ini, dan dampak yang terlihat..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none transition-colors"></textarea>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_contact" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kontak Person (Opsional)
                                    </label>
                                    <input type="text" id="report_contact" name="contact"
                                        placeholder="Nomor HP atau email untuk follow up..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                                <button type="button" onclick="closeReportModal()"
                                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Kirim Laporan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            modal.style.display = 'flex';
        }

        function closeReportModal() {
            const modal = document.getElementById('reportModal');
            modal.style.display = 'none';
        }

        function submitReport(event) {
            event.preventDefault();

            // Simple form submission - you can enhance this with actual backend integration
            const formData = new FormData(event.target);

            // Show success message
            alert('Laporan berhasil dikirim!');
            closeReportModal();
        }

        // Submission Modal Functions
        function openSubmissionModal() {
            const modal = document.getElementById('submissionModal');
            const modalContent = document.getElementById('submissionModalContent');

            modalContent.innerHTML = `
                <div class="bg-white rounded-xl">
                    <!-- Header -->
                    <div class="flex items-center justify-between p-6 border-b border-gray-200">
                        <div>
                            <h2 class="text-xl font-semibold text-gray-900">Buat Pengajuan</h2>
                            <p class="text-sm text-gray-500 mt-1">Ajukan permohonan izin atau layanan kehutanan</p>
                        </div>
                        <button onclick="closeSubmissionModal()" class="text-gray-400 hover:text-gray-600 rounded-full p-2 hover:bg-gray-100 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Form Content -->
                    <div class="p-6">
                        <form id="submissionForm" onsubmit="submitSubmission(event)" class="space-y-6">
                            <!-- Grid Layout -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="submission_title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Pengajuan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="submission_title" name="title" required
                                        placeholder="Masukkan judul pengajuan..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div>
                                    <label for="submission_type" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jenis Pengajuan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="submission_type" name="type" required
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih jenis pengajuan</option>
                                        <option value="izin_tanam">🌱 Izin Penanaman</option>
                                        <option value="izin_tebang">🪓 Izin Penebangan</option>
                                        <option value="izin_riset">🔬 Izin Penelitian</option>
                                        <option value="izin_wisata">🎒 Izin Wisata Alam</option>
                                        <option value="izin_usaha">🏢 Izin Usaha Kehutanan</option>
                                        <option value="lainnya">📝 Lainnya</option>
                                    </select>
                                </div>
                                
                                <div>
                                    <label for="submission_duration" class="block text-sm font-medium text-gray-700 mb-2">
                                        Durasi (hari) <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" id="submission_duration" name="duration" min="1" required
                                        placeholder="30"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="submission_location" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="submission_location" name="location" required
                                        placeholder="Contoh: Hutan Produksi Cisarua, Koordinat GPS..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="submission_purpose" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tujuan/Alasan <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="submission_purpose" name="purpose" rows="4" required
                                        placeholder="Jelaskan tujuan, alasan, dan rencana kegiatan secara detail..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none transition-colors"></textarea>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="submission_organization" class="block text-sm font-medium text-gray-700 mb-2">
                                        Organisasi/Perusahaan (Opsional)
                                    </label>
                                    <input type="text" id="submission_organization" name="organization"
                                        placeholder="Nama organisasi atau perusahaan..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                                <button type="button" onclick="closeSubmissionModal()"
                                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                    Batal
                                </button>
                                <button type="submit"
                                    class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                                    <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Kirim Pengajuan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            `;

            modal.style.display = 'flex';
        }

        function closeSubmissionModal() {
            const modal = document.getElementById('submissionModal');
            modal.style.display = 'none';
        }

        function submitSubmission(event) {
            event.preventDefault();

            // Simple form submission - you can enhance this with actual backend integration
            const formData = new FormData(event.target);

            // Show success message
            alert('Pengajuan berhasil dikirim!');
            closeSubmissionModal();
        }

        // Close modals when clicking outside
        document.addEventListener('click', function(event) {
            const reportModal = document.getElementById('reportModal');
            const submissionModal = document.getElementById('submissionModal');

            if (event.target === reportModal) {
                closeReportModal();
            }
            if (event.target === submissionModal) {
                closeSubmissionModal();
            }
        });

        // Auto-open modal based on session flash
        @if (session('openModal'))
            document.addEventListener('DOMContentLoaded', function() {
                @if (session('openModal') === 'report')
                    openReportModal();
                @elseif (session('openModal') === 'submission')
                    openSubmissionModal();
                @endif
            });
        @endif
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
