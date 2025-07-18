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

-   **📊 Pelaporan Digital**: Sistem pelaporan masalah kehutanan secara real-time
-   **🌲 Database Tanaman**: Katalog lengkap spesies flora dan fauna hutan
-   **📄 Pengajuan Izin**: Platform untuk permohonan izin pemanfaatan lahan
-   **📈 Dashboard Analitik**: Visualisasi data dan statistik kehutanan
-   **👥 Kolaborasi Komunitas**: Platform komunikasi antar stakeholder
-   **🗺️ Pemetaan Digital**: Sistem informasi geografis untuk area hutan
-   **📚 Pusat Edukasi**: Resource pembelajaran tentang konservasi hutan
-   **🔔 Notifikasi Real-time**: Alert untuk kondisi darurat atau perubahan status

## Fitur Utama

### 🔐 Sistem Otentikasi & Otorisasi

-   Multi-level user management (Admin, Petugas Lapangan, Masyarakat)
-   Role-based access control menggunakan Spatie Permission
-   Profile management dengan avatar dan informasi detail

### 📊 Modul Pelaporan

-   Form pelaporan interaktif dengan validasi
-   Upload foto dan dokumen pendukung
-   Tracking status laporan real-time
-   Notifikasi otomatis untuk follow-up

### 🌿 Database Biodiversitas

-   Katalog spesies tanaman dengan informasi lengkap
-   Pencarian dan filter berdasarkan kategori
-   Gambar dan deskripsi detail setiap spesies
-   Status konservasi dan persebaran

### 📋 Manajemen Pengajuan

-   Form pengajuan izin online
-   Workflow approval multi-level
-   Document management terintegrasi
-   Tracking progress dan timeline

### 📈 Dashboard & Analytics

-   Visualisasi data menggunakan Chart.js
-   Report generator dengan export PDF/Excel
-   Key Performance Indicators (KPI) kehutanan
-   Trend analysis dan forecasting

## Teknologi yang Digunakan

### Backend

-   **Laravel 11.x**: PHP framework untuk rapid development
-   **MySQL/SQLite**: Database management system
-   **Filament**: Admin panel yang powerful dan modern
-   **Spatie Permission**: Role dan permission management

### Frontend

-   **Blade Templates**: Server-side rendering dengan komponen modular
-   **Tailwind CSS**: Utility-first CSS framework
-   **Alpine.js**: Lightweight JavaScript framework
-   **Chart.js**: Library untuk visualisasi data

### Tools & Integration

-   **Vite**: Modern build tool untuk asset compilation
-   **Pest**: Testing framework untuk PHP
-   **Git**: Version control system
-   **Composer**: PHP dependency manager

## Instalasi & Setup

### Prasyarat

-   PHP 8.2 atau lebih tinggi
-   Composer
-   Node.js & NPM
-   MySQL atau SQLite

### Langkah Instalasi

1. **Clone Repository**

```bash
git clone https://github.com/username/sistem-informasi-perhutani.git
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
php artisan migrate
php artisan db:seed
```

5. **Build Assets**

```bash
npm run build
# atau untuk development
npm run dev
```

6. **Start Server**

```bash
php artisan serve
```

## Kontribusi

Kami sangat menghargai kontribusi dari komunitas! Silakan ikuti panduan berikut:

1. Fork repository ini
2. Buat branch feature baru (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

### Panduan Kontribusi

-   Ikuti PSR-12 coding standards
-   Tulis test untuk fitur baru
-   Update dokumentasi jika diperlukan
-   Pastikan semua test passing

## Lisensi

Sistem Informasi Perhutani adalah open-source software yang dilisensikan di bawah [MIT License](https://opensource.org/licenses/MIT).

## Tim Pengembang

-   **Lead Developer**: [Your Name]
-   **Backend Developer**: [Name]
-   **Frontend Developer**: [Name]
-   **UI/UX Designer**: [Name]

## Dukungan

Jika Anda mengalami masalah atau memiliki pertanyaan:

-   📧 Email: support@perhutani-system.com
-   📱 WhatsApp: +62-xxx-xxxx-xxxx
-   🐛 Issue Tracker: [GitHub Issues](https://github.com/username/sistem-informasi-perhutani/issues)

## Roadmap

### Q1 2025

-   [x] Setup dasar sistem
-   [x] Modul authentication
-   [x] Dashboard admin dengan Filament
-   [ ] Implementasi sistem pelaporan

### Q2 2025

-   [ ] Modul database tanaman
-   [ ] Sistem pengajuan izin
-   [ ] Mobile responsive optimization
-   [ ] API development

### Q3 2025

-   [ ] Integrasi sistem GIS
-   [ ] Mobile application
-   [ ] Advanced analytics
-   [ ] Real-time notifications

### Q4 2025

-   [ ] Machine learning integration
-   [ ] Performance optimization
-   [ ] Security enhancement
-   [ ] Documentation improvement

---

<p align="center">
    <strong>Dibuat dengan ❤️ untuk Pelestarian Hutan Indonesia</strong>
</p>
