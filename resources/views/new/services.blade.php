@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Our Services', 'Explore our comprehensive range of services including audit & assurance, taxation, risk management, and business advisory services tailored to your needs.', 'services, audit, tax, advisory, accounting services, business planning') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/services.css') }}">
    @include('new.layouts.links')
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-slider">
                    @foreach ($jumbotrons as $index => $jumbotron)
                        <div class="hero-slide hero-slide-{{ $index + 1 }}"
                            style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                            <div class="hero-content gsap-animate">
                                <h1>{{ $jumbotron->title }}</h1>
                                <p>{{ $jumbotron->subtitle }}</p>
                                <div class="d-flex flex-wrap justify-content-center gap-3">
                                    <a href="#services" class="btn-primary-filled">Explore Services <i
                                            class="fas fa-arrow-right"></i></a>
                                    <a href="/contact" class="btn-primary-outline">Contact Us <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>

            <!-- Core Services -->
            <section class="services-section" id="services">
                <div class="section-container">
                    <h2 class="gsap-animate">Our Core Services</h2>
                    <p class="lead gsap-animate">Explore our comprehensive service offerings and discover how we can support
                        your business goals.</p>



                    <div class="row g-4" id="servicesGrid">

                        @foreach ($services->take(6) as $index => $service)
                            <div class="col-md-6 col-lg-4 gsap-animate" data-delay="{{ $index * 0.1 }}">
                                <div class="service-card">
                                    <h3>{{ $service->title }}</h3>
                                    <p>{{ $service->description }}</p>
                                    <a href="{{ route('serviceDetails', $service->id) }}" class="learn-more">
                                        Learn More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach

                    </div>
                    @if ($services->count() > 6)
                        <div class="text-center mt-4">
                            <a href="javascript:void(0)" id="viewAllBtn" class="btn-all gsap-animate">
                                <span class="btn-text">View All Services</span>
                                <span class="btn-spinner" style="display:none;"><i class="fas fa-spinner fa-spin"></i>
                                    Loading...</span>
                            </a>
                            <a href="javascript:void(0)" id="showLessBtn" class="btn-all gsap-animate" style="display:none;">
                                <span class="btn-text">Show Less</span> <i class="fas fa-arrow-up"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

    <!-- Industry Expertise Section -->
    <section class="industries-section">
        <div class="section-container">
            <h2 class="gsap-animate">Industry Expertise</h2>
            <p class="lead gsap-animate">Specialized knowledge across key sectors, bringing industry-specific insights to
                every engagement.</p>
            <div class="row g-3">
                @foreach ($industries as $index => $industry)
                    <div class="col-6 col-md-4 col-lg-2 gsap-animate">
                        <div class="industry-item">
                            <svg class="w-8 h-8 text-fresh-teal mx-auto mb-2" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="{{ $industry->svg_icon }}" />
                            </svg>
                            <ul class="no-bullets">
                                <li>{{ $industry->name }}</li>
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
            <a href="/industries" class="btn-all gsap-animate">View All Industries</a>
        </div>
    </section>
    </main>
    @include('new.layouts.contactusform')
@endsection

@section('scripts')
    <!-- jQuery (required for Slick Slider) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Slick Slider JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <!-- GSAP and ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        // Initialize Slick Slider
        $(document).ready(function() {
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
                pauseOnFocus: true
            });

            // Animate hero content on slide change
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
        });

        // GSAP Animation Function
        function animateElements() {
            gsap.utils.toArray('.gsap-animate:not(.animated)').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
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
                        once: true
                    }
                });
                el.classList.add("animated");
            });
        }

        // Initialize GSAP Animations
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Initial page load animations
            gsap.utils.toArray('.gsap-animate').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
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
                    }
                });
            });

            ScrollTrigger.refresh();
        });

        // AJAX View All Services Implementation
        let allServicesLoaded = false;
        let originalServiceHtml = '';

        $(document).ready(function() {
            // Store original content for "Show Less" functionality
            originalServiceHtml = $('#servicesGrid').html();

            // View All Button Handler
            $('#viewAllBtn').on('click', function() {
                if (allServicesLoaded) return;

                const $btn = $(this);
                const $btnText = $btn.find('.btn-text');
                const $btnSpinner = $btn.find('.btn-spinner');

                // Show loading state
                $btnText.hide();
                $btnSpinner.show();
                $btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('services.all') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        // Update services grid
                        if (response.services_html) {
                            $('#servicesGrid').html(response.services_html);
                        }

                        // Animate new elements
                        setTimeout(() => {
                            animateElements();
                            ScrollTrigger.refresh();
                        }, 100);

                        // Update button states
                        $btn.hide();
                        $('#showLessBtn').show();
                        allServicesLoaded = true;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading all services:', error);
                        alert('Failed to load all services. Please try again later.');
                    },
                    complete: function() {
                        // Hide loading state
                        $btnText.show();
                        $btnSpinner.hide();
                        $btn.prop('disabled', false);
                    }
                });
            });

            // Show Less Button Handler
            $('#showLessBtn').on('click', function() {
                // Restore original content
                $('#servicesGrid').html(originalServiceHtml);

                // Update button states
                $(this).hide();
                $('#viewAllBtn').show();
                allServicesLoaded = false;

                // Scroll back to services section
                $('html, body').animate({
                    scrollTop: $('#services').offset().top - 100
                }, 600);

                // Re-animate original elements
                setTimeout(() => {
                    animateElements();
                    ScrollTrigger.refresh();
                }, 100);
            });
        });
    </script>
@endsection
