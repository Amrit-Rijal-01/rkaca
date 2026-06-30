@extends('new.layouts.sidebar')

@section('meta')
    <meta name="description"
        content="{{ $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 160) }}">
    <meta name="keywords" content="blog, insights, {{ $blog->title }}">
    <meta name="author" content="{{ $blog->author?->name }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $blog->title }}">
    <meta property="og:description"
        content="{{ $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 160) }}">
    <meta property="og:type" content="article">
    <meta property="og:url" content="{{ url()->current() }}">
    @if ($blog->thumbnail)
        <meta property="og:image" content="{{ $blog->thumbnail_url }}">
    @endif

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $blog->title }}">
    <meta name="twitter:description"
        content="{{ $blog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($blog->content), 160) }}">
    @if ($blog->thumbnail)
        <meta name="twitter:image" content="{{ $blog->thumbnail_url }}">
    @endif
@endsection

@section('title', $blog->title . ' - Charter Insights')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
    @include('new.layouts.links')
    <style>
        .blog-detail-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 8rem 0 4rem;
            position: relative;
            overflow: hidden;
        }

        .blog-detail-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .blog-detail-content {
            position: relative;
            z-index: 2;
        }

        .blog-breadcrumb {
            margin-bottom: 2rem;
        }

        .blog-breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .blog-breadcrumb a:hover {
            color: var(--white);
        }

        .blog-breadcrumb .separator {
            margin: 0 0.5rem;
            color: rgba(255, 255, 255, 0.6);
        }

        .blog-title {
            font-size: 3rem;
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .blog-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 1rem;
        }

        .meta-item i {
            color: var(--accent);
        }

        .blog-content-section {
            padding: 5rem 0;
            background: var(--white);
        }

        .blog-featured-image {
            margin-bottom: 3rem;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 20px 60px rgba(0, 33, 63, 0.1);
        }

        .blog-featured-image img {
            width: 100%;
            height: auto;
            display: block;
        }

        .blog-content {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--gray);
            margin-bottom: 3rem;
        }

        .blog-content h2,
        .blog-content h3,
        .blog-content h4 {
            color: var(--primary);
            margin-top: 2rem;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .blog-content p {
            margin-bottom: 1.5rem;
        }

        .blog-content ul,
        .blog-content ol {
            margin-bottom: 1.5rem;
            padding-left: 2rem;
        }

        .blog-content li {
            margin-bottom: 0.5rem;
        }

        .blog-content blockquote {
            background: linear-gradient(135deg, var(--light), var(--lighter));
            border-left: 4px solid var(--accent);
            padding: 1.5rem;
            margin: 2rem 0;
            border-radius: 8px;
            font-style: italic;
            font-size: 1.2rem;
        }

        .blog-tags {
            margin-bottom: 3rem;
        }

        .tag {
            display: inline-block;
            background: var(--light);
            color: var(--primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .tag:hover {
            background: var(--accent);
            color: var(--white);
            text-decoration: none;
        }

        .blog-share {
            margin-bottom: 4rem;
            padding: 2rem;
            background: linear-gradient(135deg, var(--light), var(--lighter));
            border-radius: 15px;
            text-align: center;
        }

        .share-buttons {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1rem;
        }

        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
        }

        .share-btn.facebook {
            background: #3b5998;
        }

        .share-btn.twitter {
            background: #1da1f2;
        }

        .share-btn.linkedin {
            background: #0077b5;
        }

        .share-btn.email {
            background: var(--gray);
        }

        .share-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
            color: var(--white);
            text-decoration: none;
        }

        .related-blogs-section {
            background: var(--light);
            padding: 5rem 0;
        }

        .related-blog-card {
            background: var(--white);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 25px rgba(0, 33, 63, 0.1);
            transition: var(--transition);
            height: 100%;
        }

        .related-blog-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0, 33, 63, 0.15);
        }

        .related-blog-image {
            height: 200px;
            overflow: hidden;
        }

        .related-blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .related-blog-card:hover .related-blog-image img {
            transform: scale(1.1);
        }

        .related-blog-content {
            padding: 1.5rem;
        }

        .related-blog-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            text-decoration: none;
            display: block;
            transition: var(--transition);
        }

        .related-blog-title:hover {
            color: var(--accent);
            text-decoration: none;
        }

        .related-blog-excerpt {
            color: var(--gray);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .related-blog-meta {
            font-size: 0.85rem;
            color: var(--lighter-gray);
        }

        .back-to-blogs {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            margin-bottom: 2rem;
            transition: var(--transition);
        }

        .back-to-blogs:hover {
            color: var(--accent);
            text-decoration: none;
            transform: translateX(-5px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2rem;
            }

            .blog-meta-info {
                flex-direction: column;
                gap: 1rem;
            }

            .share-buttons {
                flex-wrap: wrap;
            }

            .blog-content {
                font-size: 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Blog Detail Hero Section -->
            <section class="blog-detail-hero">
                <div class="section-container">
                    <div class="blog-detail-content">
                        <!-- Breadcrumb -->
                        <nav class="blog-breadcrumb">
                            <a href="{{ route('home') }}">Home</a>
                            <span class="separator">/</span>
                            <a href="{{ route('blogs') }}">Blogs</a>
                            <span class="separator">/</span>
                            <span>{{ $blog->title }}</span>
                        </nav>

                        <!-- Blog Title and Meta -->
                        <h1 class="blog-title gsap-animate">{{ $blog->title }}</h1>

                        <div class="blog-meta-info gsap-animate" data-delay="0.2">
                            <div class="meta-item">
                                <i class="fas fa-user"></i>
                                <span>{{ $blog->author?->name }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}</span>
                            </div>
                            <div class="meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Blog Content Section -->
            <section class="blog-content-section">
                <div class="section-container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <!-- Back to Blogs -->
                            <a href="{{ route('blogs') }}" class="back-to-blogs gsap-animate">
                                <i class="fas fa-arrow-left"></i>
                                Back to Blogs
                            </a>

                            <!-- Featured Image -->
                            @if ($blog->thumbnail)
                                <div class="blog-featured-image gsap-animate" data-delay="0.2">
                                    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}"
                                        class="img-fluid">
                                </div>
                            @endif

                            <!-- Blog Content -->
                            <div class="blog-content gsap-animate" data-delay="0.4">
                                {!! $blog->content !!}
                            </div>

                            <!-- Blog Share -->
                            <div class="blog-share gsap-animate" data-delay="0.6">
                                <h4>Share this article</h4>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank" class="share-btn facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                                        target="_blank" class="share-btn twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                        target="_blank" class="share-btn linkedin">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode('Check out this article: ' . url()->current()) }}"
                                        class="share-btn email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Related Blogs Section -->
            @if ($relatedBlogs->count() > 0)
                <section class="related-blogs-section">
                    <div class="section-container">
                        <h2 class="text-center gsap-animate">Related Articles</h2>
                        <p class="lead text-center gsap-animate" data-delay="0.2">Continue reading these related insights
                        </p>

                        <div class="row g-4 mt-4">
                            @foreach ($relatedBlogs as $index => $relatedBlog)
                                <div class="col-md-6 col-lg-4 gsap-animate" data-delay="{{ 0.3 + $index * 0.1 }}">
                                    <div class="related-blog-card">
                                        @if ($relatedBlog->thumbnail)
                                            <div class="related-blog-image">
                                                <img src="{{ $relatedBlog->thumbnail_url }}"
                                                    alt="{{ $relatedBlog->title }}">
                                            </div>
                                        @endif
                                        <div class="related-blog-content">
                                            <a href="{{ route('blog.detail', $relatedBlog->slug) }}"
                                                class="related-blog-title">
                                                {{ $relatedBlog->title }}
                                            </a>
                                            <p class="related-blog-excerpt">
                                                {{ $relatedBlog->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($relatedBlog->content), 100) }}
                                            </p>
                                            <div class="related-blog-meta">
                                                By {{ $relatedBlog->author?->name }} •
                                                {{ $relatedBlog->published_at ? $relatedBlog->published_at->format('M d, Y') : $relatedBlog->created_at->format('M d, Y') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <!-- CTA Section -->
            <section class="cta-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Get in Touch</h2>
                    <p class="lead gsap-animate">Have questions about this article or need professional advice?</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 gsap-animate"
                        data-delay="0.2">
                        <a href="{{ route('contact') }}" class="btn-cta-filled">Contact Our Experts <i
                                class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>
        </main>
    </div>
    @include('new.layouts.contactusform')
@endsection

@section('scripts')
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GSAP and ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        $(document).ready(function() {
            // Share button hover effects
            $('.share-btn').on('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Related blog card hover effects
            $('.related-blog-card').on('mouseenter', function() {
                gsap.to(this, {
                    y: -10,
                    boxShadow: '0 20px 60px rgba(0, 33, 63, 0.15)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    y: 0,
                    boxShadow: '0 8px 25px rgba(0, 33, 63, 0.1)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });
        });

        // GSAP Animations
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Parallax
            gsap.to('.blog-detail-hero', {
                backgroundPosition: '50% 70%',
                ease: 'none',
                scrollTrigger: {
                    trigger: '.blog-detail-hero',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1.5
                }
            });

            // Content Reveal Animations
            gsap.utils.toArray('.gsap-animate').forEach((el, index) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || (index * 0.1);
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 30
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 1,
                    delay,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 80%',
                        once: true,
                        invalidateOnRefresh: true
                    }
                });
            });

            // Reading Progress Bar
            const progressBar = document.createElement('div');
            progressBar.style.cssText = `
                position: fixed;
                top: 0;
                left: 0;
                width: 0%;
                height: 4px;
                background: linear-gradient(90deg, var(--accent), var(--secondary));
                z-index: 9999;
                transition: width 0.1s ease;
            `;
            document.body.appendChild(progressBar);

            window.addEventListener('scroll', () => {
                const scrolled = (window.scrollY / (document.documentElement.scrollHeight - window
                    .innerHeight)) * 100;
                progressBar.style.width = scrolled + '%';
            });
        });
    </script>
@endsection
