@props(['forests' => []])

<div x-data="reportModal()" x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0" @keydown.escape.window="open = false" @open-report-modal.window="open = true"
    class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">

    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
        <!-- Background overlay -->
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="open = false"
            class="fixed inset-0 bg-gray-900 bg-opacity-50 transition-opacity">
        </div>

        <!-- Modal panel -->
        <div x-show="open" x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            class="inline-block w-full max-w-2xl my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl">

            <!-- Header -->
            <div class="flex items-center justify-between p-6 border-b border-gray-200">
                <div>
                    <h2 class="text-xl font-semibold text-gray-900">Buat Laporan</h2>
                    <p class="text-sm text-gray-500 mt-1">Laporkan masalah yang ditemukan di area hutan</p>
                </div>
                <button @click="open = false"
                    class="text-gray-400 hover:text-gray-600 rounded-full p-2 hover:bg-gray-100 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Form Content -->
            <div class="p-6">
                <form action="{{ route('reports.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf

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
                                @foreach ($forests as $forest)
                                    <option value="{{ $forest->id }}">{{ $forest->name }} - {{ $forest->location }}
                                    </option>
                                @endforeach
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
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-green-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="report_photo"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-green-600 hover:text-green-500 focus-within:outline-none">
                                            <span>Upload foto</span>
                                            <input id="report_photo" name="photo" type="file" accept="image/*"
                                                class="sr-only">
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
                                x-model="currentDateTime"
                                class="block w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent transition-colors">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4 border-t border-gray-200">
                        <button type="button" @click="open = false"
                            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-300 transition-colors">
                            Batal
                        </button>
                        <button type="button"
                            x-sweetalert.confirm="{
                                title: 'Kirim Laporan?',
                                text: 'Pastikan semua informasi sudah benar sebelum mengirim.',
                                confirmText: 'Ya, Kirim!',
                                cancelText: 'Periksa Lagi',
                                onConfirm: () => {
                                    const form = $el.closest('form');
                                    form.submit();
                                }
                            }"
                            class="px-6 py-2.5 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-colors">
                            <svg class="w-4 h-4 inline-block mr-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Laporan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
