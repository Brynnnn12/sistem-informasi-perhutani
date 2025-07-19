<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak - Sistem Informasi Perhutani</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div
        class="min-h-screen bg-gradient-to-br from-red-50 via-orange-50 to-yellow-50 flex items-center justify-center p-6">
        <div class="max-w-md w-full text-center">
            <!-- Error Icon -->
            <div class="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center mb-6">
                <svg class="w-12 h-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                    </path>
                </svg>
            </div>

            <!-- Error Message -->
            <h1 class="text-2xl font-bold text-gray-900 mb-4">Akses Ditolak</h1>
            <p class="text-gray-600 mb-6">
                Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
                Silakan hubungi administrator jika Anda merasa ini adalah kesalahan.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-3">
                <a href="{{ route('home') }}"
                    class="block w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                    Kembali ke Beranda
                </a>

                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Contact Info -->
            <div class="mt-8 text-sm text-gray-500">
                <p>Butuh bantuan? Hubungi administrator sistem</p>
            </div>
        </div>
    </div>
</body>

</html>
