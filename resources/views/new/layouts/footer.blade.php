<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enhanced Footer</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Lora:wght@500;600;700&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

</head>

<body>
    <div class="rka-footer-scope">
        <footer class="footer">
            <div class="section-container">
                <div class="footer-grid text-justify">
                    <div class="gsap-animate floating-element">
                        <h3>About Us</h3>
                        <p>{{ $footerSetting->company_name ?? 'Roshan Kumar & Associates' }} is a premier chartered
                            accountancy firm in Nepal, delivering expert audit, tax, risk advisory, and consulting
                            services for sustainable growth.</p>
                        <p class="company-tagline">
                            {{ $footerSetting->company_tagline ?? 'Your trusted partner for financial excellence.' }}
                        </p>
                        @if ($footerSetting->company_slogan)
                            <p class="company-slogan">{{ $footerSetting->company_slogan }}</p>
                        @endif
                        <div class="social-icons">
                            @if ($footerSetting->social_links && is_array($footerSetting->social_links))
                                @if (!empty($footerSetting->social_links['linkedin']))
                                    <a href="{{ $footerSetting->social_links['linkedin'] }}" title="LinkedIn"
                                        aria-label="Follow us on LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                @endif
                                @if (!empty($footerSetting->social_links['twitter']))
                                    <a href="{{ $footerSetting->social_links['twitter'] }}" title="Twitter"
                                        aria-label="Follow us on Twitter"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if (!empty($footerSetting->social_links['facebook']))
                                    <a href="{{ $footerSetting->social_links['facebook'] }}" title="Facebook"
                                        aria-label="Follow us on Facebook"><i class="fab fa-facebook-f"></i></a>
                                @endif
                                @if (!empty($footerSetting->social_links['instagram']))
                                    <a href="{{ $footerSetting->social_links['instagram'] }}" title="Instagram"
                                        aria-label="Follow us on Instagram"><i class="fab fa-instagram"></i></a>
                                @endif
                            @else
                                <a href="#" title="LinkedIn" aria-label="Follow us on LinkedIn"><i
                                        class="fab fa-linkedin-in"></i></a>
                                <a href="#" title="Twitter" aria-label="Follow us on Twitter"><i
                                        class="fab fa-twitter"></i></a>
                                <a href="#" title="Facebook" aria-label="Follow us on Facebook"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a href="#" title="Instagram" aria-label="Follow us on Instagram"><i
                                        class="fab fa-instagram"></i></a>
                            @endif
                        </div>
                    </div>
                    @php
                        $services = DB::table('services')
                            ->select('id', 'title')
                            ->orderBy('sort_order', 'asc')
                            ->limit(5)
                            ->get();
                    @endphp
                    <div class="gsap-animate">
                        <h3>Services</h3>
                        <div class="footer-links">
                            @foreach ($services as $service)
                                <a href="{{ route('serviceDetails', $service->id) }}">{{ $service->title }}</a>
                            @endforeach
                        </div>
                    </div>

                    <div class="gsap-animate">
                        <h3>Quick Links</h3>
                        <div class="footer-links">
                            @if ($footerSetting->quick_links && is_array($footerSetting->quick_links))
                                @foreach ($footerSetting->quick_links as $link)
                                    @if (isset($link['label']) && isset($link['url']))
                                        <a href="{{ $link['url'] }}">{{ $link['label'] }}</a>
                                    @endif
                                @endforeach
                            @else
                                <a href="/industries">Industries</a>
                                <a href="/about">About Us</a>
                                <a href="/careers">Careers</a>
                                <a href="/contact">Contact Us</a>
                                <a href="/blog">Insights</a>
                            @endif
                        </div>
                    </div>

                    <div class="gsap-animate floating-element">
                        <h3>Stay Connected</h3>
                        <p>Subscribe to receive the latest insights, industry updates, and expert analysis from our team
                            of professionals.</p>
                        @if ($footerSetting->address || $footerSetting->phone || $footerSetting->email)
                            <div class="contact-info" style="margin-bottom: 15px; font-size: 14px; color: #94a3b8;">
                                @if ($footerSetting->address)
                                    <p><i class="fas fa-map-marker-alt"
                                            style="margin-right: 8px;"></i>{{ $footerSetting->address }}</p>
                                @endif
                                @if ($footerSetting->phone)
                                    <p><i class="fas fa-phone"
                                            style="margin-right: 8px;"></i>{{ $footerSetting->phone }}</p>
                                @endif
                                @if ($footerSetting->email)
                                    <p><i class="fas fa-envelope"
                                            style="margin-right: 8px;"></i>{{ $footerSetting->email }}</p>
                                @endif
                            </div>
                        @endif
                        <div class="newsletter">
                            <form onsubmit="handleNewsletterSubmit(event)" role="form"
                                aria-label="Newsletter subscription">
                                <input type="email" placeholder="Enter your email address" required
                                    aria-label="Email address">
                                <button type="submit">Subscribe</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="footer-bottom gsap-animate">
                    <p>{{ $footerSetting->copyright_text ?? '© 2025 Roshan Kumar & Associates. All rights reserved.' }}
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Register ScrollTrigger plugin
            gsap.registerPlugin(ScrollTrigger);

            // Enhanced GSAP Animations for Footer
            gsap.fromTo('.rka-footer-scope .gsap-animate', {
                opacity: 0,
                y: 50,
                scale: 0.95
            }, {
                opacity: 1,
                y: 0,
                scale: 1,
                duration: 1.2,
                stagger: 0.2,
                ease: 'power3.out',
                scrollTrigger: {
                    trigger: '.rka-footer-scope .footer',
                    start: 'top 80%',
                    toggleActions: 'play none none none'
                }
            });

            // Social icons hover animation
            gsap.set('.social-icons a', {
                scale: 1
            });

            document.querySelectorAll('.social-icons a').forEach(icon => {
                icon.addEventListener('mouseenter', () => {
                    gsap.to(icon, {
                        scale: 1.1,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });
                });

                icon.addEventListener('mouseleave', () => {
                    gsap.to(icon, {
                        scale: 1,
                        duration: 0.3,
                        ease: 'back.out(1.7)'
                    });
                });
            });

            // Newsletter form focus animation
            const newsletterInput = document.querySelector('.newsletter input');
            const newsletterForm = document.querySelector('.newsletter form');

            if (newsletterInput && newsletterForm) {
                newsletterInput.addEventListener('focus', () => {
                    gsap.to(newsletterForm, {
                        scale: 1.02,
                        duration: 0.3
                    });
                });

                newsletterInput.addEventListener('blur', () => {
                    gsap.to(newsletterForm, {
                        scale: 1,
                        duration: 0.3
                    });
                });
            }
        });

        // Enhanced Newsletter Form Handler with Animation
        function handleNewsletterSubmit(event) {
            event.preventDefault();
            const email = event.target.querySelector('input').value;
            const button = event.target.querySelector('button');

            // Button animation
            gsap.to(button, {
                scale: 0.95,
                duration: 0.1,
                yoyo: true,
                repeat: 1
            });

            // Success feedback
            const originalText = button.textContent;
            button.textContent = 'Subscribed!';
            button.style.background = 'linear-gradient(135deg, #10b981, #059669)';

            setTimeout(() => {
                button.textContent = originalText;
                button.style.background = '';
                event.target.reset();
            }, 2000);

            console.log('Newsletter subscription:', email);
        }

        // Performance optimization: Reduce motion for users who prefer it
        if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            gsap.globalTimeline.clear();
        }
    </script>
</body>

</html>
