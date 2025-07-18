@extends('layouts.app')

@section('title', $article->title . ' - Sistem Informasi Perhutani')

@section('content')
    <!-- Article Header -->
    <section class="bg-gray-50 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                @if ($article->cover_image)
                    <img class="w-full h-64 md:h-96 object-cover rounded-xl shadow-lg mb-8"
                        src="{{ Storage::disk('public')->url($article->cover_image) }}" alt="{{ $article->title }}">
                @endif
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 mb-4">
                    {{ $article->title }}
                </h1>
                <div class="flex items-center justify-center space-x-4 text-gray-600">
                    <span>{{ $article->published_at ? $article->published_at->format('d F Y') : $article->created_at->format('d F Y') }}</span>
                    <span>•</span>
                    <span>{{ $article->author->name ?? 'Admin' }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="prose prose-lg max-w-none">
                {!! $article->content !!}
            </div>
        </div>
    </section>

    <!-- Related Articles or Back Button -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <a href="{{ route('articles.index') }}"
                    class="inline-flex items-center bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Artikel
                </a>
            </div>

            @php
                $relatedArticles = \App\Models\Article::whereNotNull('published_at')
                    ->where('published_at', '<=', now())
                    ->where('id', '!=', $article->id)
                    ->orderBy('published_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp

            @if ($relatedArticles->count() > 0)
                <div class="text-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">
                        Artikel Lainnya
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach ($relatedArticles as $relatedArticle)
                        <article class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                            @if ($relatedArticle->cover_image)
                                <img class="w-full h-48 object-cover"
                                    src="{{ Storage::disk('public')->url($relatedArticle->cover_image) }}"
                                    alt="{{ $relatedArticle->title }}">
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center">
                                    <span
                                        class="text-white text-xl font-bold">{{ substr($relatedArticle->title, 0, 1) }}</span>
                                </div>
                            @endif
                            <div class="p-6">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $relatedArticle->title }}
                                </h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ strip_tags(Str::limit($relatedArticle->content, 100)) }}
                                </p>
                                <a href="{{ route('articles.show', $relatedArticle->slug) }}"
                                    class="text-green-600 hover:text-green-700 font-medium">
                                    Baca Selengkapnya →
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .prose {
            max-width: none;
        }

        .prose h1,
        .prose h2,
        .prose h3,
        .prose h4,
        .prose h5,
        .prose h6 {
            color: #1f2937;
            font-weight: 600;
        }

        .prose p {
            margin-bottom: 1.25rem;
            line-height: 1.75;
        }

        .prose img {
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .prose a {
            color: #059669;
            text-decoration: none;
        }

        .prose a:hover {
            color: #047857;
            text-decoration: underline;
        }

        .prose blockquote {
            border-left: 4px solid #10b981;
            background-color: #f0fdf4;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            font-style: italic;
        }

        .prose ul,
        .prose ol {
            margin: 1.25rem 0;
            padding-left: 1.5rem;
        }

        .prose li {
            margin: 0.5rem 0;
        }

        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endpush
