@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta($insight->title, $insight->meta_description ?: ($insight->excerpt ?: $insight->content), 'insight, ' . $insight->title) !!}
@endpush

@section('styles')
    @include('new.layouts.links')
    <link rel="stylesheet" href="@versionedAsset('css/insights.css')">
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

            /* Share card (match blog-detail) */
            .blog-share {
                margin-bottom: 2.5rem;
                padding: 1.5rem;
                background: linear-gradient(135deg, var(--light), var(--lighter));
                border-radius: 12px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                flex-wrap: wrap;
                gap: 1rem;
                border: 1px solid rgba(0, 33, 63, 0.05);
            }

            .blog-share h4 {
                margin: 0;
                font-size: 1.05rem;
                font-weight: 600;
                color: var(--primary);
            }

            .blog-share .share-buttons {
                display: flex;
                gap: 0.6rem;
            }

            .blog-share .share-btn {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 38px;
                height: 38px;
                border-radius: 50%;
                color: #fff;
                text-decoration: none;
                transition: var(--transition);
                font-size: 0.9rem;
            }

            .blog-share .share-btn.facebook {
                background: #3b5998;
            }

            .blog-share .share-btn.twitter {
                background: #1da1f2;
            }

            .blog-share .share-btn.linkedin {
                background: #0077b5;
            }

            .blog-share .share-btn.email {
                background: var(--gray);
            }

            .blog-share .share-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
                color: #fff;
                text-decoration: none;
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

            .sd-body-inner {
                max-width: 1400px;
                margin: 0 auto;
                padding: 0 1.5rem;
                display: grid;
                grid-template-columns: minmax(0, 1fr) 300px;
                gap: 2rem;
                align-items: start;
            }

            @media (max-width: 1200px) {
                .sd-body-inner {
                    grid-template-columns: 1fr;
                }
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
            /* PDF Viewer Styling */
            .pdf-document-wrapper {
                margin-bottom: 2.5rem;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
                border: 1px solid rgba(0, 0, 0, 0.05);
            }

            .pdf-viewer-header {
                background: #f8f9fa;
                padding: 1rem 1.5rem;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid rgba(0, 0, 0, 0.08);
                flex-wrap: wrap;
                gap: 1rem;
            }

            .pdf-viewer-title {
                display: flex;
                align-items: center;
                gap: 0.75rem;
                font-weight: 600;
                color: #00213f;
            }

            .pdf-viewer-title i {
                color: #dc3545;
                font-size: 1.25rem;
            }

            .btn-pdf-download {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.45rem 1rem;
                border-radius: 6px;
                background: #00213f;
                color: #fff;
                font-size: 0.85rem;
                font-weight: 500;
                text-decoration: none;
                transition: all 0.2s ease-in-out;
            }

            .btn-pdf-download:hover {
                background: #003366;
                color: #fff;
                text-decoration: none;
                transform: translateY(-1px);
            }

            .pdf-iframe-box {
                height: 85vh;
                min-height: 500px;
                border-radius: 8px;
                overflow: hidden;
                background: #fff;
                border: 1px solid rgba(0, 0, 0, 0.1);
            }

            @media (max-width: 768px) {
                .pdf-iframe-box {
                    height: 85vh;
                    min-height: 400px;
                }
            }

            /* Insight Detail Hero layout to match Blog detail layout */
            .insight-detail-hero {
                background: linear-gradient(135deg, var(--primary, #00213f), var(--secondary, #0090d4));
                padding: 4.5rem 0 2.5rem;
                position: relative;
                overflow: hidden;
            }

            .insight-detail-hero::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                pointer-events: none;
            }

            .insight-detail-content {
                position: relative;
                z-index: 2;
            }

            .insight-breadcrumb {
                margin-bottom: 1.25rem;
                font-size: 0.875rem;
            }

            .insight-breadcrumb a {
                color: rgba(255, 255, 255, 0.8);
                text-decoration: none;
                transition: all 0.3s ease;
            }

            .insight-breadcrumb a:hover {
                color: #ffffff;
            }

            .insight-breadcrumb .separator {
                margin: 0 0.5rem;
                color: rgba(255, 255, 255, 0.5);
            }

            .insight-title {
                font-size: clamp(2rem, 4.5vw, 2.75rem);
                font-weight: 700;
                color: #ffffff;
                margin-bottom: 1rem;
                line-height: 1.25;
                letter-spacing: -0.02em;
                text-align: left;
            }

            .insight-subtitle {
                font-size: clamp(1.05rem, 2.2vw, 1.25rem);
                color: rgba(255, 255, 255, 0.9);
                margin-bottom: 1.25rem;
                line-height: 1.5;
                text-align: left;
            }

            .insight-meta-info {
                display: flex;
                flex-wrap: wrap;
                gap: 1.5rem;
                margin-bottom: 0.5rem;
                justify-content: flex-start;
            }

            .insight-meta-item {
                display: flex;
                align-items: center;
                gap: 0.5rem;
                color: rgba(255, 255, 255, 0.9);
                font-size: 0.9rem;
            }

            .insight-meta-item i {
                color: var(--accent, #00b4f2);
                font-size: 0.85rem;
            }
        </style>
    @endsection

@section('content')
    <!-- Reading Progress Bar -->
    <div class="reading-progress"></div>

    <!-- Hero Section -->
    <section class="insight-detail-hero">
        <div class="container-custom relative z-10">
            <div class="insight-detail-content">
                <!-- Breadcrumb -->
                <nav class="insight-breadcrumb">
                    <a href="{{ route('home') }}">Home</a>
                    <span class="separator">/</span>
                    <a href="{{ route('insights') }}">Insights</a>
                    <span class="separator">/</span>
                    <span>{{ $insight->title }}</span>
                </nav>

                <!-- Title -->
                <h1 class="insight-title gsap-animate">
                    {{ $insight->title }}
                </h1>

                <!-- Subtitle (if excerpt exists) -->
                @if ($insight->excerpt)
                    <p class="insight-subtitle gsap-animate" data-delay="0.1">
                        {{ $insight->excerpt }}
                    </p>
                @endif

                <!-- Meta Information -->
                <div class="insight-meta-info gsap-animate" data-delay="0.2">
                    @if ($insight->author)
                        <div class="insight-meta-item">
                            <i class="fas fa-user"></i>
                            <span>{{ $insight->author }}</span>
                        </div>
                    @endif

                    <div class="insight-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span>{{ $insight->published_at->format('F j, Y') }}</span>
                    </div>

                    <div class="insight-meta-item">
                        <i class="fas fa-clock"></i>
                        <span>
                            @if ($insight->content && str_ends_with(strtolower($insight->content), '.pdf'))
                                PDF Document
                            @elseif ($insight->read_time)
                                {{ $insight->read_time }} min read
                            @else
                                {{ ceil(str_word_count(strip_tags($insight->content)) / 200) }} min read
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section bg-white">
        <div class="container-custom">
            <div class="sd-body-inner">
                <div class="sd-content-card gsap-animate">
                    <!-- Featured Image -->
                    @if ($insight->featured_image)
                        <div class="mb-12 lg:mb-16" style="border-radius: 12px; overflow: hidden; box-shadow: 0 12px 35px rgba(0, 33, 63, 0.08); border: 1px solid rgba(0, 33, 63, 0.06); aspect-ratio: 16 / 9; width: 100%;">
                            <img src="{{ asset('storage/' . $insight->featured_image) }}" alt="{{ $insight->title }}"
                                style="width: 100%; height: 100%; object-fit: cover; display: block; transition: transform 0.4s ease;"
                                onmouseover="this.style.transform='scale(1.03)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                    @endif

                    <!-- Article Content -->
                    @if ($insight->content && str_ends_with(strtolower($insight->content), '.pdf'))
                        <div class="pdf-document-wrapper mb-8">
                            <div class="pdf-viewer-header">
                                <div class="pdf-viewer-title">
                                    <i class="fas fa-file-pdf"></i>
                                    <span>{{ $insight->title }} (PDF Document)</span>
                                </div>
                                <a href="{{ asset('storage/' . $insight->content) }}" target="_blank" download
                                    class="btn-pdf-download">
                                    <i class="fas fa-download"></i> Download PDF
                                </a>
                            </div>
                            <div class="pdf-iframe-box">
                                <iframe src="{{ asset('storage/' . $insight->content) }}" width="100%"
                                    height="100%" style="border: none;"></iframe>
                            </div>
                        </div>
                    @else
                        <article class="article-content prose prose-enhanced prose-lg max-w-none">
                            {!! $insight->content !!}
                        </article>
                    @endif

                    <!-- Share Section -->
                    <div class="blog-share gsap-animate" data-delay="0.3">
                        <h4>Share this insight</h4>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                target="_blank" class="share-btn facebook" title="Share on Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($insight->title) }}"
                                target="_blank" class="share-btn twitter" title="Share on Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="mailto:?subject={{ urlencode($insight->title) }}&body=Check%20out%20this%20article%3A%20{{ urlencode(request()->url()) }}"
                                class="share-btn email" title="Share via Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <x-sidebar-cta :backRoute="route('insights')" backLabel="All Insights" />
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
