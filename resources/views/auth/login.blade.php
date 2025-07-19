<x-auth-layout 
    title="Sistem Informasi Perhutani - Login"
    page-title="Sistem Informasi Perhutani"
    page-description="Masuk ke akun Anda untuk melanjutkan"
    :show-session-status="true">
    
    <x-slot:icon>
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
        </svg>
    </x-slot:icon>

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
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

        <!-- Password -->
        <x-auth-input 
            name="password" 
            type="password" 
            label="Password" 
            placeholder="Masukkan password Anda"
            :required="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember" 
                    class="h-4 w-4 text-green-600 focus:ring-green-500 border-gray-300 rounded">
                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                    class="text-sm text-green-600 hover:text-green-500 transition-colors">
                    Lupa password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <x-auth-button>
            <x-slot:icon>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                </svg>
            </x-slot:icon>
            Masuk
        </x-auth-button>
    </form>

    <!-- Register Link -->
    @if (Route::has('register'))
        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                Belum punya akun? 
                <a href="{{ route('register') }}" class="font-medium text-green-600 hover:text-green-500 transition-colors">
                    Daftar sekarang
                </a>
            </p>
        </div>
    @endif
</x-auth-layout>
