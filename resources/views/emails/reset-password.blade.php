<x-mail::message>
    # Reset Password - Sistem Informasi Perhutani

    Halo {{ $name }},

    Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda di Sistem Informasi
    Perhutani.

    <x-mail::button :url="$url" color="success">
        Reset Password
    </x-mail::button>

    Link reset password ini akan kedaluwarsa dalam
    {{ config('auth.passwords.' . config('auth.defaults.passwords') . '.expire') }} menit.

    Jika Anda tidak melakukan permintaan reset password, tidak ada tindakan lebih lanjut yang diperlukan.

    ---

    **Sistem Informasi Perhutani**
    Platform terintegrasi untuk pengelolaan informasi perhutani yang efektif dan berkelanjutan.

    **Catatan Keamanan:**
    - Jangan bagikan link ini kepada siapa pun
    - Link ini hanya berlaku untuk satu kali penggunaan
    - Jika Anda mencurigai aktivitas yang tidak biasa, segera hubungi administrator

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
