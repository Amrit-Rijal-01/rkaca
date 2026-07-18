@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta($event->title, Str::limit(strip_tags($event->short_description), 160), 'events, ' . $event->title) !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/event.css') }}">
    @include('new.layouts.links')
    <style>
        .event-detail-hero {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            padding: 4.5rem 0 2.5rem;
            position: relative;
            overflow: hidden;
        }

        .event-detail-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="1" fill="%23ffffff" opacity="0.08"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            pointer-events: none;
        }

        .event-detail-content {
            position: relative;
            z-index: 2;
        }

        .event-breadcrumb {
            margin-bottom: 1.25rem;
            font-size: 0.875rem;
        }

        .event-breadcrumb a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: var(--transition);
        }

        .event-breadcrumb a:hover {
            color: #fff;
        }

        .event-breadcrumb .separator {
            color: rgba(255, 255, 255, 0.4);
            margin: 0 0.5rem;
        }

        .event-breadcrumb .current {
            color: rgba(255, 255, 255, 0.6);
        }

        .event-detail-hero h1 {
            font-family: var(--font-heading);
            font-size: 2.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 0.75rem;
        }

        .event-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .event-meta-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
        }

        .event-meta-item i {
            font-size: 1rem;
            width: 1.25rem;
            text-align: center;
        }

        .event-body {
            padding: 3rem 0;
        }

        .event-description {
            font-size: 1.05rem;
            line-height: 1.8;
            color: #444;
        }

        .event-info-card {
            background: #fff;
            border-radius: 12px;
            padding: 2rem;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            position: sticky;
            top: 2rem;
        }

        .event-info-item {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }

        .event-info-item:last-child {
            border-bottom: none;
        }

        .event-info-item i {
            font-size: 1.25rem;
            color: var(--primary);
            width: 1.5rem;
            text-align: center;
            margin-top: 0.15rem;
        }

        .event-info-item .label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #888;
            margin-bottom: 0.15rem;
        }

        .event-info-item .value {
            font-weight: 500;
            color: #333;
        }

        .register-btn {
            display: block;
            width: 100%;
            padding: 0.9rem;
            background: var(--primary);
            color: #fff;
            text-align: center;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: var(--transition);
            margin-top: 1.5rem;
        }

        .register-btn:hover {
            background: var(--secondary);
            color: #fff;
        }

        .section-title {
            font-family: var(--font-heading);
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 1.5rem;
        }

        .related-card {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            transition: var(--transition);
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .related-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.12);
        }

        .related-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .related-card-body {
            padding: 1.25rem;
        }

        .related-card-body h5 {
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .related-card-body p {
            font-size: 0.9rem;
            color: #666;
            margin-bottom: 0;
        }

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
    </style>
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0;">
            <section class="event-detail-hero">
                <div class="container event-detail-content">
                    <div class="event-breadcrumb">
                        <a href="{{ route('home') }}">Home</a>
                        <span class="separator">/</span>
                        <a href="{{ route('events') }}">Events</a>
                        <span class="separator">/</span>
                        <span class="current">{{ $event->title }}</span>
                    </div>
                    <span class="badge bg-white text-primary mb-3">{{ ucfirst($event->type) }}</span>
                    <h1>{{ $event->title }}</h1>
                    <div class="event-meta">
                        @if ($event->start_date)
                            <div class="event-meta-item">
                                <i class="fas fa-calendar-alt"></i>
                                <span>{{ $event->start_date->format('F j, Y') }}{{ $event->end_date && $event->end_date->format('Y-m-d') !== $event->start_date->format('Y-m-d') ? ' - ' . $event->end_date->format('F j, Y') : '' }}</span>
                            </div>
                        @endif
                        @if ($event->formatted_time)
                            <div class="event-meta-item">
                                <i class="fas fa-clock"></i>
                                <span>{{ $event->formatted_time }}</span>
                            </div>
                        @endif
                        @if ($event->location)
                            <div class="event-meta-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <span>{{ $event->location }}</span>
                            </div>
                        @endif
                        @if ($event->display_price)
                            <div class="event-meta-item">
                                <i class="fas fa-ticket-alt"></i>
                                <span>{{ $event->display_price }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            <section class="event-body">
                <div class="container">
                    <div class="row g-5">
                        <div class="col-lg-8">
                            @if ($event->featured_image)
                                <img src="{{ asset('storage/' . $event->featured_image) }}"
                                     alt="{{ $event->title }}"
                                     class="img-fluid rounded-3 mb-4 w-100"
                                     style="max-height: 400px; object-fit: cover;">
                            @endif

                            @if ($event->short_description)
                                <div class="event-description mb-4">
                                    <p>{{ $event->short_description }}</p>
                                </div>
                            @endif

                            @if ($event->pdf_file)
                                <div class="pdf-document-wrapper">
                                    <div class="pdf-viewer-header">
                                        <div class="pdf-viewer-title">
                                            <i class="fas fa-file-pdf"></i>
                                            <span>{{ $event->title }} (PDF Document)</span>
                                        </div>
                                        <a href="{{ asset('storage/' . $event->pdf_file) }}" target="_blank" download
                                            class="btn-pdf-download">
                                            <i class="fas fa-download"></i> Download PDF
                                        </a>
                                    </div>
                                    <div class="pdf-iframe-box">
                                        <iframe src="{{ asset('storage/' . $event->pdf_file) }}" width="100%"
                                            height="100%" style="border: none;"></iframe>
                                    </div>
                                </div>
                            @else
                                <div class="event-description">
                                    <p class="text-muted">No PDF document available for this event.</p>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4">
                            <div class="event-info-card">
                                <h5 class="section-title">Event Details</h5>

                                @if ($event->start_date)
                                    <div class="event-info-item">
                                        <i class="fas fa-calendar-alt"></i>
                                        <div>
                                            <div class="label">Date</div>
                                            <div class="value">{{ $event->start_date->format('F j, Y') }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->end_date && $event->end_date->format('Y-m-d') !== $event->start_date->format('Y-m-d'))
                                    <div class="event-info-item">
                                        <i class="fas fa-calendar-check"></i>
                                        <div>
                                            <div class="label">End Date</div>
                                            <div class="value">{{ $event->end_date->format('F j, Y') }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->formatted_time)
                                    <div class="event-info-item">
                                        <i class="fas fa-clock"></i>
                                        <div>
                                            <div class="label">Time</div>
                                            <div class="value">{{ $event->formatted_time }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->location)
                                    <div class="event-info-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <div class="label">Location</div>
                                            <div class="value">{{ $event->location }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->venue_type)
                                    <div class="event-info-item">
                                        <i class="fas fa-globe"></i>
                                        <div>
                                            <div class="label">Venue Type</div>
                                            <div class="value">{{ ucfirst($event->venue_type) }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->display_price)
                                    <div class="event-info-item">
                                        <i class="fas fa-ticket-alt"></i>
                                        <div>
                                            <div class="label">Price</div>
                                            <div class="value">{{ $event->display_price }}</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->max_participants)
                                    <div class="event-info-item">
                                        <i class="fas fa-users"></i>
                                        <div>
                                            <div class="label">Capacity</div>
                                            <div class="value">{{ $event->max_participants }} participants</div>
                                        </div>
                                    </div>
                                @endif

                                @if ($event->registration_link)
                                    <a href="{{ $event->registration_link }}" class="register-btn" target="_blank">
                                        <i class="fas fa-external-link-alt me-2"></i>Register Now
                                    </a>
                                @else
                                    <a href="{{ route('consultation') }}" class="register-btn">
                                        <i class="fas fa-calendar-check me-2"></i>Book Consultation
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @if ($relatedEvents->isNotEmpty())
                <section class="event-body bg-light">
                    <div class="container">
                        <h3 class="section-title text-center mb-4">Related Events</h3>
                        <div class="row g-4">
                            @foreach ($relatedEvents as $related)
                                <div class="col-md-4">
                                    <a href="{{ route('events.show', $related->slug) }}" class="related-card">
                                        @if ($related->image_url)
                                            <img src="{{ $related->image_url }}" alt="{{ $related->title }}">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1540575467063-178a50c2df87?q=80&w=1200&auto=format&fit=crop" alt="{{ $related->title }}">
                                        @endif
                                        <div class="related-card-body">
                                            <span class="badge bg-primary mb-2">{{ ucfirst($related->type) }}</span>
                                            <h5>{{ $related->title }}</h5>
                                            <p>
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ $related->start_date ? $related->start_date->format('M j, Y') : '' }}
                                                @if ($related->location)
                                                    &middot; <i class="fas fa-map-marker-alt me-1"></i>{{ $related->location }}
                                                @endif
                                            </p>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif
        </main>
    </div>
@endsection
