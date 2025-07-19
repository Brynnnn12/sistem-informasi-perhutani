<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @if ($alpineJs ?? false)
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    @endif
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gradient-to-br from-green-50 via-emerald-50 to-teal-50">
        <!-- Background Pattern -->
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNDAiIGhlaWdodD0iNDAiIHZpZXdCb3g9IjAgMCA0MCA0MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48cGF0dGVybiBpZD0iZ3JpZCIgd2lkdGg9IjQwIiBoZWlnaHQ9IjQwIiBwYXR0ZXJuVW5pdHM9InVzZXJTcGFjZU9uVXNlIj48cGF0aCBkPSJNIDQwIDAgTCAwIDAgMCA0MCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSJyZ2JhKDAsIDEwMCwgMCwgMC4xKSIgc3Ryb2tlLXdpZHRoPSIxIi8+PC9wYXR0ZXJuPjwvZGVmcz48cmVjdCB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiBmaWxsPSJ1cmwoI2dyaWQpIi8+PC9zdmc+')] opacity-50">
        </div>

        <div class="relative flex items-center justify-center min-h-screen p-6">
            <div class="w-full max-w-md">
                <!-- Logo & Header -->
                <div class="text-center mb-8">
                    <div
                        class="mx-auto w-20 h-20 bg-gradient-to-br {{ $iconGradient ?? 'from-green-600 to-emerald-600' }} rounded-full flex items-center justify-center mb-4 shadow-lg">
                        {!! $icon !!}
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $pageTitle }}</h1>
                    <p class="text-gray-600">{{ $pageDescription }}</p>
                </div>

                <!-- Main Card -->
                <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-white/20 p-8">
                    @if (isset($alertMessage))
                        <!-- Alert Message -->
                        <div class="mb-6 p-4 {{ $alertClass ?? 'bg-blue-50 border-blue-200' }} border rounded-lg">
                            <div class="flex items-start">
                                {!! $alertIcon ??
                                    '<svg class="w-5 h-5 text-blue-500 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' !!}
                                <p class="text-sm {{ $alertTextClass ?? 'text-blue-700' }}">
                                    {{ $alertMessage }}
                                </p>
                            </div>
                        </div>
                    @endif

                    <!-- Session Status -->
                    @if (isset($showSessionStatus) && $showSessionStatus)
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                    @endif

                    <!-- Main Content -->
                    {{ $slot }}

                    @if (isset($backLink))
                        <!-- Back Link -->
                        <div class="mt-6 text-center">
                            <a href="{{ $backLink }}"
                                class="text-sm text-green-600 hover:text-green-500 transition-colors">
                                {{ $backText ?? '← Kembali' }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Footer -->
                <div class="mt-8 text-center">
                    <p class="text-xs text-gray-500">
                        © {{ date('Y') }} Sistem Informasi Perhutani. Semua hak dilindungi.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sweet Alert Messages -->
    <x-sweet-alert />
</body>

</html>
