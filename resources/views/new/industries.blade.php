@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Industries We Serve', 'Discover the industries we serve. We provide customized financial and compliance solutions for manufacturing, technology, healthcare, real estate, and more.', 'industries, manufacturing, technology, healthcare, industry experience, financial solutions') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="@versionedAsset('css/industries.css')">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Hero Section -->
            <section class="hero-section">
                @foreach ($jumbotrons as $index => $jumbotron)
                    <div class="hero-slide hero-slide-{{ $index + 1 }}"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ $jumbotron->button_link }}" class="btn-primary-filled">
                                    {{ $jumbotron->button_text }} <i class="fas fa-arrow-right"></i>
                                </a>
                                <a href="/contact" class="btn-primary-outline">
                                    Contact Us <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            <!-- Industry Expertise Section -->
            <section class="industries-section" id="industries">
                <div class="section-container">
                    <h2 class="gsap-animate">Our Industry Expertise</h2>
                    <p class="lead gsap-animate">
                        We understand that every industry has its unique challenges, regulations, and opportunities. Our
                        specialized teams deliver targeted solutions that drive results.
                    </p>
                    <div class="row g-5" id="industriesGrid">
                        @foreach ($industries->take(9) as $index => $industry)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ $index * 0.1 }}">
                                <div class="industry-card">
                                    @if ($industry->svg_icon)
                                        <svg class="service-icon" width="40" height="40" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="{{ $industry->svg_icon }}" />
                                        </svg>
                                    @elseif($industry->icon)
                                        <i class="{{ $industry->icon }} service-icon"></i>
                                    @else
                                        <svg class="service-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                    @endif
                                    <h3>{{ $industry->title ?: $industry->name }}</h3>
                                    @if ($industry->features)
                                        <ul class="industry-features">
                                            @foreach (json_decode($industry->features) as $feature)
                                                <li>{{ $feature }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                    <a href="{{ route('industryDetails', $industry->id) }}" class="learn-more">
                                        Learn More <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @if ($industries->count() > 9)
                        <div class="text-center mt-4">
                            <a href="javascript:void(0)" id="viewAllBtn" class="btn-all gsap-animate">
                                <span class="btn-text">View All Industries</span>
                                <span class="btn-spinner" style="display: none;"><i class="fas fa-spinner fa-spin"></i>
                                    Loading...</span>
                            </a>
                            <a href="javascript:void(0)" id="showLessBtn" class="btn-all gsap-animate"
                                style="display: none;">
                                <span class="btn-text">Show Less</span> <i class="fas fa-arrow-up"></i>
                            </a>
                        </div>
                    @endif
                </div>
            </section>

            <!-- Industry Insights Section -->
            <section class="insights-section" id="insights">
                <div class="section-container">
                    <h2 class="gsap-animate">Industry-Specific Insights</h2>
                    <p class="lead gsap-animate">
                        Stay informed with our latest industry analysis and expert commentary on sector-specific trends and
                        challenges.
                    </p>
                    <div class="row g-4 mx-0">
                        @foreach ($insights as $index => $insight)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate">
                                <div class="insight-card">
                                    <div class="image-container">
                                        @if ($insight->featured_image)
                                            <img src="{{ Storage::url($insight->featured_image) }}"
                                                alt="{{ $insight->title ?? 'Insight Image' }}">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200&auto=format&fit=crop"
                                                alt="{{ $insight->title ?? 'Default Insight Image' }}">
                                        @endif
                                        <div class="gradient-overlay"></div>
                                        <div class="title-overlay">
                                            <h3>{{ $insight->title ?? 'Default Insight Title' }}</h3>
                                        </div>
                                        <div class="content-overlay">
                                            <span class="category">{{ $insight->category ?? 'Default Category' }}</span>
                                            <h3>{{ $insight->title ?? 'Default Insight Title' }}</h3>
                                            <div class="date">
                                                {{ $insight->published_at ? \Carbon\Carbon::parse($insight->published_at)->format('F j, Y') : 'Unknown Date' }}
                                                • {{ $insight->read_time ?? '0' }} min read</div>
                                            <p>{{ $insight->description ?? 'Default Insight Description' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.2">
                                <div class="insight-card">
                                    <div class="image-container">
                                        <img src="https://images.unsplash.com/photo-1565514020179-026b92b84bb6?q=80&w=1200&auto=format&fit=crop"
                                            alt="Industry 4.0">
                                        <div class="gradient-overlay"></div>
                                        <div class="title-overlay">
                                            <h3>Industry 4.0: Cost Accounting for Smart Manufacturing</h3>
                                        </div>
                                        <div class="content-overlay">
                                            <span class="category">Manufacturing</span>
                                            <h3>Industry 4.0: Cost Accounting for Smart Manufacturing</h3>
                                            <div class="date">January 8, 2024 • 7 min read</div>
                                            <p>Understanding the financial impact of automation and IoT integration in
                                                modern
                                                manufacturing operations.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.4">
                                <div class="insight-card">
                                    <div class="image-container">
                                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200&auto=format&fit=crop"
                                            alt="Startup Valuations">
                                        <div class="gradient-overlay"></div>
                                        <div class="title-overlay">
                                            <h3>Startup Valuations in Nepal's Tech Ecosystem</h3>
                                        </div>
                                        <div class="content-overlay">
                                            <span class="category">Technology</span>
                                            <h3>Startup Valuations in Nepal's Tech Ecosystem</h3>
                                            <div class="date">January 5, 2024 • 8 min read</div>
                                            <p>Analysis of valuation methodologies and financial planning strategies for
                                                Nepal's
                                                growing tech startup scene.</p>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </div>
                    <div class="btn-all-container gsap-animate">
                        <a href="/insights" class="btn-all">
                            View All Insights <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>

            <!-- Why Choose Section -->
            <section class="why-choose-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Why Choose Our Industry Expertise?</h2>
                    <p class="lead gsap-animate">
                        We combine deep industry knowledge with technical excellence to deliver solutions that address your
                        sector's unique challenges.
                    </p>
                    <div class="row g-4">
                        @foreach ($industryExperties as $index => $experties)
                            <div class="col-12 col-md-6 col-lg-3 gsap-animate" data-delay="{{ $index * 0.1 }}">
                                <div class="why-card">
                                    <i class="{{ $experties->icon_class }}"></i>
                                    <h4>{{ $experties->title }}</h4>
                                    <p>{{ $experties->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Ready to Partner with Industry Experts?</h2>
                    <p class="gsap-animate">
                        Whether you're looking to optimize operations, ensure compliance, or drive growth, our
                        industry-specialized teams are ready to help you achieve your goals.
                    </p>
                    <div class="d-flex flex-column flex-sm-row justify-content-center gap-3 gsap-animate" data-delay="0.2">
                        <a href="#contact" class="btn-cta-filled">
                            Schedule a Consultation <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="/services" class="btn-cta-outline">
                            Explore Our Services <i class="fas fa-arrow-right"></i>
                        </a>
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

        // GSAP Animations
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            // General reveal animations
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
        });

        // AJAX Implementation for Industries
        let allIndustriesLoaded = false;
        let originalIndustriesHtml = '';

        $(document).ready(function() {
            // Store original content for "Show Less" functionality
            originalIndustriesHtml = $('#industriesGrid').html();

            // View All Button Handler
            $('#viewAllBtn').on('click', function() {
                if (allIndustriesLoaded) return;

                const $btn = $(this);
                const $btnText = $btn.find('.btn-text');
                const $btnSpinner = $btn.find('.btn-spinner');

                // Show loading state
                $btnText.hide();
                $btnSpinner.show();
                $btn.prop('disabled', true);

                $.ajax({
                    url: "{{ route('industries.all') }}",
                    method: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        if (response.industries_html) {
                            $('#industriesGrid').html(response.industries_html);
                        }

                        // Animate new elements
                        setTimeout(() => {
                            animateElements();
                            ScrollTrigger.refresh();
                        }, 100);

                        // Update button states
                        $btn.hide();
                        $('#showLessBtn').show();
                        allIndustriesLoaded = true;
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading all industries:', error);
                        alert('Failed to load all industries. Please try again later.');
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
                $('#industriesGrid').html(originalIndustriesHtml);

                // Update button states
                $(this).hide();
                $('#viewAllBtn').show();
                allIndustriesLoaded = false;

                // Scroll back to industries section
                $('html, body').animate({
                    scrollTop: $('#industries').offset().top - 100
                }, 600);

                // Re-animate original elements
                setTimeout(() => {
                    animateElements();
                    ScrollTrigger.refresh();
                }, 100);
            });

            // Smooth scroll for navigation links
            $(document).on("click", "a[href^='#']", function(e) {
                e.preventDefault();
                let target = $(this).attr("href");
                if ($(target).length) {
                    let offset = $(target).offset().top - 80;
                    $("html, body").animate({
                        scrollTop: offset
                    }, 800);
                }
            });
        });
    </script>
@endsection
