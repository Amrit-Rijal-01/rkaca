@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Contact Us', 'Get in touch with our team for any inquiries, services, or support. We are here to help your business grow.', 'contact us, reach us, phone, email, support, address') !!}
@endpush

@section('styles')
    <link href="@versionedAsset('css/contactus.css')" rel="stylesheet">
    @include('new.layouts.links')
@endsection

@section('content')
    <div class="rka-scope" id="main-content">
        <main>
            <!-- Hero Section -->
            @if ($jumbotrons->isNotEmpty())
                @foreach ($jumbotrons as $index => $jumbotron)
                    <section class="hero-section"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="/contact" class="btn-primary-filled"><i class="fas fa-envelope"></i> Contact Us</a>
                                <a href="/services" class="btn-primary-outline"><i class="fas fa-briefcase"></i> Our
                                    Services</a>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif

            <!-- Contact Section (Form and Info Side by Side) -->
            {{-- <section class="contact-section" id="contact">
                <div class="section-container">
                    <h2 class="gsap-animate">Get in Touch</h2>
                    <p class="lead gsap-animate">Ready to discuss your business needs? Fill out the form below and one of
                        our experts will get back to you within 24 hours.</p>
                    <div class="row g-4">
                        <div class="col-lg-6 gsap-animate">
                            <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="first-name" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="first-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last-name" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="last-name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number</label>
                                        <input type="tel" class="form-control" id="phone">
                                    </div>
                                    <div class="col-12">
                                        <label for="company" class="form-label">Company/Organization</label>
                                        <input type="text" class="form-control" id="company">
                                    </div>
                                    <div class="col-12">
                                        <label for="service" class="form-label">Service of Interest</label>
                                        <select class="form-select" id="service">
                                            <option selected disabled>Please select a service</option>
                                            <option value="audit">Audit & Assurance</option>
                                            <option value="tax">Tax Advisory</option>
                                            <option value="risk">Risk Advisory</option>
                                            <option value="consulting">Business Consulting</option>
                                            <option value="financial">Financial Reporting</option>
                                            <option value="corporate">Corporate Advisory</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <label for="message" class="form-label">Message *</label>
                                        <textarea class="form-control" id="message" rows="5" required
                                            placeholder="Please describe your requirements or questions..."></textarea>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="privacy" required>
                                            <label class="form-check-label" for="privacy">
                                                I agree to the processing of my personal data for the purpose of responding
                                                to my inquiry and acknowledge that I have read the <a href="#"
                                                    class="text-accent">Privacy Policy</a>.
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn-primary-filled"><i class="fas fa-paper-plane"></i>
                                            Send Message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-6 gsap-animate" data-delay="0.2">
                            <div class="contact-info-card mb-4">
                                <h3>Main Office - Biratnagar</h3>
                                <p><strong>Address:</strong> Main Road, Biratnagar-15, Morang, Nepal</p>
                                <p><strong>Phone:</strong> <a href="tel:+97721123456"
                                        class="text-secondary">+977-21-123456</a></p>
                                <p><strong>Email:</strong> <a href="mailto:info@charteredinsights.com"
                                        class="text-secondary">info@charteredinsights.com</a></p>
                            </div>
                            <div class="contact-info-card">
                                <h3>Business Hours</h3>
                                <ul>
                                    <li><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</li>
                                    <li><strong>Saturday:</strong> 9:00 AM - 2:00 PM</li>
                                    <li><strong>Sunday:</strong> Closed</li>
                                </ul>
                                <h3>Follow Us</h3>
                                <div class="social-links">
                                    <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                                    <a href="#" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
            @include('new.layouts.contactusform')
            <!-- Location Section -->
            <section class="location-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Our Location</h2>
                    <p class="lead gsap-animate">{{ $contactInfo->title ?? 'Contact info' }}</p>
                    @if (
                        !empty($contactInfo) &&
                            !empty($contactInfo->map_embed_url) &&
                            !empty($contactInfo->google_maps_link) &&
                            !empty($footer_setting->company_name) &&
                            !empty($contactInfo->address))
                        <div class="map-container gsap-animate">
                            <iframe src="{{ $contactInfo->map_embed_url }}" allowfullscreen loading="lazy"
                                aria-label="{{ $footer_setting->company_name }} Main Office, {{ $contactInfo->address }}"></iframe>
                        </div>
                        <a href="{{ $contactInfo->google_maps_link }}" target="_blank"
                            class="btn-primary-filled gsap-animate">View on Google Maps</a>
                    @else
                        <div class="alert alert-warning gsap-animate" role="alert">
                            Location information is currently unavailable. Please contact us for details.
                        </div>
                    @endif
                </div>
            </section>

            <!-- Other Ways to Reach Us Section -->
            {{-- <section class="reach-us-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Other Ways to Reach Us</h2>
                    <p class="lead gsap-animate">Choose the communication method that works best for you.</p>
                    <div class="row g-4">
                        <div class="col-md-4 gsap-animate">
                            <div class="reach-us-card">
                                <i class="fas fa-phone-alt"></i>
                                <h3>Phone Consultation</h3>
                                <p>Schedule a phone consultation to discuss your needs and get initial guidance.</p>
                                <a href="tel:{{ $contactInfo->phone }}" class="btn-primary-filled">Call Now</a>
                            </div>
                        </div>
                        <div class="col-md-4 gsap-animate" data-delay="0.2">
                            <div class="reach-us-card">
                                <i class="fas fa-comment-dots"></i>
                                <h3>Live Chat</h3>
                                <p>Get instant answers to your questions through our live chat support during business
                                    hours.</p>
                                <a href="#" class="btn-primary-filled">Start Chat</a>
                            </div>
                        </div>
                        <div class="col-md-4 gsap-animate" data-delay="0.4">
                            <div class="reach-us-card">
                                <i class="fas fa-calendar-alt"></i>
                                <h3>Schedule Meeting</h3>
                                <p>Book a face-to-face meeting at our office or arrange a virtual consultation.</p>

                                <a href="{{ route('consultation') }}" class="btn-primary-filled">Schedule Now</a>

                            </div>
                        </div>
                    </div>
                </div>
            </section> --}}
        </main>
    </div>
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
                    duration: 1,
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

            // Button fade-in animations
            gsap.utils.toArray('.btn-primary-filled, .btn-primary-outline').forEach((btn) => {
                gsap.fromTo(btn, {
                    opacity: 0,
                    scale: 0.9
                }, {
                    opacity: 1,
                    scale: 1,
                    duration: 0.8,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: btn,
                        start: 'top 90%',
                        once: true
                    }
                });
            });

            // Recalc positions after images affect layout
            ScrollTrigger.refresh();
        });
    </script>
@endsection
