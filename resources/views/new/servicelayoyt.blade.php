@extends('new.layouts.sidebar')

@section('styles')
    <link rel="stylesheet" href="@versionedAsset('css/services.css')">
    @include('new.layouts.links')
    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css">
@endsection

@section('content')
    <div class="rka-scope">
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="hero-slider">
                    <div class="hero-slide hero-slide-1">
                        <div class="hero-content gsap-animate">
                            <h1>Our Professional Services</h1>
                            <p>Comprehensive audit, tax, and advisory services tailored to meet your business needs and drive growth.</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="#services" class="btn-primary-filled">Explore Services <i class="fas fa-arrow-right"></i></a>
                                <a href="#contact" class="btn-primary-outline">Contact Us <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide hero-slide-2">
                        <div class="hero-content gsap-animate">
                            <h1>Driving Business Success</h1>
                            <p>Expert solutions in audit, tax, and consulting to empower your organization's growth and compliance.</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="#services" class="btn-primary-filled">Our Expertise <i class="fas fa-arrow-right"></i></a>
                                <a href="#contact" class="btn-primary-outline">Get in Touch <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="hero-slide hero-slide-3">
                        <div class="hero-content gsap-animate">
                            <h1>Strategic Financial Solutions</h1>
                            <p>Partner with us for tailored advisory and reporting services that ensure sustainable success.</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="#services" class="btn-primary-filled">Learn More <i class="fas fa-arrow-right"></i></a>
                                <a href="#contact" class="btn-primary-outline">Reach Out <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Core Services -->
            <section class="services-section" id="services">
                <div class="section-container">
                    <h2 class="gsap-animate">Our Core Services</h2>
                    <p class="lead gsap-animate">Explore our comprehensive service offerings and discover how we can support your business goals.</p>
                    <div class="row g-4" id="servicesGrid">
                        @foreach($services->take(6) as $service)
                        <div class="col-md-6 col-lg-4 gsap-animate" data-delay="{{ $loop->index * 0.1 }}">
                            <div class="service-card">
                                <h3>{{ $service->title }}</h3>
                                <p>{{ $service->description }}</p>
                                <a href="#service-{{ $service->id }}" class="learn-more">Learn More <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center mt-4">
                        @if($services->count() > 6)
                        <a href="javascript:void(0);" id="viewAllBtn" class="btn-all gsap-animate">
                            <span class="btn-text">View All Services</span>
                            <span class="btn-spinner" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i> Loading...
                            </span>
                        </a>
                        <a href="javascript:void(0);" id="showLessBtn" class="btn-all gsap-animate" style="display: none;">Show Less</a>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Service Details Section -->
            <section class="service-details-section" id="service-details">
                <div class="section-container">
                    <h2 class="gsap-animate">Service Details</h2>
                    <div class="row g-4" id="serviceDetails">
                        @foreach($services->take(6) as $service)
                        <div class="col-12 gsap-animate" id="service-{{ $service->id }}" data-delay="{{ $loop->index * 0.15 }}">
                            <div class="detail-card">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 detail-content">
                                        <h3>{{ $service->title }}</h3>
                                        <p>{{ $service->content }}</p>
                                        @if(is_array($service->sub_services))
                                        @foreach($service->sub_services as $sub => $items)
                                        <h4>{{ $sub }}</h4>
                                        <ul>
                                            @foreach($items as $item)
                                            <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{ Storage::url($service->featured_image) }}" alt="{{ $service->title }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Industry Expertise Section -->
            <section class="industries-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Industry Expertise</h2>
                    <p class="lead gsap-animate">Specialized knowledge across key sectors, bringing industry-specific insights to every engagement.</p>
                    <div class="row g-3">
                        @foreach($industries as $industry)
                        <div class="col-6 col-md-4 col-lg-2 gsap-animate" data-delay="{{ $loop->index * 0.2 }}">
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
                    <a href="#contact" class="btn-all gsap-animate">View All Industries</a>
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
    <!-- Slick Slider -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <script>
        gsap.registerPlugin(ScrollTrigger);

        // Slick slider initialization
        $(document).ready(function(){
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

            // Hero animation on slide change
            $('.hero-slider').on('beforeChange', function(event, slick, currentSlide, nextSlide){
                const nextContent = $(slick.$slides[nextSlide]).find('.hero-content');
                gsap.fromTo(nextContent, 
                    { opacity: 0, y: 50 },
                    { opacity: 1, y: 0, duration: 1.2, ease: 'power3.out' }
                );
            });
        });

        // GSAP reveal animations
        function animateElements() {
            gsap.utils.toArray('.gsap-animate:not(.animated)').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
                gsap.fromTo(el,
                    { opacity: 0, y: 40 },
                    {
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
                    }
                );
                el.classList.add("animated");
            });
        }

        // Initialize animations on load
        window.addEventListener('load', animateElements);

        // AJAX View All Implementation
        let allServicesLoaded = false;
        let originalServicesHtml = '';
        let originalDetailsHtml = '';

        $(document).ready(function(){
            // Store original content for "Show Less"
            originalServicesHtml = $('#servicesGrid').html();
            originalDetailsHtml = $('#serviceDetails').html();

            $('#viewAllBtn').on('click', function(){
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
                    method: "GET",
                    dataType: 'json',
                    success: function(response){
                        // Update services grid
                        if (response.services_html) {
                            $('#servicesGrid').html(response.services_html);
                        }

                        // Update service details
                        if (response.details_html) {
                            $('#serviceDetails').html(response.details_html);
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
                        console.error('Failed to load services:', error);
                        alert('Failed to load services. Please try again.');
                    },
                    complete: function() {
                        // Hide loading state
                        $btnText.show();
                        $btnSpinner.hide();
                        $btn.prop('disabled', false);
                    }
                });
            });

            $('#showLessBtn').on('click', function(){
                // Restore original content
                $('#servicesGrid').html(originalServicesHtml);
                $('#serviceDetails').html(originalDetailsHtml);

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

        // Smooth scroll for Learn More links
        $(document).on("click", "a.learn-more", function(e) {
            e.preventDefault();
            let target = $(this).attr("href");
            if ($(target).length) {
                let offset = $(target).offset().top - 80;
                $("html, body").animate({ scrollTop: offset }, 800);
            }
        });
    </script>
@endsection