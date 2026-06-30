@extends('layouts.app')

@section('title', ($industry->meta_title ?: $industry->title ?: $industry->name) . ' - Chartered Insights')
@section('meta_description', $industry->meta_description ?: $industry->description)

@section('content')
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-gradient"></div>
        <div class="container hero-content">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <div class="icon-circle">
                            <!-- SVG Icon Example -->
                            <svg class="text-white" width="40" height="40" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0H3m16 0v-3.87a3.37 3.37 0 00-.94-2.61L3 4m16 17V9.65a2 2 0 00-.586-1.414L17 6.5" />
                            </svg>

                            <!-- Alternative Font Awesome Icon (uncomment to use instead of SVG) -->
                            <!-- <i class="fas fa-building text-white" style="font-size: 2rem;"></i> -->
                        </div>

                        <h1 class="hero-title">
                            Industry Solutions & Expertise ???
                        </h1>

                        <p class="hero-description">
                            Tailored solutions designed specifically for your industry's unique challenges and
                            opportunities, backed by years of specialized experience.
                        </p>

                        <div class="d-flex justify-content-center btn-gap">
                            <a href="#contact" class="btn-primary-custom">
                                Get Industry-Specific Consultation
                                <svg class="ms-2" width="20" height="20" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                            <a href="#services" class="btn-outline-custom">
                                Explore Our Services
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Industry Overview -->
    @if ($industry->content)
        <section class="section">
            <div class="container-custom">
                <div class="max-w-4xl mx-auto">
                    <div class="prose prose-lg max-w-none text-report-black">
                        {!! nl2br(e($industry->content)) !!}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Key Services -->
    @if ($industry->features && is_array($industry->features) && count($industry->features) > 0)
        <section class="section bg-audit-grey">
            <div class="container-custom">
                <div class="section-header text-center fade-in">
                    <h2 class="section-title">Our {{ $industry->title ?: $industry->name }} Services</h2>
                    <p class="section-subtitle">
                        Specialized solutions tailored to {{ strtolower($industry->title ?: $industry->name) }} industry
                        needs.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                    @foreach ($industry->features as $index => $feature)
                        <div
                            class="flex items-start space-x-4 fade-in @if ($index % 2 == 1) fade-in-delay-1 @endif">
                            <div class="flex-shrink-0 w-8 h-8 bg-fresh-teal rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-crisp-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-montserrat font-semibold text-deep-chartered-blue mb-2">
                                    {{ $feature }}
                                </h3>
                                <p class="text-report-black">
                                    Professional {{ strtolower($feature) }} services designed specifically for the
                                    {{ strtolower($industry->category ?: $industry->name) }} sector.
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Related Industries -->
    <section class="section">
        <div class="container-custom">
            <div class="section-header text-center fade-in">
                <h2 class="section-title">Other Industries We Serve</h2>
                <p class="section-subtitle">
                    Discover how we help businesses across various sectors achieve their financial goals.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @php
                    $relatedIndustries = \App\Models\Industry::active()
                        ->where('id', '!=', $industry->id)
                        ->ordered()
                        ->take(6)
                        ->get();
                @endphp

                @foreach ($relatedIndustries as $index => $relatedIndustry)
                    <div
                        class="industry-card service-card fade-in @if ($index % 3 == 1) fade-in-delay-1 @elseif($index % 3 == 2) fade-in-delay-2 @endif">
                        <div class="service-icon-wrapper">
                            @if ($relatedIndustry->svg_icon)
                                <svg class="service-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="{{ $relatedIndustry->svg_icon }}" />
                                </svg>
                            @elseif($relatedIndustry->icon)
                                <i class="{{ $relatedIndustry->icon }} service-icon"></i>
                            @else
                                <svg class="service-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                            @endif
                        </div>
                        <h3 class="service-title">{{ $relatedIndustry->title ?: $relatedIndustry->name }}</h3>
                        <p class="service-description">
                            {{ Str::limit($relatedIndustry->description, 120) }}
                        </p>
                        <a href="{{ route('industries.show', $relatedIndustry->slug) }}" class="btn-link">
                            Learn More
                            <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-8 fade-in">
                <a href="{{ route('industries') }}" class="btn-outline">
                    View All Industries
                    <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section bg-deep-chartered-blue text-crisp-white">
        <div class="container-custom">
            <div class="text-center fade-in">
                <h2 class="text-3xl lg:text-4xl font-montserrat font-bold mb-6">
                    Ready to Transform Your {{ $industry->title ?: $industry->name }} Business?
                </h2>
                <p class="text-xl mb-8 max-w-3xl mx-auto">
                    Let our industry specialists help you navigate the unique challenges and opportunities in the
                    {{ strtolower($industry->title ?: $industry->name) }} sector.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="btn-primary bg-fresh-teal hover:bg-opacity-90">
                        Schedule a Consultation
                        <svg class="ml-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </a>
                    <a href="{{ route('services') }}"
                        class="btn-outline border-crisp-white text-crisp-white hover:bg-crisp-white hover:text-deep-chartered-blue">
                        Explore Our Services
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .hero-section {
            background-color: var(--deep-chartered-blue);
            color: var(--crisp-white);
            padding: 80px 0;
            position: relative;
        }

        .hero-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--deep-chartered-blue) 0%, var(--fresh-teal) 100%);
            opacity: 0.9;
        }

        .hero-content {
            position: relative;
            z-index: 10;
        }

        .icon-circle {
            width: 80px;
            height: 80px;
            background-color: var(--fresh-teal);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
        }

        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 3rem;
            margin-bottom: 24px;
        }

        .hero-description {
            font-size: 1.5rem;
            color: #e5e7eb;
            margin-bottom: 32px;
            max-width: 768px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-primary-custom {
            background-color: var(--fresh-teal);
            border-color: var(--fresh-teal);
            color: var(--crisp-white);
            padding: 12px 24px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            border: 1px solid transparent;
            transition: all 0.3s ease;
        }

        .btn-primary-custom:hover {
            background-color: var(--fresh-teal);
            opacity: 0.9;
            color: var(--crisp-white);
        }

        .btn-outline-custom {
            background-color: transparent;
            border: 1px solid var(--crisp-white);
            color: var(--crisp-white);
            padding: 12px 24px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .btn-outline-custom:hover {
            background-color: var(--crisp-white);
            color: var(--deep-chartered-blue);
        }

        .btn-gap {
            gap: 16px;
        }

        @media (max-width: 991.98px) {
            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1.25rem;
            }
        }

        @media (max-width: 575.98px) {
            .btn-gap {
                flex-direction: column;
            }
        }

        .industry-features {
            list-style: none;
            margin-top: 1rem;
        }

        .industry-features li {
            position: relative;
            padding-left: 1.5rem;
            margin-bottom: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .industry-features li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #00BFB2;
            font-weight: bold;
        }

        .industry-card:hover {
            transform: translateY(-4px);
        }

        .prose {
            color: #374151;
            line-height: 1.8;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        .btn-link {
            display: inline-flex;
            align-items: center;
            color: #00BFB2;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.3s ease;
            margin-top: auto;
        }

        .btn-link:hover {
            color: #008B7A;
        }
    </style>
@endpush
