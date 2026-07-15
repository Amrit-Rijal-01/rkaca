@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Blogs & News', 'Read our latest articles, news updates, and expert opinions on business, taxation, and economy.', 'blogs, news, articles, expert opinions, business blog') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/blogs.css') }}">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Blog Hero Section -->
            @if ($jumbotrons->isNotEmpty())
                @foreach ($jumbotrons as $jumbotron)
                    <section class="blog-hero-section"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="blog-hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                        </div>
                    </section>
                @endforeach
            @endif

            <!-- Blog Articles Section -->
            <section class="blog-articles-section" id="blog-articles">
                <div class="section-container">
                    <h2 class="gsap-animate">Latest Posts</h2>
                    <p class="lead gsap-animate">Stay informed with our expert insights and updates.</p>
                    <div class="row g-4">
                        @forelse($blogs as $index => $blog)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ $index * 0.2 }}">
                                <div class="blog-card">
                                    @if ($blog->thumbnail)
                                        <div class="blog-image">
                                            <img src="{{ $blog->thumbnail_url }}"
                                                alt="{{ $blog->title }}" class="img-fluid">
                                        </div>
                                    @endif
                                    <div class="content">
                                        <div class="blog-meta">
                                            <span class="author">{{ $blog->author?->name }}</span>
                                            <span
                                                class="date">{{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}</span>
                                        </div>
                                        <h3>{{ $blog->title }}</h3>
                                        <p>{{ $blog->excerpt ?: (str_ends_with(strtolower($blog->content), '.pdf') ? 'PDF Document' : \Illuminate\Support\Str::limit(strip_tags($blog->content), 150)) }}
                                        </p>
                                        <a href="{{ route('blog.detail', $blog->slug) }}" class="btn-blog">Read More <i
                                                class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center">
                                <div class="no-blogs-message">
                                    <i class="fas fa-blog fa-3x text-muted mb-3"></i>
                                    <h3 class="text-muted">No Blog Posts Available</h3>
                                    <p class="text-muted">We're working on bringing you amazing content. Check back soon!
                                    </p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </section>

            <!-- Share Your Expertise Section -->
            <section class="contribute-section" id="contribute">
                <div class="section-container">
                    <h2 class="gsap-animate">Share Your Expertise</h2>
                    <p class="lead gsap-animate">Are you an industry expert with valuable insights to share? We welcome
                        guest contributions from accounting professionals, business leaders, and industry specialists. Join
                        our community of thought leaders and help shape the conversation.</p>
                    <div class="row g-4">
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate">
                            <div class="contribute-card">
                                <div class="content">
                                    <h3>Write for Us</h3>
                                    <p>Share your expertise through guest articles and thought leadership pieces.</p>
                                    <a href="#contact" class="btn-contribute">Submit Article <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.2">
                            <div class="contribute-card">
                                <div class="content">
                                    <h3>Expert Interviews</h3>
                                    <p>Participate in interviews and panel discussions on industry topics.</p>
                                    <a href="#contact" class="btn-contribute">Join Discussion <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.4">
                            <div class="contribute-card">
                                <div class="content">
                                    <h3>Case Studies</h3>
                                    <p>Contribute real-world case studies and success stories from your experience.</p>
                                    <a href="#contact" class="btn-contribute">Share Story <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Get in Touch</h2>
                    <p class="lead gsap-animate">Ready to contribute or learn more? Contact us to join our community of
                        thought leaders.</p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 gsap-animate" data-delay="0.2">
                        <a href="#contact" class="btn-cta-filled">Contact Us <i class="fas fa-arrow-right"></i></a>
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
            // Card Hover Animation
            $('.blog-card, .contribute-card').on('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.05,
                    boxShadow: '0 20px 40px rgba(0, 33, 63, 0.3)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    boxShadow: '0 8px 30px rgba(0, 33, 63, 0.2)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Button Click Animation
            $('.btn-blog, .btn-contribute, .btn-cta-filled').on('mousedown', function() {
                gsap.to(this, {
                    scale: 0.95,
                    duration: 0.1,
                    ease: 'power2.out'
                });
            }).on('mouseup', function() {
                gsap.to(this, {
                    scale: 1,
                    duration: 0.1,
                    ease: 'power2.out'
                });
            });
        });

        // GSAP Animations
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Parallax
            gsap.to('.blog-hero-section', {
                backgroundPosition: '50% 70%',
                ease: 'none',
                scrollTrigger: {
                    trigger: '.blog-hero-section',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1.5
                }
            });

            // Section and Card Reveal
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
        });
    </script>
@endsection
