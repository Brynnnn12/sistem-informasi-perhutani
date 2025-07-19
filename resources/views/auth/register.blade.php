<x-auth-layout 
    title="Sistem Informasi Perhutani - Daftar"
    page-title="Sistem Informasi Perhutani"
    page-description="Buat akun baru untuk bergabung">
    
    <x-slot:icon>
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
        </svg>
    </x-slot:icon>

    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <x-auth-input 
            name="name" 
            type="text" 
            label="Nama Lengkap" 
            placeholder="Masukkan nama lengkap Anda"
            :required="true"
            :autofocus="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Email Address -->
        <x-auth-input 
            name="email" 
            type="email" 
            label="Email" 
            placeholder="Masukkan email Anda"
            :required="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Password -->
        <x-auth-input 
            name="password" 
            type="password" 
            label="Password" 
            placeholder="Masukkan password"
            :required="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Confirm Password -->
        <x-auth-input 
            name="password_confirmation" 
            type="password" 
            label="Konfirmasi Password" 
            placeholder="Konfirmasi password Anda"
            :required="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Submit Button -->
        <x-auth-button>
            <x-slot:icon>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
                </svg>
            </x-slot:icon>
            Daftar
        </x-auth-button>
    </form>

    <!-- Login Link -->
    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">
            Sudah punya akun? 
            <a href="{{ route('login') }}" class="font-medium text-green-600 hover:text-green-500 transition-colors">
                Masuk di sini
            </a>
        </p>
    </div>
</x-auth-layout>
