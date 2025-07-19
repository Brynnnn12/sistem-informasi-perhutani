# 🌳 Page Loader - Dokumentasi

## Overview

Sistem loading screen dengan tema pohon yang muncul saat navigasi antar halaman untuk memberikan feedback visual yang menarik kepada user.

## Features

### ✅ Animasi Pohon

-   **Trunk Growing**: Batang pohon tumbuh dari bawah ke atas
-   **Leaves Growing**: Daun tumbuh bertahap dengan efek scale
-   **Flying Birds**: Burung terbang dengan animasi flapping
-   **Falling Leaves**: Daun berjatuhan dengan rotasi
-   **Progress Bar**: Progress bar dengan gradient hijau

### ✅ Loading Messages

-   Pesan loading yang berubah setiap 800ms
-   6 variasi pesan dalam Bahasa Indonesia
-   Sesuai dengan konteks sistem perhutani

### ✅ Smart Detection

-   Hanya muncul untuk navigasi internal
-   Skip untuk SweetAlert dialogs
-   Skip untuk Alpine.js handled clicks
-   Skip untuk admin routes dan email preview

## Implementasi

### 1. Komponen Blade

```php
<!-- File: resources/views/components/page-loader.blade.php -->
<x-page-loader />
```

### 2. CSS Animations

-   Custom keyframes untuk animasi pohon
-   Delay classes untuk efek bertahap
-   Backdrop blur untuk efek modern

### 3. JavaScript Logic

-   Event listeners untuk click dan submit
-   Message cycling system
-   Scroll lock saat loading

## Konfigurasi

### Exclude Links dari Loading

Tambahkan class `no-loader` ke link yang tidak ingin menampilkan loading:

```html
<a href="/some-page" class="no-loader">No Loading</a>
```

### Loading Messages

Edit array `loadingMessages` di komponen untuk mengubah pesan:

```javascript
const loadingMessages = [
    "Memuat halaman...",
    "Menyiapkan konten...",
    "Custom message...",
];
```

### Timing Configuration

```javascript
// Durasi minimum loading (ms)
setTimeout(hideLoader, 800);

// Interval perubahan pesan (ms)
setInterval(changeMessage, 800);
```

## Styling

### Tree Colors

-   **Trunk**: `#8B4513` (Brown)
-   **Leaves Layer 1**: `#22C55E` (Light Green)
-   **Leaves Layer 2**: `#16A34A` (Medium Green)
-   **Leaves Layer 3**: `#15803D` (Dark Green)
-   **Birds**: `#6B7280` (Gray)
-   **Falling Leaves**: `#FCD34D`, `#F59E0B`, `#EAB308` (Yellow variants)

### Background

-   Gradient dari `#F0F9FF` ke `#ECFDF5`
-   Backdrop blur untuk efek glass

## Performance

### Optimizations

-   CSS animations menggunakan `transform` (GPU accelerated)
-   Event delegation untuk efisiensi
-   Cleanup intervals saat hide
-   Smooth transitions dengan opacity

### Memory Management

-   Clear intervals saat loader hidden
-   Remove event listeners jika diperlukan
-   Minimal DOM manipulation

## Browser Support

### Modern Features

-   ✅ CSS transforms dan animations
-   ✅ Backdrop filter (Safari 9+, Chrome 76+)
-   ✅ ES6 features (arrow functions, const/let)
-   ✅ Responsive design

### Fallbacks

-   Graceful degradation untuk browser lama
-   CSS fallbacks untuk backdrop-filter
-   Basic loading jika JavaScript disabled

## Troubleshooting

### Loading Tidak Muncul

1. Cek apakah link memiliki class `no-loader`
2. Pastikan Alpine.js tidak handle click event
3. Verify URL adalah internal navigation

### Loading Tidak Hilang

1. Cek console untuk JavaScript errors
2. Pastikan `window.addEventListener('load')` triggered
3. Verify timeout duration

### Animasi Tidak Smooth

1. Cek CSS support untuk `transform`
2. Test performa dengan DevTools
3. Reduce animation complexity jika needed

## Integration dengan SweetAlert

Loading screen otomatis skip untuk:

-   Links dengan `x-sweetalert` attribute
-   Elements dalam `.swal2-popup`
-   Links dengan `@click` Alpine directive

## Files

```
resources/
├── views/
│   └── components/
│       └── page-loader.blade.php (Main component)
├── css/
│   └── app.css (Additional styles)
└── js/
    ├── bootstrap.js (Import loader)
    └── page-loader.js (Logic - optional)
```

## Customization

### Change Tree Design

Edit SVG dalam `page-loader.blade.php`:

```html
<svg width="120" height="120" viewBox="0 0 120 120">
    <!-- Custom tree design -->
</svg>
```

### Add More Animations

Add to CSS section:

```css
@keyframes custom-animation {
    0% {
        /* start state */
    }
    100% {
        /* end state */
    }
}
```

### Different Loading Text

Modify `loadingMessages` array for different languages atau contexts.

---

**Status: ✅ Active & Working**  
**Theme: 🌳 Pohon & Alam**  
**UX: 🚀 Smooth Navigation**
