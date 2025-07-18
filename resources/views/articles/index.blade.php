@extends('layouts.app')

@section('title', 'Artikel - Sistem Informasi Perhutani')

@section('content')
    <!-- Header Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">
                    Artikel Perhutani
                </h1>
                <p class="text-xl text-green-100 max-w-3xl mx-auto">
                    Baca artikel terbaru seputar kehutanan, konservasi alam, dan praktik pengelolaan hutan berkelanjutan
                </p>
            </div>
        </div>
    </section>

    <!-- Articles Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $articles = \App\Models\Article::whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->orderBy('published_at', 'desc')
                    ->paginate(9);
            @endphp

            @if ($articles->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach ($articles as $article)
                        <article
                            class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            @if ($article->cover_image)
                                <img class="w-full h-48 object-cover"
                                    src="{{ Storage::disk('public')->url($article->cover_image) }}"
                                    alt="{{ $article->title }}">
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                    <span class="text-white text-2xl font-bold">{{ substr($article->title, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h2 class="text-xl font-semibold text-gray-900 mb-3 line-clamp-2">
                                    {{ $article->title }}
                                </h2>
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ strip_tags(Str::limit($article->content, 150)) }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-gray-500">
                                        {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                                    </span>
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        Baca Artikel
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="flex justify-center">
                    {{ $articles->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Belum Ada Artikel</h3>
                    <p class="text-gray-600 mb-6">Belum ada artikel yang dipublikasikan saat ini.</p>
                    @auth
                        <a href="/admin/articles/create"
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                            Tulis Artikel Pertama
                        </a>
                    @endauth
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
