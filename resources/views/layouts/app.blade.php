<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Informasi Perhutani')</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Modal Functions -->
    <script>
        // Define modal functions before Alpine.js loads
        window.reportModal = function() {
            return {
                open: false,
                currentDateTime: new Date().toISOString().slice(0, 16),
                init() {
                    // Initialize report modal
                }
            }
        }

        window.submissionModal = function() {
            return {
                open: false,
                currentDateTime: new Date().toISOString().slice(0, 16),
                init() {
                    // Initialize submission modal
                }
            }
        }
    </script>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Additional CSS -->
    @stack('styles')
</head>

<body class="font-sans antialiased bg-gray-50">
    <!-- Page Loader -->
    <x-page-loader />

    <!-- Navigation -->
    <x-navbar />

    <!-- Sweet Alert Messages -->
    <x-sweet-alert />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <x-footer />

    <!-- Modals -->
    @auth
        <x-report-modal :forests="App\Models\Forest::all()" />
        <x-submission-modal />
    @endauth

    <!-- Additional Scripts -->
    @stack('scripts')

    <!-- SweetAlert for session messages -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    title: 'Berhasil!',
                    text: '{{ session('success') }}',
                    icon: 'success',
                    confirmButtonColor: '#16a34a',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error!',
                    text: '{{ session('error') }}',
                    icon: 'error',
                    confirmButtonColor: '#dc2626',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('warning'))
                Swal.fire({
                    title: 'Peringatan!',
                    text: '{{ session('warning') }}',
                    icon: 'warning',
                    confirmButtonColor: '#f59e0b',
                    confirmButtonText: 'OK'
                });
            @endif

            @if (session('info'))
                Swal.fire({
                    title: 'Informasi',
                    text: '{{ session('info') }}',
                    icon: 'info',
                    confirmButtonColor: '#3b82f6',
                    confirmButtonText: 'OK'
                });
            @endif
        });
    </script>
</body>

</html>
