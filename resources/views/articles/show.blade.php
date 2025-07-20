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
                <!-- Share This Article -->
                <div class="flex flex-wrap justify-center items-center gap-3 mb-6">
                    <span class="text-gray-600 font-medium">Share this article now:</span>
                    <button onclick="navigator.clipboard.writeText(window.location.href);this.innerText='Copied!'"
                        class="px-3 py-1 bg-gray-200 hover:bg-gray-300 rounded text-sm text-gray-700 font-semibold transition">Copy
                        Link</button>
                    <a href="https://wa.me/?text={{ urlencode($article->title . ' ' . request()->fullUrl()) }}"
                        target="_blank" rel="noopener"
                        class="px-3 py-1 bg-green-500 hover:bg-green-600 rounded text-sm text-white font-semibold transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M20.52 3.48A12.07 12.07 0 0 0 12 0C5.37 0 0 5.37 0 12a11.93 11.93 0 0 0 1.64 6.06L0 24l6.18-1.62A12.07 12.07 0 0 0 12 24c6.63 0 12-5.37 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 22c-1.61 0-3.18-.31-4.65-.92l-.33-.14-3.67.96.98-3.58-.15-.34A9.94 9.94 0 0 1 2 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10 10zm5.2-7.6c-.28-.14-1.65-.81-1.9-.9-.25-.09-.43-.14-.61.14-.18.28-.7.9-.86 1.08-.16.18-.32.2-.6.07-.28-.14-1.18-.44-2.25-1.4-.83-.74-1.39-1.65-1.55-1.93-.16-.28-.02-.43.12-.57.12-.12.28-.32.42-.48.14-.16.18-.28.28-.46.09-.18.05-.34-.02-.48-.07-.14-.61-1.47-.84-2.01-.22-.53-.45-.46-.61-.47-.16-.01-.34-.01-.52-.01-.18 0-.48.07-.73.34-.25.28-.96.94-.96 2.3s.98 2.67 1.12 2.85c.14.18 1.93 2.95 4.68 4.02.65.28 1.16.45 1.56.58.65.21 1.24.18 1.7.11.52-.08 1.65-.67 1.88-1.32.23-.65.23-1.2.16-1.32-.07-.12-.25-.18-.53-.32z" />
                        </svg>
                        WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                        target="_blank" rel="noopener"
                        class="px-3 py-1 bg-blue-600 hover:bg-blue-700 rounded text-sm text-white font-semibold transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M22.675 0h-21.35C.595 0 0 .592 0 1.326v21.348C0 23.408.595 24 1.326 24H12.82v-9.294H9.692v-3.622h3.127V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.797.143v3.24l-1.918.001c-1.504 0-1.797.715-1.797 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116C23.406 24 24 23.408 24 22.674V1.326C24 .592 23.406 0 22.675 0" />
                        </svg>
                        Facebook
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($article->title) }}"
                        target="_blank" rel="noopener"
                        class="px-3 py-1 bg-blue-400 hover:bg-blue-500 rounded text-sm text-white font-semibold transition flex items-center gap-1">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.932 4.932 0 0 0 2.165-2.724c-.951.555-2.005.959-3.127 1.184C18.691 2.723 17.437 2 16.042 2c-2.675 0-4.515 2.496-3.946 5.045C7.728 6.86 4.1 5.13 1.671 2.149c-.735 1.261-.366 2.917.861 3.748A4.904 4.904 0 0 1 .964 5.885v.062c0 2.385 1.693 4.374 4.188 4.827-.413.112-.849.171-1.296.171-.314 0-.615-.03-.916-.086.631 1.953 2.445 3.377 4.604 3.417-2.07 1.623-4.678 2.348-7.29 2.034C2.29 19.29 5.026 20 7.88 20c9.142 0 14.307-7.721 13.995-14.646A9.936 9.936 0 0 0 24 4.557z" />
                        </svg>
                        Twitter
                    </a>
                </div>
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
