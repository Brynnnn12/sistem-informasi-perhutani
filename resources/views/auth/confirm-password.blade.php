<x-auth-layout 
    title="Sistem Informasi Perhutani - Konfirmasi Password"
    page-title="Konfirmasi Password"
    page-description="Ini adalah area aman aplikasi. Silakan konfirmasi password Anda sebelum melanjutkan">
    
    <x-slot:icon>
        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.018.118l2.976-2.888a1.5 1.5 0 00-2.121-2.12l-2.888 2.976-1.877-.393a2.5 2.5 0 00-3.097 2.384 8.5 8.5 0 01-1.01 3.118L12 17l4.518-1.01a2.5 2.5 0 002.384-3.097l-.393-1.877z"></path>
        </svg>
    </x-slot:icon>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <x-auth-input 
            name="password" 
            type="password" 
            label="Password" 
            placeholder="Masukkan password Anda"
            :required="true"
            :autofocus="true">
            <x-slot:icon>
                <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                </svg>
            </x-slot:icon>
        </x-auth-input>

        <!-- Submit Button -->
        <x-auth-button>
            <x-slot:icon>
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </x-slot:icon>
            Konfirmasi
        </x-auth-button>
    </form>
</x-auth-layout>
