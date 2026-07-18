@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta($service->title, $service->meta_description ?: $service->description, 'service, ' . $service->title . ', audit, tax, advisory') !!}
@endpush

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/serviceDetails.css') }}">
    @include('new.layouts.links')
    <style>
        /* ─── Page-level overrides ─────────────────────────── */
        .sd-hero {
            position: relative;
            padding: 5rem 0 4rem;
            background: linear-gradient(135deg, var(--primary) 0%, #004b7a 60%, var(--secondary) 100%);
            overflow: hidden;
            width: 100%;
        }

        .sd-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(ellipse 80% 60% at 20% 50%, rgba(0, 180, 242, 0.18) 0%, transparent 70%),
                radial-gradient(ellipse 50% 80% at 80% 30%, rgba(255, 255, 255, 0.07) 0%, transparent 60%);
        }

        .sd-hero-inner {
            position: relative;
            max-width: 860px;
            margin: 0 auto;
            padding: 0 1.5rem;
            text-align: center;
        }

        .sd-breadcrumb {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.65);
            margin-bottom: 1.5rem;
        }

        .sd-breadcrumb a {
            color: rgba(255, 255, 255, 0.65);
            text-decoration: none;
            transition: color 0.2s;
        }

        .sd-breadcrumb a:hover {
            color: #fff;
        }

        .sd-breadcrumb .sep {
            color: rgba(255, 255, 255, 0.3);
        }

        .sd-hero h1 {
            font-family: 'Lora', serif;
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 800;
            color: #fff;
            line-height: 1.2;
            margin: 0 0 1.2rem;
            text-shadow: 0 2px 20px rgba(0, 0, 0, 0.18);
        }

        .sd-hero .lead {
            font-size: clamp(0.95rem, 2.5vw, 1.15rem);
            color: rgba(255, 255, 255, 0.82);
            max-width: 680px;
            margin: 0 auto 2rem;
            line-height: 1.75;
        }

        .sd-hero-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        /* ─── Body layout ──────────────────────────────────── */
        .sd-body {
            background: var(--light);
            padding: 3.5rem 0 4rem;
            width: 100%;
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

        /* ─── Content card ─────────────────────────────────── */
        .sd-content-card {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 40px var(--shadow);
            padding: 2.5rem 2.75rem;
            min-width: 0;
        }

        .sd-content-card .section-label {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--secondary);
            background: rgba(0, 144, 212, 0.09);
            border-radius: 50px;
            padding: 0.3rem 0.9rem;
            margin-bottom: 1.5rem;
        }

        /* ─── Summernote body content ──────────────────────── */
        .note-editable h1,
        .note-editable h2,
        .note-editable h3,
        .note-editable h4,
        .note-editable h5,
        .note-editable h6 {
            font-family: 'Lora', serif !important;
            font-weight: 700 !important;
            text-align: left !important;
            margin-top: 2rem !important;
            margin-bottom: 0.85rem !important;
            position: static !important;
            transform: none !important;
            color: var(--primary) !important;
            letter-spacing: 0.2px !important;
        }

        .note-editable h2 {
            font-size: 1.65rem !important;
        }

        .note-editable h3 {
            font-size: 1.35rem !important;
        }

        .note-editable h4 {
            font-size: 1.15rem !important;
        }

        .note-editable h3:hover {
            color: var(--primary) !important;
            transform: none !important;
        }

        .note-editable h3::after {
            display: none !important;
        }

        .note-editable ul,
        .note-editable ol {
            padding-left: 1.75rem !important;
            margin-bottom: 1.5rem !important;
        }

        .note-editable ul {
            list-style-type: disc !important;
        }

        .note-editable ol {
            list-style-type: decimal !important;
        }

        .note-editable li {
            list-style-type: inherit !important;
            margin-bottom: 0.5rem !important;
            padding-left: 0.25rem !important;
            line-height: 1.7 !important;
            color: #374151 !important;
        }

        .note-editable li::before {
            display: none !important;
        }

        .note-editable p {
            margin-bottom: 1.25rem !important;
            line-height: 1.8 !important;
            color: #374151 !important;
        }

        .note-editable table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-bottom: 1.5rem !important;
            border-radius: 10px !important;
            overflow: hidden !important;
        }

        .note-editable table th,
        .note-editable table td {
            padding: 0.75rem 1rem !important;
            border: 1px solid #e2e8f0 !important;
            text-align: left !important;
        }

        .note-editable table th {
            background: linear-gradient(135deg, var(--primary), var(--secondary)) !important;
            color: #fff !important;
            font-weight: 600 !important;
        }

        .note-editable table tr:nth-child(even) td {
            background: rgba(0, 144, 212, 0.04) !important;
        }

        .note-editable img {
            max-width: 100% !important;
            height: auto !important;
            border-radius: 12px !important;
            margin: 1.25rem 0 !important;
            box-shadow: 0 4px 20px var(--shadow) !important;
        }

        .note-editable blockquote {
            border-left: 4px solid var(--secondary) !important;
            padding: 1rem 1.5rem !important;
            margin: 1.5rem 0 !important;
            background: rgba(0, 144, 212, 0.05) !important;
            border-radius: 0 10px 10px 0 !important;
            color: var(--gray) !important;
            font-style: italic !important;
        }



        /* ─── CTA section ──────────────────────────────────── */
        .sd-bottom-cta {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            padding: 5rem 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .sd-bottom-cta::before {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1), transparent 65%);
        }

        .sd-bottom-cta-inner {
            position: relative;
            max-width: 700px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .sd-bottom-cta h2 {
            font-family: 'Lora', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: #fff;
            margin: 0 0 1rem;
        }

        .sd-bottom-cta p {
            font-size: clamp(0.95rem, 2.5vw, 1.05rem);
            color: rgba(255, 255, 255, 0.82);
            margin: 0 0 2rem;
            line-height: 1.7;
        }

        /* ─── Responsive ───────────────────────────────────── */
        @media (max-width: 1200px) {
            .sd-body-inner {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .sd-content-card {
                padding: 1.5rem;
            }

            .sd-hero {
                padding: 3.5rem 0 3rem;
            }

            .sd-sidebar {
                flex-direction: column;
            }
        }

        /* ─── Sub-services section (copied/adapted from services.css) ─── */
        .sub-services-section {
            padding: 5rem 0;
            background: #fff;
        }
        .sub-services-section h2 {
            font-family: 'Lora', serif;
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 800;
            color: var(--primary);
            text-align: center;
            margin-bottom: 3rem;
        }
        .service-card {
            background: linear-gradient(135deg, var(--white), var(--light));
            border-radius: 20px;
            padding: 2.5rem;
            box-shadow: 0 10px 30px var(--shadow);
            min-height: 280px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px var(--shadow-lg);
        }
        .service-card h3 {
            font-size: clamp(1.4rem, 3vw, 1.6rem);
            margin-bottom: 1.2rem;
            position: relative;
            transition: all 0.3s ease;
            font-family: 'Lora', serif;
            font-weight: 700;
            color: var(--primary);
        }
        .service-card h3::after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--secondary);
            transition: width 0.3s ease;
        }
        .service-card:hover h3::after {
            width: 100%;
        }
        .service-card p {
            color: var(--gray);
            font-size: clamp(0.9rem, 2.5vw, 1rem);
            flex-grow: 1;
            margin-bottom: 1.5rem;
        }
        .learn-more {
            font-weight: 600;
            color: var(--secondary);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
        }
        .learn-more:hover {
            color: var(--accent);
            transform: translateX(8px);
        }
        .learn-more i {
            margin-left: 10px;
            transition: transform 0.3s;
        }
    </style>
@endsection

@section('content')
    <div class="rka-scope">
        <main>

            {{-- ── Hero ─────────────────────────────────────────── --}}
            <section class="sd-hero">
                <div class="sd-hero-inner gsap-animate">
                    <div class="sd-breadcrumb">
                        <a href="{{ url('/') }}"><i class="fas fa-home"></i></a>
                        <span class="sep">/</span>
                        <a href="{{ url('/services') }}">Services</a>
                        <span class="sep">/</span>
                        <span>{{ $service->title }}</span>
                    </div>

                    @if ($service->category)
                        <div style="margin-bottom: 1rem;">
                            <span
                                style="background: rgba(255,255,255,0.15); color: rgba(255,255,255,0.9); font-size: 0.72rem; font-weight: 700; letter-spacing: 1.2px; text-transform: uppercase; padding: 0.3rem 1rem; border-radius: 50px; border: 1px solid rgba(255,255,255,0.25);">
                                {{ $service->category }}
                            </span>
                        </div>
                    @endif

                    <h1>{{ $service->title }}</h1>
                    <p class="lead">{{ $service->description }}</p>

                    <div class="sd-hero-actions">
                        <a href="/contact" class="btn-primary-filled">
                            Get Started <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="/services" class="btn-primary-outline">
                            <i class="fas fa-arrow-left"></i> All Services
                        </a>
                    </div>
                </div>
            </section>

            {{-- ── Two-column body ──────────────────────────────── --}}
            <section class="sd-body">
                <div class="sd-body-inner">

                    {{-- Main content --}}
                    <div class="sd-content-card gsap-animate">
                        <div class="section-label">
                            <i class="fas fa-file-alt"></i> Service Details
                        </div>
                        <div class="note-editable">
                            @if ($service->body)
                                {!! $service->body !!}
                            @else
                                <p style="color: var(--gray); font-style: italic;">No detailed content has been added for
                                    this service yet.</p>
                            @endif
                        </div>

                        @if($service->subServices && $service->subServices->isNotEmpty())
                        <!-- Sub Services Section -->
                        <div class="sub-services-wrapper mt-5 pt-4 border-top">
                            <h2 class="mb-4" style="font-family: 'Lora', serif; font-size: clamp(1.5rem, 3vw, 2rem); font-weight: 800; color: var(--primary);">Related Sub-Services</h2>
                            <div class="row g-4">
                                @foreach ($service->subServices as $index => $subService)
                                    <div class="col-md-6 gsap-animate" data-delay="{{ $index * 0.1 }}">
                                        <div class="service-card">
                                            <div>
                                                <h3>{{ $subService->title }}</h3>
                                                <p>{{ $subService->description }}</p>
                                            </div>
                                            <a href="{{ route('serviceDetails', $subService->id) }}" class="learn-more">
                                                Learn More <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>

                    {{-- Sidebar --}}
                    <x-sidebar-cta :backRoute="url('/services')" backLabel="All Services" />
                </div>
            </section>

            {{-- ── Bottom CTA ────────────────────────────────────── --}}
            <section class="sd-bottom-cta">
                <div class="sd-bottom-cta-inner gsap-animate">
                    <h2>Ready to Elevate Your Business?</h2>
                    <p>Contact us today to learn how <strong>{{ $service->title }}</strong> can drive your success.</p>
                    <div class="sd-hero-actions">
                        <a href="/contact" class="btn-primary-filled">
                            Contact Us <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="/services" class="btn-primary-outline">
                            Explore All Services <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </section>

        </main>
        @include('new.layouts.contactusform')
    </div>
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
                    y: 40
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 1.1,
                    delay,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: el,
                        start: 'top 87%',
                        once: true,
                        invalidateOnRefresh: true
                    }
                });
            });

            ScrollTrigger.refresh();
        });
    </script>
@endsection
