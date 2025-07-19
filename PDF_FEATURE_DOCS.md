# Fitur Cetak PDF - Sistem Informasi Perhutani

## 📄 Overview

Fitur ini memungkinkan pengguna untuk mencetak laporan dan pengajuan dalam format PDF yang professional dan lengkap.

## 🚀 Fitur Yang Tersedia

### 1. **Cetak PDF Laporan**

-   **Lokasi**: Admin Panel > Laporan > Action "Cetak PDF"
-   **Format**: PDF A4 Portrait
-   **Konten**:
    -   Header dengan logo dan nama sistem
    -   Informasi lengkap laporan (ID, judul, pelapor, lokasi, status, tanggal)
    -   Deskripsi kejadian
    -   Foto bukti (jika ada)
    -   Tanda tangan pelapor dan petugas
    -   Footer dengan timestamp

### 2. **Cetak PDF Pengajuan**

-   **Lokasi**: Admin Panel > Pengajuan > Action "Cetak PDF"
-   **Format**: PDF A4 Portrait
-   **Konten**:
    -   Header dengan logo dan nama sistem
    -   Informasi lengkap pengajuan (ID, judul, pemohon, lokasi, status, tanggal)
    -   Deskripsi pengajuan
    -   Informasi dokumen pendukung (jika ada)
    -   Catatan dari petugas (jika ada)
    -   Tanda tangan pemohon dan petugas
    -   Footer dengan timestamp

## 🎨 Desain PDF

### **Template Laporan**

-   **Warna Tema**: Hijau (#22C55E) - sesuai tema kehutanan
-   **Layout**: Professional dengan watermark
-   **Status Badge**:
    -   Pending: Kuning
    -   In Progress: Biru
    -   Resolved: Hijau

### **Template Pengajuan**

-   **Warna Tema**: Biru (#3B82F6) - membedakan dari laporan
-   **Layout**: Professional dengan watermark
-   **Status Badge**:
    -   Pending: Kuning
    -   Approved: Hijau
    -   Rejected: Merah

## 🔧 Implementasi Teknis

### **Package Yang Digunakan**

```bash
composer require barryvdh/laravel-dompdf
```

### **Template Files**

-   `resources/views/pdf/report.blade.php` - Template PDF laporan
-   `resources/views/pdf/submission.blade.php` - Template PDF pengajuan

### **Action Implementation**

```php
Tables\Actions\Action::make('printPDF')
    ->label('Cetak PDF')
    ->icon('heroicon-o-printer')
    ->color('success')
    ->action(function (Report $record) {
        return response()->streamDownload(function () use ($record) {
            echo app('dompdf.wrapper')
                ->loadView('pdf.report', ['report' => $record])
                ->setPaper('a4', 'portrait')
                ->stream();
        }, 'laporan-' . $record->id . '-' . now()->format('Y-m-d') . '.pdf');
    })
    ->tooltip('Download laporan dalam format PDF');
```

## 📱 Cara Penggunaan

### **Untuk Admin/Petugas:**

1. Login ke admin panel
2. Navigasi ke menu "Laporan" atau "Pengajuan"
3. Pada tabel data, klik icon printer (🖨️) di kolom action
4. PDF akan otomatis ter-download

### **Untuk Masyarakat:**

1. Login ke admin panel
2. Lihat data laporan/pengajuan milik sendiri
3. Klik icon printer untuk download PDF

## 🔒 Permissions & Security

### **Akses Cetak PDF:**

-   **Admin**: Bisa cetak semua laporan dan pengajuan
-   **Petugas**: Bisa cetak semua laporan dan pengajuan
-   **Masyarakat**: Hanya bisa cetak laporan/pengajuan milik sendiri

### **Security Features:**

-   Watermark pada PDF untuk mencegah pemalsuan
-   Timestamp otomatis saat generate PDF
-   File naming dengan ID dan tanggal untuk tracking

## 📋 Format File Output

### **Naming Convention:**

-   **Laporan**: `laporan-{ID}-{YYYY-MM-DD}.pdf`
-   **Pengajuan**: `pengajuan-{ID}-{YYYY-MM-DD}.pdf`

### **Contoh:**

-   `laporan-123-2025-07-19.pdf`
-   `pengajuan-456-2025-07-19.pdf`

## 🎯 Fitur PDF

### **Styling:**

-   Responsive layout untuk berbagai ukuran kertas
-   Professional typography
-   Color-coded status badges
-   Watermark background
-   Structured information layout

### **Content Features:**

-   Semua data field yang relevan
-   Foto/dokumen indicator (jika ada)
-   Status tracking dengan tanggal
-   Signature section
-   Official footer dengan copyright

## ⚙️ Konfigurasi

### **DomPDF Settings** (config/dompdf.php):

```php
'paper' => 'a4',
'orientation' => 'portrait',
'enable_remote' => true, // Untuk load gambar
'enable_php' => false,   // Security
```

### **Custom Styling:**

-   Template menggunakan inline CSS untuk kompatibilitas
-   Support untuk gambar dari storage
-   Mobile-friendly print layout

## 🔄 Maintenance & Updates

### **Updating Templates:**

1. Edit file di `resources/views/pdf/`
2. Test dengan generate PDF
3. Verify layout dan content

### **Adding New Fields:**

1. Update model relationships jika perlu
2. Modify PDF template
3. Test dengan data sample

## 📞 Support Notes

### **Troubleshooting:**

-   Pastikan folder `storage/app/public` readable
-   Check permission untuk write temporary files
-   Verify image paths untuk foto bukti

### **Performance:**

-   PDF generation real-time saat download
-   No caching untuk data security
-   Optimized for small to medium datasets

---

**Dibuat pada**: 19 Juli 2025  
**Version**: 1.0  
**Maintainer**: System Administrator
