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

            <!-- Featured Articles Section -->
            <section class="articles-section" id="articles">
                <div class="section-container">
                    <h2 class="gsap-animate">Featured Articles</h2>
                    <p class="lead gsap-animate">Our most popular and impactful insights that are shaping business decisions
                        across industries.</p>
                    <div class="row g-4">
                        @foreach ($insights as $index => $insight)
                            @if ($insight->is_featured == 1)
                                <div class="col-12 col-md-6 col-lg-4 gsap-animate data-delay="{{ $index * 0.1 }}">
                                    <div class="article-card">
                                        <div class="image-container">
                                            <img src="{{ asset('storage/' . $insight->featured_image) }}"
                                                alt="Strategic Tax Planning">
                                            <div class="gradient-overlay"></div>
                                            <div class="title-overlay">
                                                <h3>{{ $insight->title }}</h3>
                                            </div>
                                            <div class="content-overlay">
                                                <span class="category">{{ $insight->category }}</span>
                                                <h3>{{ $insight->title }}l</h3>
                                                <p>{{ $insight->excerpt }}</p>
                                            </div>
                                        </div>
                                    </div>
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

            <!-- Recent Articles Section -->
            <section class="recent-articles-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Recent Articles</h2>
                    <p class="lead gsap-animate">Stay updated with our latest insights and expert commentary.</p>
                    <div class="row g-4">
                        @foreach ($insightLatest as $index => $insight)
                            <div class="col-12 col-md-6 col-lg-4 gsap-animate data-delay="{{ $index * 0.3 }}">
                                <div class="article-card" data-category="{{ strtoupper($insight->category) }}"
                                    data-title="{{ $insight->title }}" data-description="{{ $insight->excerpt }}"
                                    data-author="{{ $insight->author }}"
                                    data-date="{{ date('F d, Y', strtotime($insight->published_at)) }}"
                                    data-read-time="{{ $insight->read_time }} min read"
                                    data-content="{{ $insight->content }}"
                                    data-tags="{{ collect(json_decode($insight->tags ?? '[]'))->map(fn($tag) => '#' . str_replace(' ', '', $tag))->implode(',') }}">
                                    <div class="image-container">
                                        <img src="{{ asset('storage/' . $insight->featured_image) }}" alt="NFRS Updates">
                                        <div class="gradient-overlay"></div>
                                        <div class="title-overlay">
                                            <h3>{{ $insight->title }}</h3>
                                        </div>
                                        <div class="content-overlay">
                                            <span class="category">{{ strtoupper($insight->category) }}</span>
                                            <h3>{{ $insight->title }}</h3>
                                            <p>{{ $insight->excerpt }}</p>
                                        </div>
                                    </div>
                                </div>
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
                    <div class="btn-all-container gsap-animate">
                        <a href="#articles" class="btn-all">View All Articles <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </section>

            <!-- Article Overlay -->
            <div class="article-overlay">
                <div class="article-overlay-content">
                    <button class="article-overlay-close"><i class="fas fa-times"></i></button>
                    <span class="category"></span>
                    <h3></h3>
                    <p class="lead"></p>
                    <div class="meta"></div>
                    <div class="content"></div>
                    <div class="tags">
                        <strong>Related Tags</strong><br>
                    </div>
                    <div class="share">
                        <button class="btn-share" id="shareBtn">Share this insight <i
                                class="fas fa-share-alt"></i></button>
                        <div class="social-share-icons" id="socialShareIcons" style="display: none;">
                            <a href="#" class="social-share facebook" data-platform="facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="#" class="social-share twitter" data-platform="twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="#" class="social-share linkedin" data-platform="linkedin">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="#" class="social-share whatsapp" data-platform="whatsapp">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                            <a href="#" class="social-share copy-link" data-platform="copy">
                                <i class="fas fa-link"></i>
                            </a>
                        </div>
                    </div>
                    <a href="#articles" class="back-link">Back to Insights</a>
                    <div class="toc">
                        <h4>Table of Contents</h4>
                        <p>No headings found</p>
                    </div>
                </div>
            </div>
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
        // Article Overlay Logic
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.recent-articles-section .article-card').forEach(card => {
                card.addEventListener('click', function() {
                    const category = this.dataset.category;
                    const title = this.dataset.title;
                    const description = this.dataset.description;
                    const author = this.dataset.author;
                    const date = this.dataset.date;
                    const readTime = this.dataset.readTime;
                    const content = this.dataset.content;
                    const tags = this.dataset.tags.split(',');

                    const overlay = document.querySelector('.article-overlay');
                    overlay.querySelector('.category').textContent = category;
                    overlay.querySelector('h3').textContent = title;
                    overlay.querySelector('.lead').textContent = description;
                    overlay.querySelector('.meta').textContent =
                        `${author} • ${date} • ${readTime}`;
                    overlay.querySelector('.content').textContent = content;
                    overlay.querySelector('.tags').innerHTML = '<strong>Related Tags</strong><br>';
                    tags.forEach(tag => {
                        const tagLink = document.createElement('a');
                        tagLink.href = '#';
                        tagLink.className = 'tag';
                        tagLink.textContent = tag;
                        overlay.querySelector('.tags').appendChild(tagLink);
                    });

                    overlay.classList.add('active');
                    gsap.fromTo('.article-overlay-content', {
                        opacity: 0,
                        y: 50
                    }, {
                        opacity: 1,
                        y: 0,
                        duration: 0.5,
                        ease: 'power3.out'
                    });
                });
            });

            document.querySelectorAll('.article-overlay, .article-overlay-close, .fa-times').forEach(element => {
                element.addEventListener('click', function(e) {
                    if (e.target.classList.contains('article-overlay') ||
                        e.target.classList.contains('article-overlay-close') ||
                        e.target.classList.contains('fa-times')) {
                        const overlay = document.querySelector('.article-overlay');
                        gsap.to('.article-overlay-content', {
                            opacity: 0,
                            y: 50,
                            duration: 0.5,
                            ease: 'power3.in',
                            onComplete: () => {
                                overlay.classList.remove('active');
                                overlay.querySelector('.category').textContent = '';
                                overlay.querySelector('h3').textContent = '';
                                overlay.querySelector('.lead').textContent = '';
                                overlay.querySelector('.meta').textContent = '';
                                overlay.querySelector('.content').textContent = '';
                                overlay.querySelector('.tags').innerHTML =
                                    '<strong>Related Tags</strong><br>';
                            }
                        });
                    }
                });
            });

            document.querySelectorAll('.btn-share').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    const socialIcons = document.getElementById('socialShareIcons');
                    if (socialIcons.style.display === 'none') {
                        socialIcons.style.display = 'flex';
                        gsap.fromTo(socialIcons, {
                            opacity: 0,
                            y: -10
                        }, {
                            opacity: 1,
                            y: 0,
                            duration: 0.3,
                            ease: 'power2.out'
                        });
                    } else {
                        gsap.to(socialIcons, {
                            opacity: 0,
                            y: -10,
                            duration: 0.3,
                            ease: 'power2.in',
                            onComplete: () => {
                                socialIcons.style.display = 'none';
                            }
                        });
                    }
                });
            });

            // Social media sharing functionality
            document.querySelectorAll('.social-share').forEach(shareBtn => {
                shareBtn.addEventListener('click', function(e) {
                    e.preventDefault();

                    const platform = this.dataset.platform;
                    const overlay = document.querySelector('.article-overlay');
                    const title = overlay.querySelector('h3').textContent;
                    const description = overlay.querySelector('.lead').textContent;
                    const url = encodeURIComponent(window.location.href);
                    const encodedTitle = encodeURIComponent(title);
                    const encodedDescription = encodeURIComponent(description);

                    let shareUrl = '';

                    switch (platform) {
                        case 'facebook':
                            shareUrl =
                                `https://www.facebook.com/sharer/sharer.php?u=${url}&quote=${encodedTitle} - ${encodedDescription}`;
                            break;
                        case 'twitter':
                            shareUrl =
                                `https://twitter.com/intent/tweet?text=${encodedTitle}&url=${url}`;
                            break;
                        case 'linkedin':
                            shareUrl =
                                `https://www.linkedin.com/sharing/share-offsite/?url=${url}&title=${encodedTitle}&summary=${encodedDescription}`;
                            break;
                        case 'whatsapp':
                            shareUrl =
                                `https://wa.me/?text=${encodedTitle} - ${encodedDescription} ${url}`;
                            break;
                        case 'copy':
                            // Copy link to clipboard
                            navigator.clipboard.writeText(window.location.href).then(() => {
                                // Show success message
                                const originalIcon = this.innerHTML;
                                this.innerHTML = '<i class="fas fa-check"></i>';
                                this.style.background = '#28a745';
                                setTimeout(() => {
                                    this.innerHTML = originalIcon;
                                    this.style.background = '';
                                }, 2000);
                            }).catch(() => {
                                alert('Failed to copy link to clipboard');
                            });
                            return;
                    }

                    if (shareUrl) {
                        window.open(shareUrl, '_blank',
                            'width=600,height=400,scrollbars=yes,resizable=yes');
                    }
                });
            });
        });

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
    </script>
@endsection
