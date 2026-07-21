<!-- Toast Notification Container -->
<div id="toast-container" class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="success-toast" class="toast align-items-center text-white bg-success border-0" role="alert"
        aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                <i class="fas fa-check-circle me-2"></i>
                <span id="toast-message">Message sent successfully! We'll get back to you within 24 hours.</span>
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                aria-label="Close"></button>
        </div>
    </div>
</div>
@php
    $footerSetting = \App\Models\FooterSetting::first();

@endphp
<!-- Contact Section (Form and Info Side by Side) -->
<section class="contact-section" id="contact">
    <div class="section-container">
        <h2 class="gsap-animate">Get in Touch</h2>
        <p class="lead gsap-animate">Ready to discuss your business needs? Fill out the form below and one of our
            experts
            will get back to you within 24 hours.</p>
        <div class="row g-4">
            <div class="col-lg-6 gsap-animate">
                <form class="contact-form" action="{{ route('contact.submit') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="first-name" class="form-label">First Name *</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror"
                                name='first_name' id="first-name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="last-name" class="form-label">Last Name *</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                name='last_name' id="last-name" value="{{ old('last_name') }}" required>
                            @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email Address *</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                name='email' id="email" value="{{ old('email') }}" required>
                            <div class="invalid-feedback" id="email-error">
                                @error('email')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="valid-feedback" id="email-success">Email format is valid!</div>
                        </div>
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror"
                                name='phone' id="phone" value="{{ old('phone') }}" placeholder="+977-XX-XXXXXXX">
                            <div class="invalid-feedback" id="phone-error">
                                @error('phone')
                                    {{ $message }}
                                @enderror
                            </div>
                            <div class="valid-feedback" id="phone-success">Phone number format is valid!</div>
                        </div>
                        <div class="col-12">
                            <label for="company" class="form-label">Company/Organization</label>
                            <input type="text" class="form-control @error('company') is-invalid @enderror"
                                name='company' id="company" value="{{ old('company') }}">
                            @error('company')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="service" class="form-label">Service of Interest</label>
                            <select class="form-select @error('service') is-invalid @enderror" name='service'
                                id="service">
                                <option value="" disabled {{ old('service') ? '' : 'selected' }}>Please select a
                                    service</option>
                                <option value="audit" {{ old('service') == 'audit' ? 'selected' : '' }}>Audit &
                                    Assurance</option>
                                <option value="tax" {{ old('service') == 'tax' ? 'selected' : '' }}>Tax Advisory
                                </option>
                                <option value="risk" {{ old('service') == 'risk' ? 'selected' : '' }}>Risk Advisory
                                </option>
                                <option value="consulting" {{ old('service') == 'consulting' ? 'selected' : '' }}>
                                    Business Consulting</option>
                                <option value="financial" {{ old('service') == 'financial' ? 'selected' : '' }}>
                                    Financial Reporting</option>
                                <option value="corporate" {{ old('service') == 'corporate' ? 'selected' : '' }}>
                                    Corporate Advisory</option>
                            </select>
                            @error('service')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <label for="message" class="form-label">Message *</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name='message' id="message" rows="5"
                                required placeholder="Please describe your requirements or questions...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input @error('privacy_consent') is-invalid @enderror"
                                    type="checkbox" name='privacy_consent' id="privacy" value="1"
                                    {{ old('privacy_consent') ? 'checked' : '' }} required>
                                <label class="form-check-label" for="privacy">
                                    I agree to the processing of my personal data for the purpose of responding to my
                                    inquiry and acknowledge that I have read the <a href="#"
                                        class="text-accent">Privacy Policy</a>.
                                </label>
                                @error('privacy_consent')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 text-center">
                            <button type="submit" class="btn-primary-filled"><i class="fas fa-paper-plane"></i> Send
                                Message</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-6 gsap-animate d-flex flex-column" data-delay="0.2">
                <div class="contact-info-card mb-4">
                    <h3>Main Office -
                        {{ $footerSetting? Str::of(str_replace(',', '', $footerSetting->address))->explode(' ')->first(): 'N/A' }}


                    </h3>
                    <p><strong>Address:</strong>{{ $footerSetting ? $footerSetting->address : 'N/A' }}</p>
                    <p><strong>Phone:</strong> <a href="{{ 'tel:' . ($footerSetting ? $footerSetting->phone : '') }}"
                            class="text-secondary">{{ $footerSetting ? $footerSetting->phone : 'N/A' }}</a>
                    </p>
                    <p><strong>Email:</strong> <a
                            href="{{ 'mailto:' . ($footerSetting ? $footerSetting->email : '') }}"
                            class="text-secondary">{{ $footerSetting ? $footerSetting->email : 'N/A' }}</a></p>
                </div>
                <div class="contact-info-card flex-grow-1 d-flex flex-column">
                    <h3>Business Hours</h3>
                    <ul>
                        @if (
                            $contactInfo &&
                                isset($contactInfo->business_hours) &&
                                !empty($contactInfo->business_hours) &&
                                is_array($contactInfo->business_hours))
                            @foreach ($contactInfo->business_hours as $day => $hours)
                                <li><strong>{{ $day }}:</strong> {{ $hours }}</li>
                            @endforeach
                        @else
                            <li><strong>Monday - Friday:</strong> 9:00 AM - 6:00 PM</li>
                            <li><strong>Saturday:</strong> 9:00 AM - 2:00 PM</li>
                            <li><strong>Sunday:</strong> Closed</li>
                        @endif
                    </ul>
                    <h3>Follow Us</h3>
                    <div class="social-links">
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
            </div>
        </div>
    </div>
</section>
<style>
    /* =======================
   CONTACT SECTION STYLES
   ======================= */
    .contact-section {
        padding: 5rem 0;
        background: var(--light);
    }

    .contact-section h2 {
        font-size: 2.8rem;
        text-align: center;
        margin-bottom: 1.5rem;
    }

    .contact-section .lead {
        font-size: 1.2rem;
        color: var(--gray);
        max-width: 1000px;
        margin: 0 auto 3rem;
        text-align: center;
    }

    /* Contact Form */
    .contact-form {
        background: linear-gradient(135deg, var(--white), var(--light));
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 25px var(--shadow);
    }

    .contact-form .form-control {
        border: 1px solid var(--lighter);
        border-radius: 8px;
        padding: 0.7rem;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        transition: var(--transition);
    }

    .contact-form .form-control:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 6px rgba(0, 144, 212, 0.2);
        outline: none;
    }

    .contact-form .form-label {
        font-size: 0.95rem;
        font-weight: 500;
        color: var(--primary);
        margin-bottom: 0.4rem;
    }

    .contact-form .form-select {
        border: 1px solid var(--lighter);
        border-radius: 8px;
        padding: 0.7rem;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        transition: var(--transition);
    }

    .contact-form .form-select:focus {
        border-color: var(--secondary);
        box-shadow: 0 0 6px rgba(0, 144, 212, 0.2);
        outline: none;
    }

    .contact-form .form-check-label {
        font-size: 0.9rem;
        color: var(--gray);
    }

    .contact-form .form-check-input {
        border-color: var(--lighter);
        transition: var(--transition);
    }

    .contact-form .form-check-input:checked {
        background-color: var(--secondary);
        border-color: var(--secondary);
    }

    .contact-form .btn-primary-filled {
        width: 100%;
        max-width: 260px;
        margin: 1rem auto 0;
        display: block;
        padding: 0.6rem 2.5rem;
    }

    /* Contact Info Card */
    .contact-info-card {
        background: linear-gradient(135deg, var(--white), var(--light));
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 25px var(--shadow);
        text-align: justify;
    }

    .contact-info-card h3 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        position: relative;
        transition: var(--transition);
    }

    .contact-info-card h3:hover {
        color: var(--accent);
        transform: scale(1.03);
    }

    .contact-info-card h3::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--accent);
        transition: width 0.3s ease;
    }

    .contact-info-card h3:hover::after {
        width: 100%;
    }

    .contact-info-card p,
    .contact-info-card ul li {
        color: var(--gray);
        font-size: 1rem;
        margin-bottom: 0.7rem;
    }

    .contact-info-card .text-secondary {
        color: var(--secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .contact-info-card .text-secondary:hover,
    .contact-info-card .text-secondary:focus {
        color: var(--accent);
        text-decoration: none;
    }

    .contact-info-card ul {
        padding: 0;
        list-style: none;
    }

    .contact-info-card .social-links {
        display: flex;
        gap: 0.8rem;
    }

    .contact-info-card .social-links a {
        color: var(--white);
        font-size: 1rem;
        background: linear-gradient(90deg, var(--secondary), var(--accent));
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        text-decoration: none;
        transition: var(--transition);
    }

    .contact-info-card .social-links a:hover,
    .contact-info-card .social-links a:focus {
        background: linear-gradient(90deg, var(--accent), #00d4ff);
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 144, 212, 0.25);
        text-decoration: none;
    }

    /* =======================
   RESPONSIVE ADJUSTMENTS
   ======================= */
    @media (max-width: 991px) {
        .contact-section h2 {
            font-size: 2.5rem;
        }

        .contact-form {
            padding: 1.8rem;
        }

        .contact-info-card {
            padding: 1.8rem;
        }

        .contact-info-card h3 {
            font-size: 1.6rem;
        }

        .contact-form .btn-primary-filled {
            max-width: 240px;
            padding: 0.5rem 2rem;
            font-size: 0.95rem;
        }
    }

    @media (max-width: 767px) {
        .contact-section {
            padding: 4rem 0;
        }

        .contact-section h2 {
            font-size: 2.2rem;
        }

        .contact-section .lead {
            font-size: 1rem;
        }

        .contact-form {
            padding: 1.5rem;
        }

        .contact-form .form-label {
            font-size: 0.9rem;
        }

        .contact-form .form-control,
        .contact-form .form-select {
            font-size: 0.9rem;
            padding: 0.6rem;
        }

        .contact-form .form-check-label {
            font-size: 0.85rem;
        }

        .contact-form .btn-primary-filled {
            max-width: 220px;
            padding: 0.5rem 2rem;
            font-size: 0.9rem;
        }

        .contact-info-card {
            padding: 1.5rem;
        }

        .contact-info-card h3 {
            font-size: 1.5rem;
        }

        .contact-info-card p,
        .contact-info-card ul li {
            font-size: 0.9rem;
        }

        .contact-info-card .social-links a {
            width: 32px;
            height: 32px;
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .contact-section h2 {
            font-size: 1.8rem;
        }

        .contact-section .lead {
            font-size: 0.9rem;
        }

        .contact-form {
            padding: 1.2rem;
        }

        .contact-form .form-label {
            font-size: 0.85rem;
        }

        .contact-form .form-control,
        .contact-form .form-select {
            font-size: 0.85rem;
            padding: 0.5rem;
        }

        .contact-form .form-check-label {
            font-size: 0.8rem;
        }

        .contact-form .btn-primary-filled {
            max-width: 200px;
            padding: 0.4rem 1.5rem;
            font-size: 0.85rem;
        }

        .contact-info-card {
            padding: 1.2rem;
        }

        .contact-info-card h3 {
            font-size: 1.3rem;
        }

        .contact-info-card p,
        .contact-info-card ul li {
            font-size: 0.85rem;
        }

        .contact-info-card .social-links a {
            width: 30px;
            height: 30px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 400px) {
        .contact-section {
            padding: 3rem 0;
        }

        .contact-section h2 {
            font-size: 1.6rem;
        }

        .contact-section .lead {
            font-size: 0.85rem;
        }

        .contact-form {
            padding: 1rem;
        }

        .contact-form .form-label {
            font-size: 0.8rem;
        }

        .contact-form .form-control,
        .contact-form .form-select {
            font-size: 0.8rem;
            padding: 0.4rem;
        }

        .contact-form .form-check-label {
            font-size: 0.75rem;
        }

        .contact-form .btn-primary-filled {
            max-width: 180px;
            padding: 0.4rem 1.2rem;
            font-size: 0.8rem;
        }

        .contact-info-card {
            padding: 1rem;
        }

        .contact-info-card h3 {
            font-size: 1.2rem;
        }

        .contact-info-card p,
        .contact-info-card ul li {
            font-size: 0.8rem;
        }

        .contact-info-card .social-links a {
            width: 28px;
            height: 28px;
            font-size: 0.8rem;
        }
    }

    /* Validation Feedback Styles */
    .form-control.is-valid {
        border-color: #28a745;
        box-shadow: 0 0 0 0.2rem rgba(40, 167, 69, 0.15);
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.15);
    }

    .valid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #28a745;
    }

    .invalid-feedback {
        display: none;
        width: 100%;
        margin-top: 0.25rem;
        font-size: 0.875em;
        color: #dc3545;
    }

    .form-control.is-valid~.valid-feedback {
        display: block;
    }

    .form-control.is-invalid~.invalid-feedback {
        display: block;
    }

    /* Toast Notification Styles */
    .toast-container {
        z-index: 9999 !important;
    }

    .toast {
        min-width: 300px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        border-radius: 8px;
    }

    .toast-body {
        padding: 12px 16px;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .toast-body i {
        font-size: 1.1em;
    }

    .toast.bg-success {
        background: linear-gradient(135deg, #28a745, #20c997) !important;
    }

    .toast.bg-warning {
        background: linear-gradient(135deg, #ffc107, #fd7e14) !important;
        color: #212529 !important;
    }

    .toast.bg-danger {
        background: linear-gradient(135deg, #dc3545, #e74c3c) !important;
    }

    .toast .btn-close-white {
        filter: brightness(0) invert(1);
        opacity: 0.8;
    }

    .toast .btn-close-white:hover {
        opacity: 1;
    }

    /* Animation for toast */
    .toast.showing {
        animation: slideInRight 0.3s ease-out;
    }

    .toast.hide {
        animation: slideOutRight 0.3s ease-in;
    }

    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }

        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }

        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const contactForm = document.querySelector('.contact-form');
        const successToast = document.getElementById('success-toast');
        const emailInput = document.getElementById('email');
        const phoneInput = document.getElementById('phone');

        // Email validation function
        function validateEmail(email) {
            const emailRegex =
                /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
            return emailRegex.test(email);
        }

        // Phone validation function (supports multiple formats)
        function validatePhone(phone) {
            if (!phone.trim()) return true; // Phone is optional
            // Enhanced phone validation supporting various Nepal and international formats
            // Supports: +977-98XXXXXXXX, +977 98XXXXXXXX, 98XXXXXXXX, 977XXXXXXXXX, 01-XXXXXXX, etc.
            const phoneRegex = /^(\+?977[-\s]?)?(\d{2}[-\s]?\d{7,8}|\d{9,10}|01[-\s]?\d{6,7})$/;
            return phoneRegex.test(phone.replace(/\s+/g, ''));
        }

        // Real-time email validation
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const email = this.value.trim();
                const errorElement = document.getElementById('email-error');

                if (email === '') {
                    this.classList.remove('is-valid', 'is-invalid');
                    return;
                }

                if (validateEmail(email)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    errorElement.textContent =
                        'Please enter a valid email address (e.g., example@email.com)';
                }
            });

            emailInput.addEventListener('blur', function() {
                const email = this.value.trim();
                if (email && !validateEmail(email)) {
                    this.classList.add('is-invalid');
                    document.getElementById('email-error').textContent =
                        'Please enter a valid email address';
                }
            });
        }

        // Real-time phone validation
        if (phoneInput) {
            phoneInput.addEventListener('input', function() {
                const phone = this.value.trim();
                const errorElement = document.getElementById('phone-error');

                if (phone === '') {
                    this.classList.remove('is-valid', 'is-invalid');
                    return;
                }

                if (validatePhone(phone)) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                    errorElement.textContent =
                        'Please enter a valid phone number. Examples: +977-98XXXXXXXX, 98XXXXXXXX, or 01-XXXXXXX';
                }
            });

            phoneInput.addEventListener('blur', function() {
                const phone = this.value.trim();
                if (phone && !validatePhone(phone)) {
                    this.classList.add('is-invalid');
                    document.getElementById('phone-error').textContent =
                        'Please enter a valid phone number format (Nepal mobile, landline, or international)';
                }
            });
        }

        // Function to show toast
        function showSuccessToast(message, bgClass = 'bg-success') {
            const toastElement = document.getElementById('success-toast');
            const messageElement = document.getElementById('toast-message');

            // Update message and style
            messageElement.textContent = message;
            toastElement.className = `toast align-items-center text-white ${bgClass} border-0`;

            // Initialize and show toast
            const toast = new bootstrap.Toast(toastElement, {
                autohide: true,
                delay: 5000 // 5 seconds
            });

            toast.show();
        }

        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                let isValid = true;
                const submitButton = this.querySelector('button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;

                // Validate email
                const email = emailInput.value.trim();
                if (!validateEmail(email)) {
                    emailInput.classList.add('is-invalid');
                    document.getElementById('email-error').textContent =
                        'Please enter a valid email address';
                    isValid = false;
                } else {
                    emailInput.classList.remove('is-invalid');
                    emailInput.classList.add('is-valid');
                }

                // Validate phone (if provided)
                const phone = phoneInput.value.trim();
                if (phone && !validatePhone(phone)) {
                    phoneInput.classList.add('is-invalid');
                    document.getElementById('phone-error').textContent =
                        'Please enter a valid phone number format (Nepal mobile, landline, or international)';
                    isValid = false;
                } else if (phone) {
                    phoneInput.classList.remove('is-invalid');
                    phoneInput.classList.add('is-valid');
                }

                // If validation fails, prevent submission
                if (!isValid) {
                    e.preventDefault();
                    showSuccessToast('Please correct the errors in the form before submitting.',
                        'bg-warning');
                    return;
                }

                // Show loading state
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Sending...';
                submitButton.disabled = true;

                // Re-enable button after a delay (in case of redirect back)
                setTimeout(() => {
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                }, 3000);
            });
        }

        // Check for success message from server (for regular form submissions)
        @if (session('success'))
            showSuccessToast('{{ session('success') }}');
        @endif

        @if (session('error'))
            showSuccessToast('{{ session('error') }}', 'bg-danger');
        @endif

        // Check for Laravel validation errors and show them in toast
        @if ($errors->any())
            let errorMessages = [];
            @foreach ($errors->all() as $error)
                errorMessages.push('{{ $error }}');
            @endforeach

            // Show first error in toast, rest will be visible in form fields
            showSuccessToast(errorMessages[0], 'bg-danger');

            // If there are multiple errors, show a summary after a delay
            if (errorMessages.length > 1) {
                setTimeout(() => {
                    showSuccessToast(
                        `Please check ${errorMessages.length} validation errors in the form.`,
                        'bg-warning');
                }, 3000);
            }
        @endif

        // Show toast if form was submitted (check URL parameters)
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('submitted') === 'true') {
            showSuccessToast('Message sent successfully! We\'ll get back to you within 24 hours.');
            // Remove the parameter from URL
            urlParams.delete('submitted');
            const newUrl = window.location.pathname + (urlParams.toString() ? '?' + urlParams.toString() : '');
            window.history.replaceState({}, '', newUrl);
        }
    });
</script>
