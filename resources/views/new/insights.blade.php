@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Insights & Publications', 'Stay updated with the latest insights, financial updates, tax regulations, and regulatory changes in Nepal.', 'insights, financial updates, tax law, business articles, publications, Nepal') !!}
@endpush

@section('styles')
    @include('new.layouts.links')
    <link rel="stylesheet" href="{{ asset('css/insights.css') }}">
    <style>
        .social-share-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .social-share {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 16px;
        }

        .social-share:hover {
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .social-share.facebook {
            background: #1877f2;
        }

        .social-share.facebook:hover {
            background: #166fe5;
        }

        .social-share.twitter {
            background: #1da1f2;
        }

        .social-share.twitter:hover {
            background: #0d8bd9;
        }

        .social-share.linkedin {
            background: #0077b5;
        }

        .social-share.linkedin:hover {
            background: #005885;
        }

        .social-share.whatsapp {
            background: #25d366;
        }

        .social-share.whatsapp:hover {
            background: #1ebe57;
        }

        .social-share.copy-link {
            background: #6c757d;
        }

        .social-share.copy-link:hover {
            background: #545b62;
        }
    </style>
@endsection

@section('content')
    <div class="rka-scope" style="margin: 0; padding: 0; overflow-x: hidden;">
        <main style="margin: 0; padding: 0; width: 100vw;">
            <!-- Hero Section (Simplified to single slide without slider) -->
            <section class="hero-section">
                @foreach ($jumbotrons as $index => $jumbotron)
                    <div class="hero-slide hero-slide-{{ $index + 1 }}"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ $jumbotron->button_link }}"
                                    class="btn-primary-filled">{{ $jumbotron->button_text }} <i
                                        class="fas fa-arrow-right"></i></a>
                                <a href="/contact" class="btn-primary-outline">Contact Us <i
                                        class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </section>

            <!-- Featured Insights Section -->
            <section class="articles-section" id="articles">
                <div class="section-container">
                    <h2 class="gsap-animate">Featured Insights</h2>
                    <p class="lead gsap-animate">Our most popular and impactful insights that are shaping business decisions
                        across industries.</p>
                    <div class="row g-4">
                        @foreach ($insights as $index => $insight)
                            @if ($insight->is_featured == 1)
                                <div class="col-12 col-md-6 col-lg-4 gsap-animate data-delay="{{ $index * 0.1 }}">
                                    <a href="{{ route('insights.detail', $insight->slug) }}" class="article-card-link" style="text-decoration: none; color: inherit; display: block;">
                                        <div class="article-card" @if($insight->featured_image) style="background-image: url('{{ asset('storage/' . $insight->featured_image) }}'); background-size: cover; background-position: center;" @endif>
                                            <!-- Dark overlay for image legibility -->
                                            @if($insight->featured_image)
                                                <div class="card-img-overlay"></div>
                                            @endif
                                            <!-- Category Badge (Normal state) -->
                                            <span class="category-badge-normal">{{ $insight->category }}</span>
                                            <!-- Default State Title (Unhovered) -->
                                            <div class="default-title">
                                                <h3>{{ $insight->title }}</h3>
                                            </div>
                                            <!-- Hover State Content Overlay -->
                                            <div class="content-overlay">
                                                <div class="content-details">
                                                    <h3>{{ $insight->title }}</h3>
                                                    <p>{{ $insight->excerpt }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                        @endforeach

                        {{-- <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.2">
                            <div class="article-card">
                                <div class="image-container">
                                    <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?q=80&w=1200&auto=format&fit=crop" alt="Digital Transformation">
                                    <div class="gradient-overlay"></div>
                                    <div class="title-overlay">
                                        <h3>Digital Transformation in Modern Accounting Practices</h3>
                                    </div>
                                    <div class="content-overlay">
                                        <span class="category">TECHNOLOGY</span>
                                        <h3>Digital Transformation in Modern Accounting Practices</h3>
                                        <p>Exploring how technology is reshaping the accounting landscape and what it means for businesses in Nepal.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.4">
                            <div class="article-card">
                                <div class="image-container">
                                    <img src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1200&auto=format&fit=crop" alt="Risk Management">
                                    <div class="gradient-overlay"></div>
                                    <div class="title-overlay">
                                        <h3>Understanding Risk Management in Financial Reporting</h3>
                                    </div>
                                    <div class="content-overlay">
                                        <span class="category">RISK MANAGEMENT</span>
                                        <h3>Understanding Risk Management in Financial Reporting</h3>
                                        <p>A comprehensive guide to identifying and mitigating risks in financial reporting processes.</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </section>

            <!-- Recent Insights Section -->
            <section class="recent-articles-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Recent Insights</h2>
                    <p class="lead gsap-animate">Stay updated with our latest insights and expert commentary.</p>
                    <div class="row g-4">
                        @foreach ($insightLatest as $index => $insight)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate recent-insight-item {{ $index >= 6 ? 'd-none' : '' }}" data-delay="{{ $index * 0.3 }}">
                                <a href="{{ route('insights.detail', $insight->slug) }}" class="article-card-link" style="text-decoration: none; color: inherit; display: block;">
                                    <div class="article-card" @if($insight->featured_image) style="background-image: url('{{ asset('storage/' . $insight->featured_image) }}'); background-size: cover; background-position: center;" @endif>
                                        <!-- Dark overlay for image legibility -->
                                        @if($insight->featured_image)
                                            <div class="card-img-overlay"></div>
                                        @endif
                                        <!-- Category Badge (Normal state) -->
                                        <span class="category-badge-normal">{{ $insight->category }}</span>
                                        <!-- Default State Title (Unhovered) -->
                                        <div class="default-title">
                                            <h3>{{ $insight->title }}</h3>
                                        </div>
                                        <!-- Hover State Content Overlay -->
                                        <div class="content-overlay">
                                            <div class="content-details">
                                                <h3>{{ $insight->title }}</h3>
                                                <p>{{ $insight->excerpt }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                        {{-- Example static articles for layout demonstration --}}
                        {{-- <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.2">
                            <div class="article-card" 
                                 data-category="BUSINESS STRATEGY" 
                                 data-title="ESG Reporting: A Growing Imperative for Businesses" 
                                 data-description="Understanding Environmental, Social, and Governance reporting requirements and best practices for sustainable business operations." 
                                 data-author="Sita Rai, Sustainability Consultant" 
                                 data-date="August 14, 2025" 
                                 data-read-time="7 min read" 
                                 data-content="Environmental, Social, and Governance (ESG) reporting has moved from a voluntary initiative to a business imperative. Companies worldwide are facing increasing pressure from investors, regulators, and stakeholders to demonstrate their commitment to sustainable practices." 
                                 data-tags="#ESG,#sustainability,#reporting,#governance">
                                <div class="image-container">
                                    <img src="https://images.unsplash.com/photo-1565514020179-026b92b84bb6?q=80&w=1200&auto=format&fit=crop" alt="ESG Reporting">
                                    <div class="gradient-overlay"></div>
                                    <div class="title-overlay">
                                        <h3>ESG Reporting: A Growing Imperative for Businesses</h3>
                                    </div>
                                    <div class="content-overlay">
                                        <span class="category">BUSINESS STRATEGY</span>
                                        <h3>ESG Reporting: A Growing Imperative for Businesses</h3>
                                        <p>Understanding Environmental, Social, and Governance reporting requirements and best practices for sustainable business operations.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 gsap-animate" data-delay="0.4">
                            <div class="article-card" 
                                 data-category="AUDIT & ASSURANCE" 
                                 data-title="Internal Audit Best Practices for SMEs" 
                                 data-description="Essential internal audit practices that small and medium enterprises can implement to improve operations and compliance." 
                                 data-author="Sita Rai, Sustainability Consultant" 
                                 data-date="August 14, 2025" 
                                 data-read-time="7 min read" 
                                 data-content="Internal audits are critical for SMEs to ensure operational efficiency and regulatory compliance. This article outlines best practices to implement effective audit processes tailored for smaller businesses." 
                                 data-tags="#audit,#SME,#compliance,#bestpractices">
                                <div class="image-container">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=1200&auto=format&fit=crop" alt="Internal Audit">
                                    <div class="gradient-overlay"></div>
                                    <div class="title-overlay">
                                        <h3>Internal Audit Best Practices for SMEs</h3>
                                    </div>
                                    <div class="content-overlay">
                                        <span class="category">AUDIT & ASSURANCE</span>
                                        <h3>Internal Audit Best Practices for SMEs</h3>
                                        <p>Essential internal audit practices that small and medium enterprises can implement to improve operations and compliance.</p>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    @if ($insightLatest->count() >= 7)
                        <div class="btn-all-container gsap-animate">
                            <a href="#" class="btn-all" id="btn-view-all-insights">View All Insights <i class="fas fa-arrow-right"></i></a>
                        </div>
                    @endif
                </div>
            </section>


        </main>
    </div>
    @include('new.layouts.contactusform')
@endsection

@section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- GSAP and ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
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

            // View All Insights click handler with GSAP animation
            document.getElementById('btn-view-all-insights')?.addEventListener('click', function(e) {
                e.preventDefault();
                const hiddenItems = document.querySelectorAll('.recent-insight-item.d-none');
                hiddenItems.forEach(item => {
                    item.classList.remove('d-none');
                });
                
                // Animate showing items using GSAP
                gsap.fromTo(hiddenItems, {
                    opacity: 0,
                    y: 30
                }, {
                    opacity: 1,
                    y: 0,
                    duration: 0.8,
                    stagger: 0.15,
                    ease: 'power3.out'
                });
                
                const btnContainer = document.querySelector('.btn-all-container');
                if (btnContainer) {
                    btnContainer.style.display = 'none';
                }
            });
        });
    </script>
@endsection
