@extends('new.layouts.sidebar')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    @include('new.layouts.links')
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
    <!-- GSAP for Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
@endsection


@section('content')
    <div class="rka-scope">
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-slider">

                    @foreach ($jumbotrons as $index => $jumbotron)
                        <div class="hero-slide hero-slide-{{ $index + 1 }}"
                            style="background: url('{{ $jumbotron->background_image_url }}') center/cover;">
                            <div class="hero-content gsap-animate">
                                <h1>{{ $jumbotron->title }}</h1>
                                <p>{{ $jumbotron->subtitle }}.</p>
                                <div class="d-flex flex-wrap justify-content-center gap-3">
                                    <a href="#" class="btn-primary-filled">{{ $jumbotron->button_text }} <i
                                            class="fas fa-arrow-right"></i></a>
                                    <a href="{{ $jumbotron->button_link }}" class="btn-primary-outline">Learn More <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>

                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
            <div class="contanier">
                <!-- Key Statistics -->
                <section class="stats-section">
                    <div class="section-container">
                        <h2 class="gsap-animate">Our Impact by the Numbers</h2>
                        <div class="row g-4">
                            @foreach ($stats as $index => $stat)
                                <div class="col-6 col-md-3">
                                    <div class="stat-item gsap-animate" data-delay="{{ $index * 0.2 }}">
                                        <div class="stat-number" data-target="{{ $stat['number'] ?? 0 }}">
                                            {{ $stat['number'] ?? 0 }}+</div>
                                        <div class="stat-label">{{ $stat['label'] }}</div>
                                    </div>
                                </div>
                            @endforeach


                        </div>
                    </div>
                </section>

                <!-- Core Services -->
                <section class="services-section">
                    <div class="section-container">
                        <h2 class="gsap-animate">Our Core Services</h2>
                        <p class="lead gsap-animate">Comprehensive chartered accountancy services designed to drive your
                            business forward with precision, integrity, and strategic insight.</p>
                        <div class="row g-4">
                            @foreach ($services as $index => $service)
                                <div class="col-md-6 col-lg-4 gsap-animate" data-delay="{{ $index * 0.2 }}">
                                    <div class="service-card">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ $service->description }}</p>
                                        <a href="{{ route('serviceDetails', $service->id) }}" class="learn-more">Learn More
                                            <i class="fas fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <a href="/services" class="btn-all gsap-animate">View Services</a>
                    </div>
                </section>

                <!-- Why Choose Us -->
                <section class="why-choose-us">
                    <div class="section-container">
                        <h2 class="gsap-animate">Why Choose
                            {{ $footerSetting ? $footerSetting->company_name : 'Charter Insights' }}</h2>
                        <p class="lead gsap-animate">Partner with us for unmatched expertise, innovative solutions, and a
                            dedication to your business success.</p>
                        <div class="why-choose-grid">
                            <div class="why-choose-image gsap-animate">
                                <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=800&h=600"
                                    alt="Team collaboration" class="w-100">
                            </div>
                            @foreach ($why_choose_us as $index => $item)
                                <div class="feature-item gsap-animate choice-card-{{ $index + 1 }}">
                                    <div class="feature-icon"><i class="{{ $item->icon }}"></i></div>
                                    <div>
                                        <h4 class="feature-title">{{ $item->title }}</h4>
                                        <p class="feature-description">{{ $item->description }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                <!-- Industries We Serve -->
                <section class="industries-section">
                    <div class="section-container">
                        <h2 class="gsap-animate">Industries We Serve</h2>
                        <p class="lead gsap-animate">Deep industry expertise across diverse sectors, bringing specialized
                            knowledge to meet your unique challenges.</p>
                        <div class="row g-4">
                            @foreach ($industries as $index => $industry)
                                <div class="col-6 col-md-3 gsap-animate" data-delay="{{ $index * 0.2 }}">
                                    <div class="industry-item">
                                        @if (isset($industry->svg_icon))
                                            <div class="industries-icon">
                                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" class="stat-svg-icon">
                                                    <path d="{{ $industry->svg_icon }}" />
                                                </svg>
                                            </div>
                                        @endif

                                        <p>{{ $industry->name }}</p>
                                    </div>

                                </div>
                            @endforeach

                        </div>
                        <a href="/industries" class="btn-all gsap-animate">View All Industries</a>
                    </div>
                </section>
                @include('new.layouts.contactusform')

                <!-- Call to Action -->
                <section class="cta-section">
                    <div class="section-container">
                        <div class="gsap-animate">
                            <h2>Elevate Your Business Today</h2>
                            <p>Join forces with {{ $footerSetting ? $footerSetting->company_name : 'Charter Insights' }} to
                                unlock expert guidance and transformative solutions
                                tailored to your needs.</p>
                            <div class="cta-buttons">
                                <a href="/contact" class="btn-primary-filled">Get Started Now <i
                                        class="fas fa-arrow-right"></i></a>
                                <a href="/services" class="btn-primary-outline">Discover Our Services <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </main>
    </div>

    <!-- jQuery (required for Slick Slider) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // Refresh ScrollTrigger when Slick is initialized
            $('.hero-slider').on('init', function() {
                setTimeout(() => {
                    if (typeof ScrollTrigger !== 'undefined') {
                        ScrollTrigger.refresh();
                    }
                }, 100);
            });

            $('.hero-slider').slick({
                dots: false,
                infinite: true,
                speed: 800,
                fade: true,
                cssEase: 'cubic-bezier(0.4, 0, 0.2, 1)',
                autoplay: true,
                autoplaySpeed: 5000,
                arrows: false,
                pauseOnHover: true,
                pauseOnFocus: true,
                responsive: [{
                        breakpoint: 768,
                        settings: {
                            speed: 600,
                            autoplaySpeed: 4000
                        }
                    },
                    {
                        breakpoint: 576,
                        settings: {
                            speed: 500,
                            autoplaySpeed: 3500
                        }
                    }
                ]
            });

            $('.hero-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
                const nextContent = $(slick.$slides[nextSlide]).find('.hero-content');
                gsap.fromTo(nextContent, {
                    opacity: 0,
                    y: 50
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 1.2,
                    ease: 'power3.out'
                });
            });

            // Backup refresh for ScrollTrigger after slider settles
            setTimeout(() => {
                if (typeof ScrollTrigger !== 'undefined') {
                    ScrollTrigger.refresh();
                }
            }, 600);
        });

        // Initialize GSAP Animations as early as possible
        function initAnimations() {
            gsap.registerPlugin(ScrollTrigger);

            const nf = new Intl.NumberFormat();

            function animateNumber(num) {
                const target = parseInt(num.getAttribute('data-target'), 10);
                if (!Number.isFinite(target)) return;

                const obj = {
                    val: 0
                };
                gsap.to(obj, {
                    val: target,
                    duration: 2,
                    ease: 'power2.out',
                    onUpdate: () => {
                        num.textContent = nf.format(Math.round(obj.val)) + '+';
                    }
                });
            }

            // Animate GSAP elements
            gsap.utils.toArray('.gsap-animate').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;

                // If this is a stat-item, find its stat-number and set it to 0+ initially so it can count up
                const statNum = el.querySelector('.stat-number');
                if (statNum) {
                    statNum.textContent = '0+';
                }

                gsap.fromTo(el, {
                    opacity: 0,
                    y: 40
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 1.2,
                    delay,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 85%',
                        once: true,
                        invalidateOnRefresh: true
                    },
                    onStart: () => {
                        if (statNum) {
                            animateNumber(statNum);
                        }
                    }
                });
            });

            ScrollTrigger.refresh();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAnimations);
        } else {
            initAnimations();
        }

        // Final refresh when all assets are loaded
        window.addEventListener('load', function() {
            ScrollTrigger.refresh();
        });
    </script>
@endsection
