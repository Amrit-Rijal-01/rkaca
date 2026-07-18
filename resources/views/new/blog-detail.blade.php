@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta(
        $blog->title,
        $blog->excerpt ?:
        ($blog->content && str_ends_with(strtolower($blog->content), '.pdf')
            ? 'Read the PDF document: ' . $blog->title
            : $blog->content),
        'blog, insights, ' . $blog->title,
        $blog->thumbnail_url,
    ) !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
    @include('new.layouts.links')
    <style>
        .blog-detail-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 4.5rem 0 2.5rem;
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
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .blog-detail-content {
            position: relative;
            z-index: 2;
        }

        .blog-breadcrumb {
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
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
            color: rgba(255, 255, 255, 0.5);
        }

        .blog-title {
            font-size: clamp(2rem, 4.5vw, 2.75rem);
            font-weight: 700;
            color: var(--white);
            margin-bottom: 1rem;
            line-height: 1.25;
            letter-spacing: -0.02em;
        }

        .blog-meta-info {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.9rem;
        }

        .meta-item i {
            color: var(--accent);
            font-size: 0.85rem;
        }

        .blog-content-section {
            padding: 2.5rem 0 3.5rem;
            background: var(--white);
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

        .blog-featured-image {
            margin-bottom: 2rem;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 12px 35px rgba(0, 33, 63, 0.08);
            border: 1px solid rgba(0, 33, 63, 0.06);
            aspect-ratio: 16 / 9;
            width: 100%;
        }

        .blog-featured-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .blog-content {
            font-size: 1.05rem;
            line-height: 1.75;
            color: var(--gray);
            margin-bottom: 2.5rem;
        }

        .blog-content h2,
        .blog-content h3,
        .blog-content h4 {
            color: var(--primary);
            margin-top: 1.75rem;
            margin-bottom: 0.75rem;
            font-weight: 600;
            line-height: 1.35;
        }

        .blog-content p {
            margin-bottom: 1.25rem;
        }

        .blog-content ul,
        .blog-content ol {
            margin-bottom: 1.25rem;
            padding-left: 1.5rem;
        }

        .blog-content li {
            margin-bottom: 0.4rem;
        }

        .blog-content blockquote {
            background: linear-gradient(135deg, var(--light), var(--lighter));
            border-left: 3px solid var(--accent);
            margin: 1.5rem 0;
            border-radius: 6px;
            font-style: italic;
            font-size: 1.1rem;
            color: var(--primary);
        }

        /* PDF Viewer Container */
        .pdf-document-wrapper {
            background: var(--light);
            border: 1px solid rgba(0, 33, 63, 0.1);
            border-radius: 12px;
            padding: 1.25rem;
            box-shadow: 0 10px 30px rgba(0, 33, 63, 0.05);
            margin-bottom: 1.5rem;
        }

        .pdf-viewer-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(0, 33, 63, 0.08);
            flex-wrap: wrap;
            gap: 0.75rem;
        }

        .pdf-viewer-title {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-weight: 600;
            color: var(--primary);
            font-size: 0.95rem;
        }

        .pdf-viewer-title i {
            color: #e53e3e;
            font-size: 1.15rem;
        }

        .btn-pdf-download {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.45rem 1rem;
            border-radius: 6px;
            background: var(--primary);
            color: var(--white);
            font-size: 0.85rem;
            font-weight: 500;
            text-decoration: none;
            transition: var(--transition);
        }

        .btn-pdf-download:hover {
            background: var(--secondary);
            color: var(--white);
            text-decoration: none;
            transform: translateY(-1px);
        }

        .pdf-iframe-box {
            height: 85vh;
            min-height: 500px;
            border-radius: 8px;
            overflow: hidden;
            background: var(--white);
            border: 1px solid rgba(0, 0, 0, 0.1);
        }

        .blog-tags {
            margin-bottom: 2rem;
        }

        .tag {
            display: inline-block;
            background: var(--light);
            color: var(--primary);
            padding: 0.35rem 0.85rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-right: 0.4rem;
            margin-bottom: 0.4rem;
            text-decoration: none;
            transition: var(--transition);
        }

        .tag:hover {
            background: var(--accent);
            color: var(--white);
            text-decoration: none;
        }

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

        .share-buttons {
            display: flex;
            gap: 0.6rem;
        }

        .share-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            color: var(--white);
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.9rem;
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
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
            color: var(--white);
            text-decoration: none;
        }

        .related-blogs-section {
            background: var(--light);
            padding: 3.5rem 0;
            border-top: 1px solid rgba(0, 33, 63, 0.06);
        }

        .related-blogs-section h2 {
            font-size: 1.75rem;
            margin-bottom: 0.5rem;
        }

        .related-blogs-section .lead {
            font-size: 0.95rem;
            margin-bottom: 1.5rem;
        }

        .related-blog-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 6px 20px rgba(0, 33, 63, 0.06);
            border: 1px solid rgba(0, 33, 63, 0.05);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .related-blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 40px rgba(0, 33, 63, 0.12);
        }

        .related-blog-image {
            aspect-ratio: 16 / 9;
            width: 100%;
            overflow: hidden;
        }

        .related-blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .related-blog-card:hover .related-blog-image img {
            transform: scale(1.06);
        }

        .related-blog-content {
            padding: 1.25rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .related-blog-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--primary);
            margin-bottom: 0.5rem;
            text-decoration: none;
            display: block;
            line-height: 1.4;
            transition: var(--transition);
        }

        .related-blog-title:hover {
            color: var(--accent);
            text-decoration: none;
        }

        .related-blog-excerpt {
            color: var(--gray);
            font-size: 0.88rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .related-blog-meta {
            font-size: 0.8rem;
            color: var(--lighter-gray);
            border-top: 1px solid rgba(0, 33, 63, 0.05);
            padding-top: 0.75rem;
        }

        .back-to-blogs {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
            transition: var(--transition);
        }

        .back-to-blogs:hover {
            color: var(--accent);
            text-decoration: none;
            transform: translateX(-4px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .blog-detail-hero {
                padding: 3rem 0 2rem;
            }

            .blog-title {
                font-size: 1.75rem;
            }

            .blog-meta-info {
                gap: 1rem;
            }

            .blog-content-section {
                padding: 2rem 0;
            }

            .blog-share {
                flex-direction: column;
                text-align: center;
            }

            .pdf-iframe-box {
                height: 85vh;
                min-height: 400px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100%;">
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

                        <div class="blog-meta-info gsap-animate" data-delay="0.1">
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
                                <span>
                                    @if ($blog->content && str_ends_with(strtolower($blog->content), '.pdf'))
                                        PDF Document
                                    @else
                                        {{ ceil(str_word_count(strip_tags($blog->content)) / 200) }} min read
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Blog Content Section -->
            <section class="blog-content-section">
                <div class="section-container">
                    <div class="sd-body-inner">
                        <div class="sd-content-card gsap-animate">
                            <a href="{{ route('blogs') }}" class="back-to-blogs gsap-animate">
                                <i class="fas fa-arrow-left"></i>
                                Back to Blogs
                            </a>

                            @if ($blog->thumbnail)
                                <div class="blog-featured-image gsap-animate" data-delay="0.15">
                                    <img src="{{ $blog->thumbnail_url }}" alt="{{ $blog->title }}" class="img-fluid">
                                </div>
                            @endif

                            <div class="blog-content gsap-animate p-0" data-delay="0.2">
                                @if ($blog->content && str_ends_with(strtolower($blog->content), '.pdf'))
                                    <div class="pdf-document-wrapper">
                                        <div class="pdf-viewer-header">
                                            <div class="pdf-viewer-title">
                                                <i class="fas fa-file-pdf"></i>
                                                <span>{{ $blog->title }} (PDF Document)</span>
                                            </div>
                                            <a href="{{ asset('storage/' . $blog->content) }}" target="_blank" download
                                                class="btn-pdf-download">
                                                <i class="fas fa-download"></i> Download PDF
                                            </a>
                                        </div>
                                        <div class="pdf-iframe-box">
                                            <iframe src="{{ asset('storage/' . $blog->content) }}" width="100%"
                                                height="100%" style="border: none;"></iframe>
                                        </div>
                                    </div>
                                @else
                                    {!! $blog->content !!}
                                @endif
                            </div>

                            <div class="blog-share gsap-animate" data-delay="0.3">
                                <h4>Share this article</h4>
                                <div class="share-buttons">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank" class="share-btn facebook" title="Share on Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($blog->title) }}"
                                        target="_blank" class="share-btn twitter" title="Share on Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
                                        target="_blank" class="share-btn linkedin" title="Share on LinkedIn">
                                        <i class="fab fa-linkedin-in"></i>
                                    </a>
                                    <a href="mailto:?subject={{ urlencode($blog->title) }}&body={{ urlencode('Check out this article: ' . url()->current()) }}"
                                        class="share-btn email" title="Share via Email">
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <x-sidebar-cta :backRoute="route('blogs')" backLabel="All Blogs" />
                    </div>
                    </div>
                </div>
            </section>

            <!-- Related Blogs Section -->
            @if ($relatedBlogs->count() > 0)
                <section class="related-blogs-section">
                    <div class="section-container">
                        <h2 class="text-center gsap-animate">Related Articles</h2>
                        <p class="lead text-center gsap-animate" data-delay="0.1">Continue reading these related insights
                        </p>

                        <div class="row g-4 mt-2">
                            @foreach ($relatedBlogs as $index => $relatedBlog)
                                <div class="col-md-6 col-lg-4 gsap-animate" data-delay="{{ 0.15 + $index * 0.08 }}">
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
                                                {{ $relatedBlog->excerpt ?: (str_ends_with(strtolower($relatedBlog->content), '.pdf') ? 'PDF Document' : \Illuminate\Support\Str::limit(strip_tags($relatedBlog->content), 90)) }}
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
            <section class="cta-section" style="padding: 4rem 0;">
                <div class="section-container">
                    <h2 class="gsap-animate" style="margin-bottom: 1rem;">Get in Touch</h2>
                    <p class="lead gsap-animate" style="margin-bottom: 1.5rem;">Have questions about this article or need
                        professional advice?</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 gsap-animate"
                        data-delay="0.15">
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
