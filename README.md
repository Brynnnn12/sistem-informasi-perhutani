# Sistem Informasi Perhutani

<p align="center">
    <img src="https://cdn-icons-png.flaticon.com/512/1598/1598431.png" width="100" alt="Forestry Logo">
</p>

<p align="center">
    <strong>Platform Digital untuk Pengelolaan Informasi Kehutanan</strong>
</p>

<p align="center">
<img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel" alt="Laravel">
<img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php" alt="PHP">
<img src="https://img.shields.io/badge/Tailwind-3.x-06B6D4?style=for-the-badge&logo=tailwindcss" alt="Tailwind CSS">
<img src="https://img.shields.io/badge/Alpine.js-3.x-8BC34A?style=for-the-badge&logo=alpine.js" alt="Alpine.js">
</p>

## Tentang Sistem Informasi Perhutani

Sistem Informasi Perhutani adalah platform digital yang dirancang khusus untuk mendukung pengelolaan informasi kehutanan yang efektif dan berkelanjutan. Sistem ini menyediakan berbagai fitur untuk membantu dalam:

-   **📊 Pelaporan Kejadian Hutan**: Sistem pelaporan masalah kehutanan secara digital dengan tracking status
-   **🌲 Database Tanaman**: Katalog lengkap spesies tanaman hutan dengan informasi detail
-   **📄 Pengajuan Pemanfaatan**: Platform untuk permohonan izin pemanfaatan lahan hutan
-   **�️ Manajemen Hutan**: Database lokasi hutan dengan informasi geografis
-   **👥 Manajemen Pengguna**: Sistem multi-role dengan kontrol akses yang fleksibel
-   **� Dashboard Admin**: Interface admin yang modern dengan Filament
-   **� Export PDF**: Fitur cetak laporan dalam format PDF yang kompak
-   **� Responsive Design**: Antarmuka yang responsif untuk berbagai perangkat

## Fitur Utama

### 🔐 Sistem Otentikasi & Otorisasi

-   Multi-level user management (Admin, Petugas, Masyarakat)
-   Role-based access control menggunakan Spatie Permission
-   Custom password reset dengan email template yang menarik
-   Profile management dengan informasi lengkap pengguna

### 📊 Modul Pelaporan Kejadian

-   Form pelaporan interaktif dengan validasi real-time
-   Upload foto bukti untuk dokumentasi
-   Status tracking (Menunggu, Dalam Proses, Selesai)
-   Sistem verifikasi oleh petugas yang berwenang
-   Export laporan ke PDF dengan format tabel yang kompak

### 🌿 Database Tanaman Hutan

-   Katalog lengkap spesies tanaman hutan
-   Informasi detail meliputi nama ilmiah, deskripsi, dan karakteristik
-   Pencarian dan filter berdasarkan kategori tanaman
-   Interface yang user-friendly untuk browsing data

### 📋 Manajemen Pengajuan Pemanfaatan

-   Form pengajuan pemanfaatan lahan hutan online
-   Sistem persetujuan dengan tracking status otomatis
-   Upload dokumen pendukung dengan validasi file
-   Workflow approval untuk memproses pengajuan
-   Export data pengajuan ke PDF format tabel

### 🗂️ Manajemen Database Hutan

-   Database lokasi hutan dengan informasi geografis
-   Informasi detail setiap area hutan
-   Sistem kategorisasi berdasarkan jenis hutan
-   Interface admin untuk manajemen data master

### 📈 Dashboard & Interface Modern

-   Dashboard admin yang intuitif menggunakan Filament
-   Antarmuka yang responsif dan mobile-friendly
-   Navigasi yang mudah digunakan dengan tree loader
-   Custom email templates dengan design yang menarik
-   Dark/light mode support untuk kenyamanan pengguna

## Teknologi yang Digunakan

### Backend

-   **Laravel 11.x**: PHP framework modern untuk rapid development
-   **MySQL/SQLite**: Database management system yang reliable
-   **Filament**: Admin panel yang powerful dan modern dengan interface yang intuitif
-   **Spatie Permission**: Role dan permission management yang fleksibel
-   **barryvdh/laravel-dompdf**: Library untuk generate PDF reports

### Frontend

-   **Blade Templates**: Server-side rendering dengan komponen yang modular
-   **Tailwind CSS**: Utility-first CSS framework untuk styling yang konsisten
-   **Alpine.js**: Lightweight JavaScript framework untuk interaktivitas
-   **SweetAlert2**: Library untuk notifikasi dan konfirmasi yang menarik

### Tools & Integration

-   **Vite**: Modern build tool untuk asset compilation dan hot reloading
-   **Pest**: Modern testing framework untuk PHP dengan syntax yang ekspresif
-   **Git**: Version control system untuk collaborative development
-   **Composer**: PHP dependency manager untuk package management
-   **NPM**: Node package manager untuk frontend dependencies

## Instalasi & Setup

### Prasyarat

-   PHP 8.2 atau lebih tinggi
-   Composer 2.x
-   Node.js 18.x & NPM
-   MySQL 8.x atau SQLite 3.x
-   Web server (Apache/Nginx) atau PHP built-in server

### Langkah Instalasi

1. **Clone Repository**

```bash
git clone https://github.com/Brynnnn12/sistem-informasi-perhutani.git
cd sistem-informasi-perhutani
```

2. **Install Dependencies**

```bash
composer install
npm install
```

3. **Environment Setup**

```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**

```bash
# Edit .env file untuk konfigurasi database
# Contoh untuk SQLite (default):
# DB_CONNECTION=sqlite
# DB_DATABASE=/absolute/path/to/database.sqlite

php artisan migrate
php artisan db:seed
```

5. **Create Storage Link**

```bash
php artisan storage:link
```

6. **Build Assets**

```bash
npm run build
# atau untuk development dengan hot reload
npm run dev
```

7. **Start Server**

```bash
php artisan serve
```

## User Access & Roles

Sistem memiliki 3 level akses pengguna:

### 👨‍💼 Admin

-   Akses penuh ke semua fitur sistem
-   Manajemen pengguna dan role
-   Approve/reject pengajuan dan laporan
-   Export dan generate reports

### 👮‍♂️ Petugas

-   Verifikasi laporan kejadian hutan
-   Review pengajuan pemanfaatan
-   Akses ke data master (hutan, tanaman)
-   View dashboard dan statistik

### 👥 Masyarakat

-   Submit laporan kejadian hutan
-   Ajukan permohonan pemanfaatan
-   View status pengajuan sendiri
-   Update profil personal

## Fitur PDF Export

Sistem dilengkapi dengan fitur export PDF yang sangat efisien:

-   **📄 Format Tabel Kompak**: Layout yang dioptimasi untuk muat lebih banyak data per halaman
-   **📊 Laporan Kejadian**: Export semua data laporan dalam format tabel
-   **📋 Data Pengajuan**: Export data pengajuan pemanfaatan hutan
-   **🎨 Design Professional**: Template PDF yang bersih dan mudah dibaca
-   **💾 Bulk Export**: Export multiple records sekaligus dalam satu file PDF

## Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Silakan ikuti panduan berikut:

1. Fork repository ini
2. Buat branch feature baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Panduan Kontribusi

-   Ikuti PSR-12 coding standards untuk consistency
-   Tulis test untuk fitur baru menggunakan Pest
-   Update dokumentasi jika diperlukan
-   Pastikan semua test passing sebelum submit PR
-   Gunakan conventional commits untuk pesan commit

## Screenshot & Demo

### Dashboard Admin

![Dashboard](https://via.placeholder.com/800x400?text=Admin+Dashboard+Screenshot)

### Form Laporan

![Laporan](https://via.placeholder.com/800x400?text=Form+Laporan+Screenshot)

### Export PDF

![PDF Export](https://via.placeholder.com/800x400?text=PDF+Export+Screenshot)

## Lisensi

Sistem Informasi Perhutani adalah open-source software yang dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## Tim Pengembang

-   **Lead Developer**: Brynnnn12
-   **Full-Stack Developer**: [Contributing Developer]
-   **System Analyst**: [System Analyst Name]
-   **UI/UX Consultant**: [Designer Name]

## Dukungan & Kontribusi

Jika Anda mengalami masalah atau memiliki pertanyaan:

-   � **Issue Tracker**: [GitHub Issues](https://github.com/Brynnnn12/sistem-informasi-perhutani/issues)
-   � **Email**: [your-email@domain.com]
-   � **Discussions**: [GitHub Discussions](https://github.com/Brynnnn12/sistem-informasi-perhutani/discussions)
-   📚 **Wiki**: [Project Wiki](https://github.com/Brynnnn12/sistem-informasi-perhutani/wiki)

## Roadmap & Development Status

### ✅ Q3 2025 (Completed)

-   [x] Setup dasar sistem dengan Laravel 11
-   [x] Implementasi authentication & authorization
-   [x] Dashboard admin dengan Filament yang modern
-   [x] Sistem pelaporan kejadian hutan lengkap
-   [x] Database tanaman hutan dengan CRUD operations
-   [x] Manajemen pengajuan pemanfaatan hutan
-   [x] Export PDF dengan format tabel yang kompak
-   [x] Responsive design untuk mobile dan desktop
-   [x] Custom email templates untuk password reset
-   [x] Role-based access control (Admin, Petugas, Masyarakat)

### 🚧 Q4 2025 (In Progress)

-   [ ] Advanced search dan filtering untuk semua modul
-   [ ] Dashboard analytics dengan charts dan statistik
-   [ ] Notification system untuk real-time updates
-   [ ] API endpoints untuk mobile integration
-   [ ] Advanced PDF reports dengan more customization

### 📅 Q1 2026 (Planned)

-   [ ] Mobile application (Flutter/React Native)
-   [ ] GIS integration untuk mapping hutan
-   [ ] Machine learning untuk forest condition analysis
-   [ ] Multi-language support (Bahasa Indonesia & English)
-   [ ] Advanced user management dengan organizational units

### 🎯 Q2 2026 (Future Vision)

-   [ ] IoT sensor integration untuk forest monitoring
-   [ ] Blockchain untuk transparent record keeping
-   [ ] AI-powered forest health prediction
-   [ ] Integration dengan sistem pemerintah (One Data)
-   [ ] Mobile offline capability untuk remote areas

---

<p align="center">
    <strong>Dibuat dengan ❤️ untuk Pelestarian Hutan Indonesia</strong>
</p>
