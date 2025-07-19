# 📱 Responsive Navbar - Dokumentasi

## Overview

Navbar responsif yang memberikan pengalaman optimal di semua perangkat dengan desain yang berbeda untuk mobile, tablet, dan desktop.

## Breakpoints

### 📱 Mobile (< 768px)

-   **Hamburger menu** dengan animasi smooth
-   **Logo disingkat** menjadi "Perhutani"
-   **Full-width mobile menu** dengan icons dan smooth transitions
-   **User profile section** dengan avatar dan info user

### 📊 Tablet & Desktop (≥ 768px)

-   **Horizontal navigation** menu
-   **Full logo** "Sistem Informasi Perhutani"
-   **User dropdown** dengan hover effects
-   **Inline menu items** dengan spacing optimal

## Features

### ✅ Mobile Menu Features

-   **Smooth slide animations** dengan Alpine.js transitions
-   **Icon-enhanced menu items** untuk UX yang lebih baik
-   **Border highlight effects** saat hover
-   **Auto-close** saat klik menu item
-   **Outside click detection** untuk menutup menu
-   **User section** terpisah dengan background berbeda

### ✅ Responsive Logo

-   **Desktop**: "Sistem Informasi Perhutani"
-   **Mobile**: "Perhutani" (lebih ringkas)
-   **Adaptive text size** (text-lg pada mobile, text-xl pada desktop)

### ✅ Touch-Friendly

-   **Larger touch targets** (py-3 instead of py-2)
-   **Visual feedback** dengan hover states
-   **Proper spacing** untuk thumb navigation

## Technical Implementation

### Breakpoint Strategy

```html
<!-- Desktop Menu: md:flex (768px+) -->
<div class="hidden md:flex md:items-center md:space-x-8">
    <!-- Mobile Button: md:hidden (< 768px) -->
    <div class="md:hidden flex items-center">
        <!-- Mobile Menu: md:hidden (< 768px) -->
        <div x-show="mobileOpen" class="md:hidden"></div>
    </div>
</div>
```

### Alpine.js Integration

```javascript
// Navbar state
x-data="{ mobileOpen: false }"

// Auto-close on outside click
@click.away="mobileOpen = false"

// Auto-close on navigation
@click="mobileOpen = false"
```

### Smooth Animations

```html
x-transition:enter="transition ease-out duration-200"
x-transition:enter-start="opacity-0 transform -translate-y-1"
x-transition:enter-end="opacity-100 transform translate-y-0"
x-transition:leave="transition ease-in duration-150"
x-transition:leave-start="opacity-100 transform translate-y-0"
x-transition:leave-end="opacity-0 transform -translate-y-1"
```

## Menu Structure

### 🏠 Main Navigation

1. **Beranda** - Home icon
2. **Tanaman** - Plant/leaf icon
3. **Artikel** - Document icon
4. **Laporan** - Report icon (auth only)
5. **Pengajuan** - Submission icon (auth only)

### 👤 User Section (Authenticated)

-   **User Avatar** (12x12 on mobile, 8x8 on desktop)
-   **User Info** (name + email)
-   **Profile Link** - User icon
-   **Admin Panel** - Dashboard icon (admin only)
-   **Logout** - Logout icon (red color)

### 🔐 Guest Section

-   **Login** - Login icon
-   **Register** - Sign-up icon (green button style)

## Styling Details

### Color Scheme

-   **Primary**: Green (#16a34a)
-   **Hover**: Green-600 (#16a34a)
-   **Background**: White
-   **Text**: Gray-700
-   **Accent**: Green-50 for hover backgrounds

### Visual Enhancements

-   **Shadow**: `shadow-lg` for depth
-   **Border**: Green border-b for brand consistency
-   **Icons**: Heroicons dengan stroke-width 2
-   **Transitions**: 200ms ease-out untuk smooth interactions

## Browser Support

### Modern Features

-   ✅ CSS Grid & Flexbox
-   ✅ Alpine.js directives
-   ✅ CSS Transitions & Transforms
-   ✅ Touch events

### Mobile Optimization

-   ✅ Touch-friendly sizing (44px minimum)
-   ✅ No hover states on touch devices
-   ✅ Proper viewport meta tag
-   ✅ Fast tap responses

## Performance

### Optimizations

-   **Minimal DOM manipulation** dengan Alpine.js
-   **CSS-only animations** untuk smooth performance
-   **Efficient event handling** dengan Alpine directives
-   **Lazy loading** untuk dropdown content

### Bundle Size

-   **Alpine.js**: ~10KB gzipped
-   **Custom CSS**: Minimal custom styles
-   **Icons**: Inline SVG untuk speed

## Accessibility

### ARIA Support

-   Proper focus management
-   Keyboard navigation support
-   Screen reader friendly
-   Semantic HTML structure

### User Experience

-   Clear visual hierarchy
-   Consistent interaction patterns
-   Loading states integration
-   Error state handling

## Customization

### Change Breakpoint

Edit breakpoint dari `md:` ke yang lain:

```html
<!-- Untuk tablet-first (lg: 1024px) -->
<div class="hidden lg:flex">
    <div class="lg:hidden">
        <!-- Untuk mobile-only (sm: 640px) -->
        <div class="hidden sm:flex">
            <div class="sm:hidden"></div>
        </div>
    </div>
</div>
```

### Add Menu Items

```html
<a
    href="/new-page"
    @click="mobileOpen = false"
    class="block px-4 py-3 text-base font-medium text-gray-700 hover:text-green-600 hover:bg-green-50 transition-colors border-l-4 border-transparent hover:border-green-500"
>
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-3"><!-- icon --></svg>
        New Menu
    </div>
</a>
```

### Custom Icons

Ganti dengan icon yang diinginkan dari Heroicons:

```html
<svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
    <path
        stroke-linecap="round"
        stroke-linejoin="round"
        stroke-width="2"
        d="..."
    />
</svg>
```

## Integration

### With Page Loader

Navbar terintegrasi dengan page loader:

-   Auto-close mobile menu saat navigation
-   Loading indicator muncul saat navigasi
-   Smooth transition between pages

### With Authentication

-   Dynamic menu berdasarkan auth status
-   Role-based menu items (admin panel)
-   User avatar dari database/API

## Files

```
resources/
├── views/
│   └── components/
│       └── navbar.blade.php (Main component)
├── css/
│   └── app.css (Custom navbar styles)
└── js/
    └── bootstrap.js (Alpine.js setup)
```

---

**Status: ✅ Responsive & Mobile-First**  
**Breakpoint: 📱 < 768px (Mobile) | 📊 ≥ 768px (Tablet+)**  
**UX: 🚀 Touch-Optimized Navigation**
