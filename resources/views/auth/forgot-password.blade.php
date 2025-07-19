<x-auth-layout 
    title="Sistem Informasi Perhutani - Lupa Password"
    page-title="Lupa Password?"
    page-description="Tidak masalah. Berikan email Anda dan kami akan mengirimkan link reset password">
    
    <x-slot:icon>
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
        </svg>
    </x-slot:icon>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <x-auth-input 
            name="email" 
            type="email" 
            label="Email" 
            placeholder="Masukkan email Anda"
            :required="true"
            :autofocus="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Submit Button -->
        <x-auth-button>
            <x-slot:icon>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                </svg>
            </x-slot:icon>
            Kirim Link Reset Password
        </x-auth-button>
    </form>

    <!-- Back to Login Link -->
    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="inline-flex items-center text-sm text-gray-600 hover:text-green-600 transition-colors">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali ke halaman login
        </a>
    </div>
</x-auth-layout>
