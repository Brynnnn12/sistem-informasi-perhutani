# 🎉 Email Reset Password - Setup Complete!

## ✅ Yang telah selesai dibuat:

### 1. **Custom Email Template**

-   Template dalam Bahasa Indonesia yang sesuai dengan sistem Perhutani
-   Design responsif dengan branding hijau yang konsisten
-   Informasi keamanan dan instruksi yang jelas

### 2. **Custom Notification & Mailable**

-   Override default Laravel reset password notification
-   Menggunakan template email kustom dengan data yang dipersonalisasi

### 3. **Tema Email Kustom**

-   File: `resources/views/vendor/mail/html/themes/perhutani.css`
-   Warna dan styling yang sesuai dengan sistem

### 4. **Konfigurasi Development**

-   Mailtrap sudah dikonfigurasi untuk testing
-   Throttle diset 10 detik untuk development
-   APP_NAME dan MAIL_FROM disesuaikan

### 5. **Tools dan Commands**

-   Command untuk clear throttle: `php artisan auth:clear-reset-throttle`
-   Preview email template: `http://localhost:8000/email-preview/reset-password`

## 🚀 Cara Penggunaan:

### Untuk User:

1. Klik "Forgot Password" di halaman login
2. Masukkan email
3. Cek email di inbox (Mailtrap untuk development)
4. Klik link reset password
5. Masukkan password baru

### Untuk Developer:

-   **Preview template**: `http://localhost:8000/email-preview/reset-password`
-   **Clear throttle**: `php artisan auth:clear-reset-throttle [email]`
-   **Cek Mailtrap**: Login ke Mailtrap.io untuk melihat email

## 📋 File yang dibuat/dimodifikasi:

```
app/
├── Mail/ResetPasswordMail.php (BARU)
├── Notifications/ResetPasswordNotification.php (BARU)
├── Models/User.php (DIMODIFIKASI)
├── Console/Commands/ClearPasswordResetThrottle.php (BARU)
└── Http/Controllers/EmailPreviewController.php (BARU)

resources/views/
├── emails/reset-password.blade.php (BARU)
└── vendor/mail/html/themes/perhutani.css (BARU)

config/
├── auth.php (DIMODIFIKASI - throttle setting)
└── mail.php (DIMODIFIKASI - markdown theme)

routes/web.php (DIMODIFIKASI - preview route)
.env (DIMODIFIKASI - mail config)
EMAIL_SETUP.md (BARU - dokumentasi)
```

## ✨ Features:

-   ✅ Email dalam Bahasa Indonesia
-   ✅ Branding Perhutani (hijau konsisten)
-   ✅ Responsive design
-   ✅ Personalized greeting
-   ✅ Security notes
-   ✅ One-time use token
-   ✅ Token expiration (60 menit)
-   ✅ Throttling protection (10 detik dev)

## 🔧 Siap Production:

Untuk production, tinggal ganti di `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=your-smtp-host
MAIL_PORT=587
MAIL_USERNAME=your-username
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=tls
```

Dan ubah throttle di `config/auth.php` menjadi 60 detik atau lebih.

---

**Status: ✅ SELESAI & SIAP DIGUNAKAN!**
