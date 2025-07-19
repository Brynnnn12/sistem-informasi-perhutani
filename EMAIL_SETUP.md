# Email Reset Password Setup

## Konfigurasi Email

### 1. Mailtrap untuk Development

Dalam file `.env`, konfigurasi Mailtrap sudah diatur:

```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=aaad0e52dfac55
MAIL_PASSWORD=b7c95ffc234f36
MAIL_FROM_ADDRESS="noreply@perhutani.go.id"
MAIL_FROM_NAME="Sistem Informasi Perhutani"
```

### 2. Komponen Email Kustom

#### ResetPasswordMail (Mailable)

-   File: `app/Mail/ResetPasswordMail.php`
-   Template: `resources/views/emails/reset-password.blade.php`
-   Menggunakan Markdown template dengan tema kustom

#### ResetPasswordNotification

-   File: `app/Notifications/ResetPasswordNotification.php`
-   Override default Laravel reset password notification
-   Menggunakan ResetPasswordMail yang kustom

#### Custom Theme

-   File: `resources/views/vendor/mail/html/themes/perhutani.css`
-   Tema email yang disesuaikan dengan branding Perhutani
-   Warna hijau yang konsisten dengan sistem

### 3. Konfigurasi di User Model

Model User sudah di-override method `sendPasswordResetNotification()` untuk menggunakan notification kustom.

## Testing

### Preview Email Template

Dalam development mode, Anda bisa preview email template di:

```
http://localhost:8000/email-preview/reset-password
```

### Mailtrap

-   Login ke Mailtrap.io
-   Buka inbox untuk melihat email yang terkirim
-   Periksa tampilan HTML dan text version

### Manual Testing

Test reset password melalui halaman login dengan "Forgot Password" link.

## Features

### Email Template Features

-   ✅ Responsive design
-   ✅ Custom branding (Perhutani green theme)
-   ✅ Personalized greeting
-   ✅ Clear CTA button
-   ✅ Security notes
-   ✅ Professional footer
-   ✅ Token expiration info

### Security Features

-   ✅ One-time use token
-   ✅ Token expiration (default 60 minutes)
-   ✅ Rate limiting/throttling
-   ✅ Secure reset URL

## Production Setup

Untuk production, ganti konfigurasi email di `.env`:

```env
# Contoh untuk Gmail SMTP
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls

# Atau untuk service email lain seperti Mailgun, SendGrid, etc.
```

## Troubleshooting

### "Please wait before retrying" Error

Ini terjadi karena Laravel memiliki throttling untuk mencegah spam reset password. Solusi:

#### 1. Clear Throttle untuk User Tertentu

```bash
php artisan auth:clear-reset-throttle admin@perhutani.go.id
```

#### 2. Clear Semua Throttle

```bash
php artisan auth:clear-reset-throttle
```

### Konfigurasi Throttle

Di `config/auth.php`:

```php
'passwords' => [
    'users' => [
        'throttle' => 10, // detik sebelum bisa kirim lagi
        'expire' => 60,   // menit sebelum token expired
    ],
],
```

**Catatan:** Throttle diset 10 detik untuk development. Untuk production, sebaiknya 60 detik atau lebih.

### Email tidak terkirim

1. Cek konfigurasi SMTP di `.env`
2. Pastikan queue worker berjalan jika menggunakan queue
3. Cek log di `storage/logs/laravel.log`

### Template tidak muncul dengan benar

1. Clear view cache: `php artisan view:clear`
2. Clear config cache: `php artisan config:clear`
3. Rebuild assets: `npm run build`

### Throttling error

```bash
# Clear password reset tokens
php artisan tinker
DB::table('password_reset_tokens')->delete();
```
