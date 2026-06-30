@extends('new.layouts.sidebar')

@section('title', $insight->title . ' - Chartered Insights')
@section('meta_description', $insight->meta_description ?: Str::limit(strip_tags($insight->excerpt ?:
    $insight->content), 155))

    @push('styles')
        <style>
            /* Article Content Styling */
            .article-content {
                font-size: 1.125rem;
                line-height: 1.8;
                color: #374151;
            }

            .article-content h2 {
                @apply text-2xl md:text-3xl font-bold text-deep-chartered-blue mt-8 mb-4 border-l-4 border-fresh-teal pl-4;
            }

            .article-content h3 {
                @apply text-xl md:text-2xl font-semibold text-deep-chartered-blue mt-6 mb-3;
            }

            .article-content h4 {
                @apply text-lg md:text-xl font-medium text-deep-chartered-blue mt-4 mb-2;
            }

            .article-content p {
                @apply mb-6 text-base md:text-lg leading-relaxed;
            }

            .article-content ul,
            .article-content ol {
                @apply mb-6 pl-6;
            }

            .article-content ul li {
                @apply list-disc mb-3 text-base md:text-lg leading-relaxed;
            }

            .article-content ol li {
                @apply list-decimal mb-3 text-base md:text-lg leading-relaxed;
            }

            .article-content blockquote {
                @apply border-l-4 border-fresh-teal pl-6 italic my-8 text-gray-600 bg-gray-50 py-4 rounded-r-lg;
            }

            .article-content a {
                @apply text-fresh-teal hover:text-deep-chartered-blue transition-colors underline;
            }

            .article-content img {
                @apply rounded-xl shadow-lg my-8 w-full hover:shadow-2xl transition-shadow duration-300;
            }

            .article-content pre {
                @apply bg-gray-900 text-green-400 rounded-xl p-6 overflow-x-auto my-6 shadow-lg;
            }

            .article-content code {
                @apply bg-gray-100 px-3 py-1 rounded-md text-sm font-mono text-red-600;
            }

            /* Enhanced Share buttons */
            .share-btn {
                @apply inline-flex items-center justify-center w-12 h-12 rounded-full transition-all duration-300 transform hover:scale-110 hover:shadow-lg;
            }

            /* Enhanced Reading progress bar */
            .reading-progress {
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 4px;
                background: linear-gradient(90deg, #0891b2, #06b6d4, #22d3ee);
                z-index: 1000;
                transition: width 0.1s ease;
                box-shadow: 0 2px 4px rgba(8, 145, 178, 0.3);
            }

            /* Enhanced Back to top button */
            .back-to-top {
                position: fixed;
                bottom: 2rem;
                right: 2rem;
                width: 3.5rem;
                height: 3.5rem;
                background: linear-gradient(135deg, #0891b2, #06b6d4);
                color: white;
                border-radius: 50%;
                display: none;
                align-items: center;
                justify-content: center;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
                transition: all 0.3s ease;
                z-index: 100;
                cursor: pointer;
            }

            .back-to-top:hover {
                background: linear-gradient(135deg, #0e7490, #0891b2);
                transform: translateY(-3px);
                box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
            }

            .back-to-top.show {
                display: flex;
                animation: fadeInUp 0.5s ease;
            }

            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* Hero section enhancements */
            .hero-gradient {
                background: linear-gradient(135deg, #0f172a 0%, #1e293b 25%, #334155 50%, #475569 75%, #64748b 100%);
                position: relative;
                overflow: hidden;
            }

            .hero-gradient::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 1000"><defs><radialGradient id="a" cx="50%" cy="50%" r="50%"><stop offset="0%" stop-color="%23ffffff" stop-opacity="0.1"/><stop offset="100%" stop-color="%23ffffff" stop-opacity="0"/></radialGradient></defs><circle cx="200" cy="200" r="100" fill="url(%23a)"/><circle cx="800" cy="300" r="150" fill="url(%23a)"/><circle cx="400" cy="700" r="120" fill="url(%23a)"/></svg>') no-repeat center center;
                background-size: cover;
                opacity: 0.1;
            }

            /* Category badge enhancement */
            .category-badge {
                @apply inline-block bg-gradient-to-r from-fresh-teal to-cyan-400 text-white px-6 py-3 rounded-full text-sm font-bold uppercase tracking-wider shadow-lg transform hover:scale-105 transition-all duration-300;
            }

            /* Meta info enhancements */
            .meta-info {
                @apply flex items-center bg-white/10 backdrop-blur-sm rounded-lg px-4 py-2 transition-all duration-300 hover:bg-white/20;
            }

            /* Table of contents enhancement */
            .toc-container {
                @apply bg-gradient-to-br from-audit-grey to-gray-100 rounded-xl p-6 shadow-lg border border-gray-200;
                backdrop-filter: blur(10px);
            }

            /* Sidebar enhancements */
            .sidebar-card {
                @apply bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100;
            }

            .cta-card {
                @apply bg-gradient-to-br from-deep-chartered-blue to-blue-800 text-white rounded-xl shadow-xl;
                background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse"><path d="M 10 0 L 0 0 0 10" fill="none" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23grid)"/></svg>');
            }

            /* Related insights enhancement */
            .related-card {
                @apply bg-white rounded-xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2;
            }

            .related-card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, #0891b2, #06b6d4, #22d3ee);
                transform: scaleX(0);
                transition: transform 0.3s ease;
            }

            .related-card:hover::before {
                transform: scaleX(1);
            }

            /* Responsive improvements */
            @media (max-width: 768px) {
                .hero-gradient {
                    padding: 3rem 0;
                }

                .article-content {
                    font-size: 1rem;
                }

                .back-to-top {
                    bottom: 1rem;
                    right: 1rem;
                    width: 3rem;
                    height: 3rem;
                }

                .share-btn {
                    width: 10px;
                    height: 10px;
                }

                .meta-info {
                    margin: 0.5rem;
                    font-size: 0.875rem;
                }
            }

            @media (max-width: 640px) {
                .hero-gradient {
                    padding: 2rem 0;
                }

                .article-content h2 {
                    font-size: 1.5rem;
                }

                .article-content h3 {
                    font-size: 1.25rem;
                }
            }

            /* Animation utilities */
            .fade-in-up {
                animation: fadeInUp 0.6s ease forwards;
            }

            .fade-in-up-delay-1 {
                animation: fadeInUp 0.6s ease 0.1s forwards;
                opacity: 0;
            }

            .fade-in-up-delay-2 {
                animation: fadeInUp 0.6s ease 0.2s forwards;
                opacity: 0;
            }

            .fade-in-up-delay-3 {
                animation: fadeInUp 0.6s ease 0.3s forwards;
                opacity: 0;
            }

            /* Smooth scroll behavior */
            html {
                scroll-behavior: smooth;
            }

            /* Enhanced prose styling */
            .prose-enhanced {
                @apply max-w-none;
            }

            .prose-enhanced>*+* {
                margin-top: 1.5rem;
            }

            .prose-enhanced h2+*,
            .prose-enhanced h3+*,
            .prose-enhanced h4+* {
                margin-top: 0.75rem;
            }
        </style>
    @endpush

@section('content')
    <!-- Reading Progress Bar -->
    <div class="reading-progress"></div>

    <!-- Hero Section -->
    <section class="relative hero-gradient py-16 md:py-24 lg:py-32">
        <div class="container-custom relative z-10">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Category Badge -->
                {{-- @if ($insight->category)
                    <div class="mb-6 fade-in-up">
                        <span class="category-badge">
                            {{ $insight->category }}
                        </span>
                    </div>
                @endif --}}

                <!-- Title -->
                <h1
                    class="text-3xl md:text-4xl lg:text-6xl font-bold text-white mb-6 lg:mb-8 leading-tight fade-in-up-delay-1">
                    {{ $insight->title }}
                </h1>

                <!-- Excerpt -->
                @if ($insight->excerpt)
                    <p
                        class="text-lg md:text-xl lg:text-2xl text-white/90 mb-8 lg:mb-12 leading-relaxed max-w-4xl mx-auto fade-in-up-delay-2">
                        {{ $insight->excerpt }}
                    </p>
                @endif

                <!-- Meta Information -->
                <div class="flex flex-wrap items-center justify-center gap-4 md:gap-6 text-white/80 fade-in-up-delay-3">
                    @if ($insight->author)
                        <div class="meta-info">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            <span class="truncate">By {{ $insight->author }}</span>
                        </div>
                    @endif

                    <div class="meta-info">
                        <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ $insight->published_at->format('F j, Y') }}</span>
                    </div>

                    @if ($insight->read_time)
                        <div class="meta-info">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span>{{ $insight->read_time }} min read</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section bg-white">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <!-- Featured Image -->
                @if ($insight->featured_image)
                    <div class="mb-12 lg:mb-16">
                        <img src="{{ asset('storage/' . $insight->featured_image) }}" alt="{{ $insight->title }}"
                            class="w-full h-auto rounded-2xl shadow-2xl transform hover:scale-[1.02] transition-transform duration-500">
                    </div>
                @endif

                <div class="space-y-12">
                    <!-- Article Content -->
                    <div>
                        <article class="article-content prose prose-enhanced prose-lg max-w-none">
                            {!! $insight->content !!}
                        </article>

                        <!-- Tags -->
                        @if ($insight->tags && count($insight->tags) > 0)
                            <div class="mt-12 lg:mt-16 pt-8 border-t border-gray-200">
                                <h4 class="text-lg md:text-xl font-semibold text-deep-chartered-blue mb-6">Related Tags</h4>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($insight->tags as $tag)
                                        <span
                                            class="inline-block bg-gradient-to-r from-audit-grey to-gray-100 text-deep-chartered-blue px-4 py-2 rounded-full text-sm font-medium hover:shadow-md transition-all duration-300 transform hover:scale-105 cursor-pointer">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Share Section -->
                        <div class="mt-12 lg:mt-16 pt-8 border-t border-gray-200">
                            <h4 class="text-lg md:text-xl font-semibold text-deep-chartered-blue mb-6">Share this insight
                            </h4>
                            <div class="flex gap-4">
                                <!-- LinkedIn -->
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn bg-blue-600 text-white hover:bg-blue-700"
                                    title="Share on LinkedIn">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                    </svg>
                                </a>

                                <!-- Twitter -->
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($insight->title) }}"
                                    target="_blank" class="share-btn bg-blue-400 text-white hover:bg-blue-500"
                                    title="Share on Twitter">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                    </svg>
                                </a>

                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                    target="_blank" class="share-btn bg-blue-800 text-white hover:bg-blue-900"
                                    title="Share on Facebook">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                    </svg>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text={{ urlencode($insight->title . ' - ' . request()->url()) }}"
                                    target="_blank" class="share-btn bg-green-500 text-white hover:bg-green-600"
                                    title="Share on WhatsApp">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                        <path
                                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.89 3.488" />
                                    </svg>
                                </a>

                                <!-- Copy Link -->
                                <button onclick="copyToClipboard('{{ request()->url() }}')"
                                    class="share-btn bg-gray-600 text-white hover:bg-gray-700" title="Copy link">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar (stacked at the bottom) -->
                    <div class="space-y-8 mt-12 pt-8 border-t border-gray-200">
                        <div class="space-y-8">
                            <!-- Navigation Back -->
                            <div class="sidebar-card p-6">
                                <a href="{{ route('insights') }}"
                                    class="inline-flex items-center text-fresh-teal hover:text-deep-chartered-blue transition-colors group">
                                    <svg class="w-5 h-5 mr-2 transform group-hover:-translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 19l-7-7 7-7" />
                                    </svg>
                                    Back to Insights
                                </a>
                            </div>

                            <!-- Table of Contents -->
                            <div class="toc-container">
                                <h4
                                    class="text-lg md:text-xl font-semibold text-deep-chartered-blue mb-4 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                                    </svg>
                                    Table of Contents
                                </h4>
                                <div id="table-of-contents">
                                    <!-- Generated by JavaScript -->
                                </div>
                            </div>

                            <!-- Contact CTA -->
                            <div class="cta-card p-6 lg:p-8">
                                <div class="text-center">
                                    <div
                                        class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-xl md:text-2xl font-bold mb-3">Need Expert Advice?</h4>
                                    <p class="mb-6 text-white/90 leading-relaxed">
                                        Our team of chartered accountants is ready to help with your specific challenges.
                                    </p>
                                    <a href="{{ route('contact') }}"
                                        class="btn-primary bg-fresh-teal hover:bg-opacity-90 w-full text-center transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                                        Get In Touch
                                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Insights -->
    @if ($relatedInsights && $relatedInsights->count() > 0)
        <section class="section bg-gradient-to-br from-audit-grey via-gray-50 to-white">
            <div class="container-custom">
                <div class="max-w-6xl mx-auto">
                    <div class="text-center mb-12 lg:mb-16">
                        <h2 class="section-title text-3xl md:text-4xl lg:text-5xl">Related Insights</h2>
                        <p class="section-subtitle text-lg md:text-xl">Explore more articles in {{ $insight->category }}
                        </p>
                    </div>

                    <div
                        class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-{{ min(3, $relatedInsights->count()) }} gap-6 lg:gap-8">
                        @foreach ($relatedInsights as $index => $related)
                            <article class="related-card relative fade-in-up-delay-{{ $index + 1 }}">
                                <div class="overflow-hidden">
                                    @if ($related->featured_image)
                                        <div class="h-48 md:h-56 bg-cover bg-center transform hover:scale-105 transition-transform duration-500"
                                            style="background-image: url('{{ asset('storage/' . $related->featured_image) }}')">
                                        </div>
                                    @else
                                        <div
                                            class="h-48 md:h-56 bg-gradient-to-br from-fresh-teal via-cyan-400 to-deep-chartered-blue relative">
                                            <div class="absolute inset-0 bg-black/20"></div>
                                            <div class="absolute inset-0 flex items-center justify-center">
                                                <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="p-6 lg:p-8">
                                    @if ($related->category)
                                        <span
                                            class="text-xs font-bold text-fresh-teal uppercase tracking-wider bg-fresh-teal/10 px-3 py-1 rounded-full">
                                            {{ $related->category }}
                                        </span>
                                    @endif

                                    <h3
                                        class="text-xl md:text-2xl font-bold text-deep-chartered-blue mt-4 mb-4 leading-tight">
                                        <a href="{{ route('insights.detail', $related->slug) }}"
                                            class="hover:text-fresh-teal transition-colors duration-300 group">
                                            {{ Str::limit($related->title, 60) }}
                                            <span
                                                class="inline-block transform group-hover:translate-x-1 transition-transform duration-300 ml-1">→</span>
                                        </a>
                                    </h3>

                                    <p class="text-gray-600 mb-6 leading-relaxed">
                                        {{ Str::limit($related->excerpt ?: strip_tags($related->content), 120) }}
                                    </p>

                                    <div
                                        class="flex items-center justify-between text-sm text-gray-500 pt-4 border-t border-gray-100">
                                        <div class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            {{ $related->published_at->format('M j, Y') }}
                                        </div>
                                        @if ($related->read_time)
                                            <div class="flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{ $related->read_time }} min read
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="text-center mt-12 lg:mt-16">
                        <a href="{{ route('insights') }}"
                            class="btn-outline inline-flex items-center group transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            View All Insights
                            <svg class="ml-2 h-5 w-5 transform group-hover:translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Back to Top Button -->
    <button class="back-to-top" onclick="scrollToTop()">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Reading progress bar
            const progressBar = document.querySelector('.reading-progress');
            const article = document.querySelector('.article-content');

            if (progressBar && article) {
                window.addEventListener('scroll', function() {
                    const articleTop = article.offsetTop;
                    const articleHeight = article.offsetHeight;
                    const windowHeight = window.innerHeight;
                    const scrollTop = window.pageYOffset;

                    const articleBottom = articleTop + articleHeight - windowHeight;
                    const progress = Math.max(0, Math.min(100, ((scrollTop - articleTop) / (articleBottom -
                        articleTop)) * 100));

                    progressBar.style.width = progress + '%';
                });
            }

            // Back to top button
            const backToTop = document.querySelector('.back-to-top');
            if (backToTop) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 300) {
                        backToTop.classList.add('show');
                    } else {
                        backToTop.classList.remove('show');
                    }
                });
            }

            // Generate table of contents
            generateTableOfContents();
        });

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                // Show a temporary success message
                const button = event.target.closest('button');
                const originalHTML = button.innerHTML;
                button.innerHTML =
                    '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>';

                setTimeout(() => {
                    button.innerHTML = originalHTML;
                }, 2000);
            });
        }

        function generateTableOfContents() {
            const article = document.querySelector('.article-content');
            const tocContainer = document.getElementById('table-of-contents');

            if (!article || !tocContainer) return;

            const headings = article.querySelectorAll('h2, h3, h4');

            if (headings.length === 0) {
                tocContainer.innerHTML = '<p class="text-gray-500 text-sm">No headings found</p>';
                return;
            }

            let tocHTML = '<ul class="space-y-2 text-sm">';
            headings.forEach((heading, index) => {
                const id = 'heading-' + index;
                heading.id = id;

                const level = parseInt(heading.tagName.charAt(1));
                const indent = level === 2 ? '' : (level === 3 ? 'ml-4' : 'ml-8');

                tocHTML += `<li class="${indent}">
            <a href="#${id}" class="text-deep-chartered-blue hover:text-fresh-teal transition-colors block py-1">
                ${heading.textContent}
            </a>
        </li>`;
            });
            tocHTML += '</ul>';

            tocContainer.innerHTML = tocHTML;

            // Smooth scroll for TOC links
            tocContainer.querySelectorAll('a[href^="#"]').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        }
    </script>
@endpush
