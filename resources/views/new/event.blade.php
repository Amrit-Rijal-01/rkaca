@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Events & Webinars', 'Join our upcoming events, seminars, and webinars to get the latest updates on tax, accounting, and financial practices.', 'events, webinars, seminars, workshops, business networking, Nepal') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Hero Section -->
            @if ($jumbotrons->isNotEmpty())
                @foreach ($jumbotrons as $jumbotron)
                    <section class="hero-section"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ $jumbotron->button_link }}"
                                    class="btn-primary-filled">{{ $jumbotron->button_text }}<i
                                        class="fas fa-arrow-right"></i></a>
                                <a href="/contact" class="btn-primary-outline">Contact Us <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif

            <!-- Events Section -->
            <section class="events-section" id="events">
                <div class="section-container">
                    <h2 class="gsap-animate">Upcoming Events</h2>
                    <p class="lead gsap-animate">Don't miss these upcoming opportunities to enhance your knowledge and
                        network with industry professionals.</p>
                    <div class="filter-buttons gsap-animate">
                        <button class="btn-filter active" data-filter="all">All Events</button>
                        @foreach ($eventTypes as $type)
                            <button class="btn-filter" data-filter="{{ $type }}">{{ $type }}s</button>
                        @endforeach
                    </div>
                    <div class="event-grid">
                        @foreach ($upcomingEvents as $event)
                            <div class="event-card gsap-animate" data-category="{{ ucfirst($event->type) }}"
                                data-title="{{ $event->title }}" data-description="{{ $event->short_description }}"
                                data-details="{{ $event->location }}|{{ $event->formatted_time }}|{{ $event->display_price }}"
                                data-button-text="{{ $event->is_free ? 'Join ' . ucfirst($event->type) . ' (Free)' : 'Register Now' }}"
                                data-button-link="{{ $event->registration_link ?: '#register' }}">

                                @if ($event->image_url)
                                    <img src="{{ $event->image_url }}" class="event-image" alt="{{ $event->title }}">
                                @else
                                    <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=1200&auto=format&fit=crop"
                                        class="event-image" alt="{{ $event->title }}">
                                @endif

                                <div class="date-container">
                                    <div class="day">{{ $event->start_date->format('j') }}</div>
                                    <div class="month">{{ $event->start_date->format('M') }}</div>
                                </div>
                                <div class="content">
                                    <span class="category">{{ ucfirst($event->type) }}</span>
                                    <h3>{{ $event->title }}</h3>
                                    <p>{{ $event->short_description }}</p>
                                </div>
                            </div>
                        @endforeach

                        @if ($upcomingEvents->isEmpty())
                            <div class="col-12 text-center">
                                <p class="lead">No upcoming events at the moment. Check back soon for new events!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Past Events Section -->
            <section class="past-events-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Past Events</h2>
                    <p class="lead gsap-animate">Missed an event? Catch up on key insights and access recordings from our
                        previous sessions.</p>
                    <div class="event-grid">
                        @foreach ($pastEvents as $event)
                            <div class="event-card gsap-animate" data-category="{{ ucfirst($event->type) }}"
                                data-title="{{ $event->title }}" data-description="{{ $event->short_description }}"
                                data-details="{{ $event->start_date->format('F j, Y') }}"
                                data-button-text="{{ $event->recording_link ? 'View Recording' : 'Event Completed' }}{{ $event->resources_link ? '|Download Resources' : '' }}"
                                data-button-link="{{ $event->recording_link ?: '#' }}{{ $event->resources_link ? '|' . $event->resources_link : '' }}">

                                @if ($event->image_url)
                                    <img src="{{ $event->image_url }}" class="event-image" alt="{{ $event->title }}">
                                @else
                                    @php
                                        $defaultImages = [
                                            'webinar' =>
                                                'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?q=80&w=1200&auto=format&fit=crop',
                                            'workshop' =>
                                                'https://images.unsplash.com/photo-1542744173-05336fcc7ad4?q=80&w=1200&auto=format&fit=crop',
                                            'training' =>
                                                'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop',
                                            'conference' =>
                                                'https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=1200&auto=format&fit=crop',
                                        ];
                                        $imageUrl = $defaultImages[$event->type] ?? $defaultImages['webinar'];
                                    @endphp
                                    <img src="{{ $imageUrl }}" class="event-image" alt="{{ $event->title }}">
                                @endif

                                <div class="date-container">
                                    <div class="day">{{ $event->start_date->format('j') }}</div>
                                    <div class="month">{{ $event->start_date->format('M') }}</div>
                                </div>
                                <div class="content">
                                    <span class="category">{{ ucfirst($event->type) }}</span>
                                    <h3>{{ $event->title }}</h3>
                                    <p>{{ $event->short_description }}</p>
                                </div>
                            </div>
                        @endforeach

                        @if ($pastEvents->isEmpty())
                            <div class="col-12 text-center">
                                <p class="lead">No past events to display.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <!-- Custom Training Section -->
            <section class="custom-training-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Need Custom Training?</h2>
                    <p class="lead gsap-animate">Looking for specialized training for your team? We offer custom workshops,
                        corporate training sessions, and on-site seminars tailored to your organization's specific needs.
                    </p>
                    <div class="row g-10">
                        <div class="col-12 col-md-6 col-lg-4 training-card gsap-animate">
                            <i class="fas fa-users"></i>
                            <h3>Team Training</h3>
                            <p>Custom workshops designed for your team's specific skill development needs.</p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 training-card gsap-animate" data-delay="0.2">
                            <i class="fas fa-building"></i>
                            <h3>On-site Seminars</h3>
                            <p>Bring our experts to your location for comprehensive training sessions.</p>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 training-card gsap-animate" data-delay="0.4">
                            <i class="fas fa-certificate"></i>
                            <h3>Certification Programs</h3>
                            <p>Structured certification programs with measurable learning outcomes.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a href="#contact" class="btn-custom">Discuss Custom Training <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>

            <!-- Event Overlay -->
            <div class="event-overlay">
                <div class="event-overlay-content">
                    <button class="event-overlay-close"><i class="fas fa-times"></i></button>
                    <span class="category"></span>
                    <h3></h3>
                    <p class="lead"></p>
                    <div class="details"></div>
                    <div class="buttons"></div>
                </div>
            </div>
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
            // Filter Logic
            $('.btn-filter').on('click', function() {
                $('.btn-filter').removeClass('active');
                $(this).addClass('active');
                const filter = $(this).data('filter');
                $('.event-card').each(function() {
                    const category = $(this).data('category');
                    if (filter === 'all' || category === filter) {
                        $(this).show();
                        gsap.fromTo(this, {
                            opacity: 0,
                            y: 20
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.5,
                            ease: 'power3.out'
                        });
                    } else {
                        $(this).hide();
                    }
                });
            });

            // Event Overlay Logic
            $('.event-card').on('click', function() {
                const category = $(this).data('category');
                const title = $(this).data('title');
                const description = $(this).data('description');
                const details = $(this).data('details').split('|');
                const buttonText = $(this).data('button-text').split('|');
                const buttonLink = $(this).data('button-link').split('|');

                $('.event-overlay .category').text(category);
                $('.event-overlay h3').text(title);
                $('.event-overlay .lead').text(description);
                $('.event-overlay .details').html('');
                details.forEach(detail => {
                    const icon = detail.includes('Online') ? 'fa-globe' : detail.includes('July') ?
                        'fa-calendar-alt' : detail.includes('AM') || detail.includes('PM') ?
                        'fa-clock' : detail.includes('NPR') || detail.includes('Free') ?
                        'fa-ticket-alt' : 'fa-map-marker-alt';
                    $('.event-overlay .details').append(
                        `<p><i class="fas ${icon}"></i> ${detail}</p>`);
                });
                $('.event-overlay .buttons').html('');
                buttonText.forEach((text, index) => {
                    const icon = text.includes('Recording') ? 'fa-play' : text.includes(
                        'Resources') ? 'fa-download' : 'fa-arrow-right';
                    const className = text.includes('Recording') || text.includes('Resources') ?
                        'btn-resource' : 'btn-event';
                    $('.event-overlay .buttons').append(
                        `<a href="${buttonLink[index]}" class="${className}">${text} <i class="fas ${icon}"></i></a>`
                    );
                });

                $('.event-overlay').addClass('active');
                gsap.fromTo('.event-overlay-content', {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.5,
                    ease: 'power3.out'
                });
            });

            $('.event-overlay-close, .event-overlay').on('click', function(e) {
                if (e.target === this || $(e.target).hasClass('event-overlay-close') || $(e.target)
                    .hasClass('fa-times')) {
                    $('.event-overlay').removeClass('active');
                    gsap.to('.event-overlay-content', {
                        opacity: 0,
                        y: 20,
                        duration: 0.5,
                        ease: 'power3.in',
                        onComplete: () => {
                            $('.event-overlay .category').text('');
                            $('.event-overlay h3').text('');
                            $('.event-overlay .lead').text('');
                            $('.event-overlay .details').html('');
                            $('.event-overlay .buttons').html('');
                        }
                    });
                }
            });

            // Card Hover Animation
            $('.event-card, .training-card').on('mouseenter', function() {
                gsap.to(this, {
                    scale: 1.03,
                    boxShadow: '0 15px 35px rgba(0, 33, 63, 0.25)',
                    duration: 0.2,
                    ease: 'power2.out'
                });
            }).on('mouseleave', function() {
                gsap.to(this, {
                    scale: 1,
                    boxShadow: '0 8px 25px rgba(0, 33, 63, 0.15)',
                    duration: 0.2,
                    ease: 'power2.out'
                });
            });
        });

        // GSAP Animations
        window.addEventListener('load', function() {
            gsap.registerPlugin(ScrollTrigger);

            // Hero Parallax
            gsap.to('.hero-section', {
                backgroundPosition: '50% 60%',
                ease: 'none',
                scrollTrigger: {
                    trigger: '.hero-section',
                    start: 'top bottom',
                    end: 'bottom top',
                    scrub: 1
                }
            });

            // Section and Card Reveal
            gsap.utils.toArray('.gsap-animate').forEach((el) => {
                const delay = parseFloat(el.getAttribute('data-delay')) || 0;
                gsap.fromTo(el, {
                    opacity: 0,
                    y: 20
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
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
