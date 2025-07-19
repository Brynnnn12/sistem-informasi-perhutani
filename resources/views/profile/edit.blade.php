@extends('layouts.app')

@section('title', 'Profile Settings - Sistem Informasi Perhutani')

@section('content')
    <div x-data="{
        activeTab: 'profile-info',
        selectedAvatar: @js(Auth::user()->avatar ?? 'anime-1'),
        availableAvatars: @js(\App\Models\User::getAvailableAvatars()),
        updateAvatarPreview(avatarKey) {
            this.selectedAvatar = avatarKey;
            // Update header avatar
            const headerAvatar = document.querySelector('.h-24.w-24.rounded-full');
            if (headerAvatar) {
                headerAvatar.src = 'https://api.dicebear.com/9.x/croodles/svg?seed=' + avatarKey;
            }
            // Update current avatar in avatar settings tab
            const currentAvatar = document.querySelector('#current-avatar');
            if (currentAvatar) {
                currentAvatar.src = 'https://api.dicebear.com/9.x/croodles/svg?seed=' + avatarKey;
            }
        }
    }">
        <!-- Profile Header -->
        <div class="bg-gradient-to-r from-green-600 to-green-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <img class="h-24 w-24 rounded-full border-4 border-white shadow-lg object-cover"
                            src="{{ Auth::user()->getAvatarUrl() }}" alt="{{ Auth::user()->name }}">
                        <div class="absolute bottom-0 right-0 bg-green-500 rounded-full p-2 border-2 border-white">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z">
                                </path>
                            </svg>
                        </div>
                    </div>
                    <div class="text-white">
                        <h1 class="text-3xl font-bold">{{ Auth::user()->name }}</h1>
                        <p class="text-green-100 text-lg">{{ Auth::user()->email }}</p>
                        <div class="flex items-center mt-2 space-x-4">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-green-100">Member sejak
                                    {{ Auth::user()->created_at->format('M Y') }}</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="text-sm text-green-100">Akun Terverifikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation Tabs -->
        <div class="bg-white border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <nav class="flex space-x-8" aria-label="Tabs">
                    <a href="#profile-info" @click.prevent="activeTab = 'profile-info'"
                        :class="activeTab === 'profile-info' ? 'border-green-500 text-green-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="tab-link whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Profile
                    </a>
                    <a href="#avatar-settings" @click.prevent="activeTab = 'avatar-settings'"
                        :class="activeTab === 'avatar-settings' ? 'border-green-500 text-green-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="tab-link whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z">
                            </path>
                        </svg>
                        Avatar Anime
                    </a>
                    <a href="#security" @click.prevent="activeTab = 'security'"
                        :class="activeTab === 'security' ? 'border-green-500 text-green-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="tab-link whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z">
                            </path>
                        </svg>
                        Keamanan
                    </a>
                    <a href="#danger-zone" @click.prevent="activeTab = 'danger-zone'"
                        :class="activeTab === 'danger-zone' ? 'border-green-500 text-green-600' :
                            'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="tab-link whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                            </path>
                        </svg>
                        Zona Bahaya
                    </a>
                </nav>
            </div>
        </div>

        <!-- Content Area -->
        <div class="py-8 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <!-- Profile Information Tab -->
                <div x-show="activeTab === 'profile-info'" class="tab-content">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Informasi Profile</h3>
                            <p class="text-sm text-gray-600 mt-1">Update informasi profile dan email address Anda.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>
                </div>

                <!-- Avatar Settings Tab -->
                <div x-show="activeTab === 'avatar-settings'" class="tab-content" style="display: none;" x-transition>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Avatar Anime</h3>
                            <p class="text-sm text-gray-600 mt-1">Pilih avatar anime favorit Anda dari koleksi yang
                                tersedia.
                            </p>
                        </div>
                        <div class="p-6">
                            <form method="POST" action="{{ route('profile.update-avatar') }}" class="space-y-6">
                                @csrf
                                @method('PATCH')

                                <!-- Current Avatar -->
                                <div class="flex items-center space-x-4 mb-6">
                                    <div class="relative">
                                        <img id="current-avatar"
                                            class="h-20 w-20 rounded-full border-4 border-gray-200 shadow-lg object-cover"
                                            :src="'https://api.dicebear.com/9.x/croodles/svg?seed=' + selectedAvatar"
                                            alt="Current Avatar">
                                    </div>
                                    <div>
                                        <h4 class="text-lg font-medium text-gray-900">Avatar Saat Ini</h4>
                                        <p class="text-sm text-gray-600"
                                            x-text="availableAvatars[selectedAvatar] || 'Default Avatar'">
                                        </p>
                                    </div>
                                </div>

                                <!-- Avatar Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-4">Pilih Avatar Baru</label>
                                    <div class="grid grid-cols-4 gap-4">
                                        @foreach (\App\Models\User::getAvailableAvatars() as $avatarKey => $avatarName)
                                            <label class="relative cursor-pointer group">
                                                <input type="radio" name="avatar" value="{{ $avatarKey }}"
                                                    class="sr-only avatar-radio"
                                                    :checked="selectedAvatar === '{{ $avatarKey }}'"
                                                    @change="updateAvatarPreview('{{ $avatarKey }}')">
                                                <div :class="selectedAvatar === '{{ $avatarKey }}' ?
                                                    'border-green-500 bg-green-50' : 'border-gray-200'"
                                                    class="avatar-option border-2 rounded-lg p-2 group-hover:border-green-400 transition-colors duration-200">
                                                    <img class="w-16 h-16 rounded-full mx-auto object-cover shadow-md"
                                                        src="https://api.dicebear.com/9.x/croodles/svg?seed={{ $avatarKey }}"
                                                        alt="{{ $avatarName }}">
                                                    <p class="text-xs text-center mt-2 text-gray-600">{{ $avatarName }}
                                                    </p>
                                                </div>
                                                <div x-show="selectedAvatar === '{{ $avatarKey }}'"
                                                    class="avatar-check absolute -top-2 -right-2 bg-green-500 text-white rounded-full w-6 h-6 flex items-center justify-center">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd"
                                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </div>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Save Button -->
                                <div class="flex justify-end">
                                    <button type="submit"
                                        class="bg-green-600 hover:bg-green-700 text-white font-medium py-2 px-6 rounded-lg transition duration-200 flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Avatar
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Security Tab -->
                <div x-show="activeTab === 'security'" class="tab-content" style="display: none;" x-transition>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                            <h3 class="text-lg font-semibold text-gray-900">Keamanan Akun</h3>
                            <p class="text-sm text-gray-600 mt-1">Pastikan akun Anda aman dengan menggunakan password yang
                                kuat.
                            </p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>
                </div>

                <!-- Danger Zone Tab -->
                <div x-show="activeTab === 'danger-zone'" class="tab-content" style="display: none;" x-transition>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden border-l-4 border-red-500">
                        <div class="px-6 py-4 border-b border-gray-200 bg-red-50">
                            <h3 class="text-lg font-semibold text-red-900">Zona Bahaya</h3>
                            <p class="text-sm text-red-600 mt-1">Tindakan di bawah ini bersifat permanen dan tidak dapat
                                dibatalkan.</p>
                        </div>
                        <div class="p-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>

                <!-- Quick Actions Card -->
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6" x-data="{}">
                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Dashboard Admin</h4>
                                <p class="text-sm text-gray-600">Akses panel administrasi</p>
                            </div>
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-4">
                            <a href="/admin"
                                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Buka Dashboard
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                    </path>
                                </svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Buat Laporan</h4>
                                <p class="text-sm text-gray-600">Laporkan masalah hutan</p>
                            </div>
                            <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-4">
                            <button @click="$dispatch('open-report-modal')"
                                class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Buat Laporan
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition-shadow">
                        <div class="flex items-center justify-between">
                            <div>
                                <h4 class="text-lg font-semibold text-gray-900">Buat Pengajuan</h4>
                                <p class="text-sm text-gray-600">Ajukan permohonan izin</p>
                            </div>
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                </path>
                            </svg>
                        </div>
                        <div class="mt-4">
                            <button @click="$dispatch('open-submission-modal')"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors">
                                Buat Pengajuan
                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Back to Home -->
                <div class="mt-8 text-center">
                    <a href="{{ route('home') }}"
                        class="inline-flex items-center px-6 py-3 border border-gray-300 rounded-lg text-gray-700 bg-white hover:bg-gray-50 font-medium transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection
