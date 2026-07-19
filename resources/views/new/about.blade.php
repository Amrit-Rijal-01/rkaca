@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('About Us', 'Learn about our firm, core values, history, and professionals dedicated to delivering top-tier financial and consulting solutions.', 'about us, firm history, core values, accounting professionals, Nepal') !!}
@endpush
@section('styles')
    <link rel="stylesheet" href="@versionedAsset('css/about.css')">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Hero Section -->
            @if ($jumbotron->isNotEmpty())
                @foreach ($jumbotron as $jumb)
                    <section class="about-hero-section"
                        style="background-image: url('{{ $jumb->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="about-hero-content gsap-animate">
                            <h1>{{ $jumb->title }}</h1>
                            <p>{{ $jumb->subtitle }}</p>
                        </div>
                    </section>
                @endforeach
            @endif


            <!-- Our Story Section -->
            <section class="story-section" id="story">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->our_story_title }}</h2>
                    <div class="story-content gsap-animate" data-delay="0.1">
                        @if (!empty($about->our_story_image))
                            <img src="{{ asset('storage/' . $about->our_story_image) }}"
                                alt="{{ $about->our_story_title ?? 'Professional team collaboration' }}"
                                class="story-image">
                        @else
                            <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?q=80&w=800&auto=format&fit=crop"
                                alt="Professional team collaboration" class="story-image">
                        @endif
                        <div class="story-text">
                            <p>{!! str_replace('.', '.</p><p>', trim($about->our_story_content, '. ')) !!}</p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Our Core Values Section -->
            <section class="values-section" id="values">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->core_values_title }}</h2>
                    <p class="lead gsap-animate">{{ $about->core_values_subtitle }}</p>
                    <div class="row g-5">
                        @foreach ($about_core_values as $index => $value)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ ($index + 1) * 0.1 }}">
                                <div class="value-card text-center">
                                    <div class="content">
                                        <div class="value-icon-wrapper mb-3 gsap-animate"
                                            data-delay="{{ ($index + 1.5) * 0.1 }}">
                                            @if ($value->icon_svg)
                                                <div class="svg-icon-container mx-auto">
                                                    {!! $value->icon_svg !!}
                                                </div>
                                            @endif
                                        </div>
                                        <h3 class="mb-3">{{ $value->title }}</h3>
                                        <p>{{ $value->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Our Leadership Team Section -->
            <section class="leadership-section" id="leadership">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->leadership_title }}</h2>
                    <p class="lead gsap-animate">{{ $about->leadership_subtitle }}</p>
                    <div class="row g-5">
                        @foreach ($about_team_members as $index => $member)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ ($index + 1) * 0.1 }}">
                                <div class="leader-card">
                                    <div class="content">
                                        <img src="{{ asset('storage/' . $member->image) }}" alt="{{ $member->name }}"
                                            class="gsap-animate" data-delay="{{ ($index + 1.5) * 0.1 }}">
                                        <h3>{{ $member->name }}</h3>
                                        <p class="title">{{ $member->position }}</p>
                                        <p>{{ $member->bio }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        {{-- <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.2">
                            <div class="leader-card">
                                <div class="content">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&q=80&w=800&auto=format&fit=crop" alt="CA Sunil Shrestha" class="gsap-animate" data-delay="0.25">
                                    <h3>CA Sunil Shrestha</h3>
                                    <p class="title">Leader - Internal Audit & Risk Advisory</p>
                                    <p>Specialist in internal audits, risk management, and corporate governance.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.3">
                            <div class="leader-card">
                                <div class="content">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&q=80&w=800&auto=format&fit=crop" alt="Senior Partner" class="gsap-animate" data-delay="0.35">
                                    <h3>Senior Partner</h3>
                                    <p class="title">Leader - Offshore & Outsourced Services</p>
                                    <p>Delivers accounting, CFO services, and compliance for global clients.</p>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </section>

            <!-- Our People Section -->
            <section class="expertise-section" id="expertise">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->expertise_title }}</h2>
                    <p class="lead gsap-animate">{{ $about->expertise_subtitle }}</p>
                    <div class="row g-5">
                        @foreach ($about_expertise_areas as $index => $expertise)
                            <div class="col-12 col-md-6 col-lg-3 gsap-animate" data-delay="{{ ($index + 1) * 0.1 }}">
                                <div class="expertise-card text-center">
                                    <div class="content">
                                        <div class="expertise-icon-wrapper mb-3">
                                            <i class="{{ $expertise->icon }} d-block mx-auto gsap-animate"
                                                data-delay="0.15"></i>
                                        </div>
                                        <h3 class="mb-3">{{ $expertise->title }}</h3>
                                        <p>{{ $expertise->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- Why Choose Us Section -->
            <section class="why-choose-section" id="why-choose">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->why_choose_us_title }}</h2>
                    <p class="lead gsap-animate">{{ $about->why_choose_us_subtitle }}</p>
                    <div class="row g-5">
                        @foreach ($about_why_choose_us as $index => $reason)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="{{ ($index + 1) * 0.1 }}">
                                <div class="reason-card text-center">
                                    <div class="content">
                                        <div class="reason-icon-wrapper mb-3">
                                            <i class="{{ $reason->icon }} d-block mx-auto gsap-animate"
                                                data-delay="{{ ($index + 1.5) * 0.1 }}"></i>
                                        </div>
                                        <h3 class="mb-3">{{ $reason->title }}</h3>
                                        <p>{{ $reason->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <!-- CTA Section -->
            <section class="cta-section">
                <div class="section-container">
                    <h2 class="gsap-animate">{{ $about->cta_title }}</h2>
                    <p class="lead gsap-animate">{{ $about->cta_subtitle }}</p>
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
            $('.value-card, .leader-card, .expertise-card, .reason-card').on('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.06,
                    boxShadow: '0 12px 30px rgba(0, 33, 63, 0.2)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    boxShadow: '0 6px 20px rgba(0, 33, 63, 0.15)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Icon Hover Animation
            $('.value-card, .expertise-card, .reason-card').on('mouseenter', function() {
                gsap.to($(this).find('i'), {
                    scale: 1.1,
                    color: 'var(--accent)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to($(this).find('i'), {
                    scale: 1,
                    color: 'var(--secondary)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Heading Hover Animation
            $('.value-card h3, .leader-card h3, .expertise-card h3, .reason-card h3').on('mouseenter', function() {
                gsap.to(this, {
                    color: 'var(--accent)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    color: 'var(--primary)',
                    duration: 0.3,
                    ease: 'power2.out'
                });
            });

            // Button Click Animation
            $('.btn-cta-filled').on('mousedown', function() {
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
            gsap.to('.about-hero-section', {
                backgroundPosition: '50% 70%',
                ease: 'none',
                scrollTrigger: {
                    trigger: '.about-hero-section',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1.5
                }
            });

            // Section and Card Reveal
            gsap.utils.toArray('.gsap-animate').forEach((el, index) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || (index * 0.15);
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 30
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
    </script>
@endsection
