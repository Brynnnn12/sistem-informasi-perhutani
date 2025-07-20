<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Akses Ditolak - Sistem Informasi Perhutani</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body
    class="font-sans antialiased relative min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-lime-50 flex items-center justify-center p-6">
    <!-- Watermark SVG Pohon -->
    <div class="pointer-events-none select-none fixed inset-0 flex items-center justify-center opacity-10 z-0">
        <svg width="220" height="220" viewBox="0 0 220 220" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="110" cy="110" r="100" fill="#22C55E" fill-opacity="0.08" />
            <path d="M110 60 L130 110 L90 110 Z" fill="#22C55E" fill-opacity="0.18" />
            <rect x="104" y="110" width="12" height="40" rx="4" fill="#A3E635" />
        </svg>
    </div>
    <div class="relative z-10 max-w-md w-full text-center">
        <!-- Logo Perhutani -->
        <div class="flex justify-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/1598/1598431.png" alt="Logo Perhutani"
                class="w-16 h-16 rounded-full shadow-lg border-4 border-white bg-white">
        </div>
        <!-- Error Card -->
        <div class="bg-white/90 rounded-2xl shadow-xl border border-green-200 px-8 py-8">
            <!-- Error Icon -->
            <div class="mx-auto w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mb-4 shadow">
                <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z">
                    </path>
                </svg>
            </div>
            <!-- Error Message -->
            <h1 class="text-xl font-bold text-green-700 mb-2 tracking-tight">Akses Ditolak</h1>
            <p class="text-green-900 mb-5 text-sm">
                Anda tidak memiliki izin untuk mengakses halaman ini.<br>
                Jika Anda merasa ini adalah kesalahan, silakan hubungi administrator.
            </p>
            <!-- Action Buttons -->
            <div class="space-y-2">
                <a href="{{ route('home') }}"
                    class="block w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow transition-colors">
                    Kembali ke Beranda
                </a>
                @auth
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit"
                            class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow transition-colors">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}"
                        class="block w-full bg-gray-500 hover:bg-gray-700 text-white font-semibold py-2.5 px-4 rounded-lg shadow transition-colors">
                        Login
                    </a>
                @endauth
            </div>
            <!-- Contact Info -->
            <div class="mt-7 text-xs text-green-700/80">
                <p>Butuh bantuan? <span class="font-semibold">Hubungi administrator Sistem Informasi Perhutani</span>
                </p>
            </div>
        </div>
        <div class="mt-6 text-xs text-gray-400">&copy; {{ date('Y') }} Sistem Informasi Perhutani</div>
    </div>
</body>

</html>
