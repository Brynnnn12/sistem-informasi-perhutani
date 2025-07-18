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

            // Get forests data from window object
            const forests = window.forestsData || [];
            const forestOptions = forests.map(forest =>
                `<option value="${forest.id}">🌲 ${forest.name}</option>`
            ).join('');

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
                        <form id="reportForm" class="space-y-6">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <!-- Grid Layout -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label for="report_title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Laporan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="report_title" name="title" required
                                        placeholder="Contoh: Kebakaran Hutan, Illegal Logging"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_forest_id" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lokasi Hutan <span class="text-red-500">*</span>
                                    </label>
                                    <select id="report_forest_id" name="forest_id" required
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                                        <option value="">Pilih lokasi hutan</option>
                                        <option value="forest1">🌲 Hutan Lindung Gunung Gede</option>
                                        <option value="forest2">🌳 Hutan Produksi Sukabumi</option>
                                        <option value="forest3">🍃 Hutan Konservasi Halimun</option>
                                        <option value="forest4">🌿 Hutan Rakyat Cianjur</option>
                                        <option value="forest5">� Taman Nasional Ujung Kulon</option>
                                    </select>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi Detail <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="report_description" name="description" rows="4" required
                                        placeholder="Jelaskan detail kejadian yang dilaporkan, waktu kejadian, kondisi saat ini, dan dampak yang terlihat..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none transition-colors"></textarea>
                                </div>
                                
                                <div class="md:col-span-2">
                                    <label for="report_photo" class="block text-sm font-medium text-gray-700 mb-2">
                                        Foto Bukti
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="report_photo" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                                    <span>Upload foto</span>
                                                    <input id="report_photo" name="photo" type="file" accept="image/*" class="sr-only">
                                                </label>
                                                <p class="pl-1">atau drag dan drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG hingga 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="report_reported_at" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Kejadian <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" id="report_reported_at" name="reported_at" required
                                        value="${new Date().toISOString().slice(0, 16)}"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div>
                                    <label for="report_contact" class="block text-sm font-medium text-gray-700 mb-2">
                                        Kontak Person (Opsional)
                                    </label>
                                    <input type="text" id="report_contact" name="contact"
                                        placeholder="No HP untuk follow up"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                                <button type="button" onclick="closeReportModal()"
                                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                    Batal
                                </button>
                                <button type="button" onclick="submitReport()"
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
                        <form id="submissionForm" class="space-y-6">
                            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
                            <!-- Grid Layout -->
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label for="submission_title" class="block text-sm font-medium text-gray-700 mb-2">
                                        Judul Pengajuan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="submission_title" name="title" required
                                        placeholder="Contoh: Permohonan Izin Pemanfaatan Lahan"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                                
                                <div>
                                    <label for="submission_description" class="block text-sm font-medium text-gray-700 mb-2">
                                        Deskripsi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="submission_description" name="description" rows="4" required
                                        placeholder="Jelaskan detail pengajuan Anda dengan lengkap..."
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent resize-none transition-colors"></textarea>
                                </div>
                                
                                <div>
                                    <label for="submission_attachment" class="block text-sm font-medium text-gray-700 mb-2">
                                        Lampiran Dokumen
                                    </label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="submission_attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                                    <span>Upload dokumen</span>
                                                    <input id="submission_attachment" name="attachment" type="file" accept=".pdf,.jpg,.jpeg,.png" class="sr-only">
                                                </label>
                                                <p class="pl-1">atau drag dan drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PDF, JPG, PNG hingga 5MB</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div>
                                    <label for="submission_submitted_at" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Pengajuan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="datetime-local" id="submission_submitted_at" name="submitted_at" required
                                        value="${new Date().toISOString().slice(0, 16)}"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                                <button type="button" onclick="closeSubmissionModal()"
                                    class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                                    Batal
                                </button>
                                <button type="button" onclick="submitSubmission()"
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

        // Submit Report Form
        function submitReport() {
            const form = document.getElementById('reportForm');
            const formData = new FormData(form);

            // Show loading state
            const submitBtn = document.querySelector('#reportForm button[onclick="submitReport()"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML =
                '<svg class="animate-spin h-4 w-4 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
            submitBtn.disabled = true;

            fetch('/reports', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        closeReportModal();
                        form.reset();
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        } // Submit Submission Form
        function submitSubmission() {
            const form = document.getElementById('submissionForm');
            const formData = new FormData(form);

            // Show loading state
            const submitBtn = form.querySelector('button[type="submit"]');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML =
                '<svg class="animate-spin h-4 w-4 mr-2" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
            submitBtn.disabled = true;

            fetch('/submissions', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        closeSubmissionModal();
                        form.reset();
                    } else {
                        alert('Terjadi kesalahan. Silakan coba lagi.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
        }
    </script>

    <!-- Additional Scripts -->
    @stack('scripts')
</body>

</html>
