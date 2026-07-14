@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta($industry->title ?: $industry->name, $industry->meta_description ?: $industry->description, 'industry, ' . ($industry->title ?: $industry->name) . ', financial solutions, auditing, compliance') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/industryDetails.css') }}">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope">
        <main>
            <!-- Hero Section -->
            <section class="hero-section">
                <div class="section-container">
                    <div class="hero-content gsap-animate">
                        <h1 class="gsap-animate" data-delay="0.1">{{ $industry->title }}</h1>
                        <p class="lead gsap-animate" data-delay="0.2">{{ $industry->meta_description }}</p>
                        <div class="d-flex flex-wrap justify-content-center gap-3">
                            <a href="/contact" class="btn-cta-filled gsap-animate" data-delay="0.3">Get Started <i
                                    class="fas fa-arrow-right"></i></a>
                            <a href="/industries" class="btn-cta-outline gsap-animate" data-delay="0.4">Back to Industries
                                <i class="fas fa-arrow-left"></i></a>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Industry Details Section -->
            <section class="industry-details-section">
                <div class="section-container">
                    <div class="row g-4">
                        <div class="col-12 gsap-animate" data-delay="0.1">
                            <div class="detail-card">
                                <div class="row align-items-center">
                                    <div class="col-lg-6 detail-content">
                                        <h2 class="section-title">{{ $industry->name }}</h2>
                                        <p class="gsap-animate" data-delay="0.2">{{ $industry->content }}</p>
                                        {{-- <p class="gsap-animate" data-delay="0.3">Our specialized financial services empower
                                            healthcare providers to navigate complex revenue cycles, ensure compliance, and
                                            optimize operations for sustainable growth.</p> --}}
                                        {{-- <h3 class="gsap-animate" data-delay="0.4">Extra Information</h3>
                                        <ul class="no-bullets gsap-animate" data-delay="0.5">
                                            <li><strong>Category:</strong> Healthcare</li>
                                            <li><strong>Status:</strong> active</li>
                                            <li><strong>Created:</strong> 2025-09-02 05:55:34</li>
                                            <li><strong>Last Updated:</strong> 2025-09-02 05:55:34</li>
                                        </ul> --}}
                                    </div>
                                    <div class="col-lg-6 order-lg-2">
                                        @if ($industry->featured_image)
                                            <img src="{{ asset('storage/' . $industry->featured_image) }}"
                                                alt="{{ $industry->name }}" class="service-image gsap-animate"
                                                data-delay="0.3">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=800&h=600"
                                                alt="Healthcare & Medical" class="service-image gsap-animate"
                                                data-delay="0.3">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Industry Overview -->
            <section class="section">
                <div class="section-container">
                    <div class="text-center">
                        <h2 class="section-title gsap-animate" data-delay="0.1">Industry Overview</h2>
                    </div>
                    <div class="prose">
                        <h3 class="gsap-animate" data-delay="0.2">{{ $industry->category }}</h3>
                        <p class="gsap-animate" data-delay="0.3">{{ $industry->content }}.</p>
                        {{-- <hr class="divider gsap-animate" data-delay="0.4">
                        <h3 class="gsap-animate" data-delay="0.5">Tailored Solutions</h3>
                        <p class="gsap-animate" data-delay="0.6">With years of experience, we provide tailored financial
                            solutions that help hospitals, clinics, pharmaceutical companies, and healthcare providers
                            optimize their operations. Our services include strategic budgeting, cost management, regulatory
                            compliance, and innovative financing options to support growth and sustainability in the
                            healthcare sector.</p>
                        <hr class="divider gsap-animate" data-delay="0.7">
                        <h3 class="gsap-animate" data-delay="0.8">Empowering Healthcare</h3>
                        <p class="gsap-animate" data-delay="0.9">We partner with our clients to navigate the complexities of
                            healthcare reform, offering insights into funding opportunities, tax incentives, and operational
                            efficiencies. Our goal is to empower healthcare organizations to focus on delivering exceptional
                            patient care while we handle their financial needs.</p> --}}
                    </div>
                </div>
            </section>

            <!-- Key Services -->
            <section class="section key-services">
                <div class="section-container">
                    <div class="text-center">
                        <h2 class="section-title gsap-animate" data-delay="0.1">{{ $industry->name }} Features</h2>
                        <p class="section-subtitle gsap-animate" data-delay="0.2">Specialized Features tailored to
                            {{ $industry->category }} needs.</p>
                    </div>
                    <div class="row g-4">
                        @foreach ($industry->features as $index => $feature)
                            <div class="col-12 col-md-6 gsap-animate" data-delay="{{ 0.3 + $index * 0.1 }}">
                                <div class="service-card">
                                    <div class="service-item">
                                        <i class="fas fa-check service-icon"></i>
                                        <div>
                                            <h3>{{ $feature }}</h3>
                                            {{-- <p>{{ $feature->description }}</p> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>

            </section>

            <!-- Case Studies -->


            <!-- Other Industries -->
            <section class="section other-industries">
                <div class="section-container">
                    <div class="text-center">
                        <h2 class="section-title gsap-animate" data-delay="0.1">Other Industries We Serve</h2>
                        <p class="section-subtitle gsap-animate" data-delay="0.2">Discover how we help businesses across
                            various sectors achieve their financial goals.</p>
                    </div>
                    <div class="row g-4">
                        @foreach ($nextindustry as $index => $other)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ 0.3 + $index * 0.1 }}">
                                <div class="industry-card"><i>
                                        <svg class="service-icon" width="40" height="40" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="{{ $other->svg_icon }}" />
                                        </svg>
                                    </i>
                                    <h3 class="service-title">{{ $other->name }}</h3>
                                    <p class="service-description">{{ $other->description }}</p>

                                    <a href="{{ route('industryDetails', $other->id) }}" class="learn-more">Learn More <i
                                            class="fas fa-arrow-right"></i></a>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </section>

            <!-- Call to Action Section -->
            <section class="cta-section">
                <div class="section-container">
                    <div class="gsap-animate">
                        <h2 class="gsap-animate" data-delay="0.1">Ready to Transform Your Healthcare & Medical Business?
                        </h2>
                        <p class="gsap-animate" data-delay="0.2">Let our industry specialists help you navigate the unique
                            challenges and opportunities in the healthcare sector.</p>
                        <div class="cta-buttons gsap-animate" data-delay="0.3">
                            <a href="/contact" class="btn-cta-filled">Schedule a Consultation <i
                                    class="fas fa-arrow-right"></i></a>
                            <a href="/industries" class="btn-cta-outline">Explore Our Services <i
                                    class="fas fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>
    @include('new.layouts.contactusform')
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            gsap.utils.toArray('.gsap-animate').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 40,
                    scale: el.classList.contains('service-image') ? 0.95 : 1
                }, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
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
    </script>
@endsection
