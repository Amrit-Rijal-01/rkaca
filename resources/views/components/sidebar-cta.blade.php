@once
    @push('styles')
        <style>
            .sidebar-cta-wrapper {
                display: flex;
                flex-direction: column;
                gap: 0;
                height: 100%;
            }

            .sidebar-cta-card {
                border-radius: 18px;
                overflow: hidden;
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.12);
                position: sticky;
                top: 100px;
                z-index: 10;
            }

            .sidebar-cta-top {
                background: linear-gradient(150deg, var(--primary), #00517a 60%, var(--secondary));
                padding: 1.75rem 1.5rem;
                text-align: center;
            }

            .sidebar-cta-top h5 {
                font-family: 'Lora', serif;
                font-size: 1.1rem;
                font-weight: 700;
                color: #fff;
                margin: 0 0 0.5rem;
            }

            .sidebar-cta-top p {
                font-size: 0.84rem;
                color: rgba(255, 255, 255, 0.78);
                margin: 0 0 1.2rem;
                line-height: 1.55;
            }

            .sidebar-cta-btn {
                display: block;
                background: #fff;
                color: var(--primary);
                font-weight: 700;
                font-size: 0.875rem;
                padding: 0.65rem 1.25rem;
                border-radius: 50px;
                text-decoration: none;
                transition: var(--transition);
                margin-bottom: 0.75rem;
            }

            .sidebar-cta-btn:hover {
                background: var(--accent);
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
            }

            .sidebar-cta-divider {
                height: 1px;
                background: rgba(255, 255, 255, 0.15);
            }

            .sidebar-cta-bottom {
                background: #fff;
                padding: 1.4rem 1.5rem;
                text-align: center;
            }

            .sidebar-cta-bottom h6 {
                font-family: 'Lora', serif;
                font-size: 0.92rem;
                font-weight: 700;
                color: var(--primary);
                margin: 0 0 0.45rem;
            }

            .sidebar-cta-bottom h6 i {
                color: var(--secondary);
            }

            .sidebar-cta-bottom p {
                font-size: 0.82rem;
                color: var(--gray);
                margin: 0 0 1rem;
                line-height: 1.55;
            }

            .sidebar-cta-schedule {
                display: block;
                width: 100%;
                text-align: center;
                background: var(--primary);
                color: #fff;
                font-weight: 700;
                font-size: 0.82rem;
                padding: 0.55rem 1rem;
                border-radius: 50px;
                text-decoration: none;
                transition: var(--transition);
            }

            .sidebar-cta-schedule:hover {
                background: var(--secondary);
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            }

            .sidebar-back-link {
                display: inline-flex;
                align-items: center;
                gap: 0.4rem;
                font-size: 0.8rem;
                color: rgba(255, 255, 255, 0.7);
                text-decoration: none;
                transition: color 0.2s;
            }

            .sidebar-back-link:hover {
                color: #fff;
            }

            .sd-content-card {
                background: #fff;
                border-radius: 20px;
                box-shadow: 0 8px 40px rgba(0, 0, 0, 0.08);
                padding: 2.5rem 2.75rem;
                min-width: 0;
            }

            @media (max-width: 576px) {
                .sd-content-card {
                    padding: 1.5rem;
                }
            }
        </style>
    @endpush
@endonce

<aside class="sidebar-cta-wrapper">
    <div class="sidebar-cta-card gsap-animate" data-delay="0.1">
        <div class="sidebar-cta-top">
            <h5>Ready to Get Started?</h5>
            <p>Let's discuss how we can tailor this service to your specific needs.</p>
            <a href="/contact" class="sidebar-cta-btn">
                <i class="fas fa-paper-plane me-1"></i> Contact Us
            </a>
            <a href="{{ $backRoute ?? url('/services') }}" class="sidebar-back-link">
                <i class="fas fa-arrow-left"></i> {{ $backLabel ?? 'All Services' }}
            </a>
        </div>

        <div class="sidebar-cta-divider"></div>

        <div class="sidebar-cta-bottom">
            <h6><i class="fas fa-calendar-check me-2"></i>Book a Consultation</h6>
            <p>Speak directly with our experts for a personalised assessment.</p>
            <a href="/consultation" class="sidebar-cta-schedule">
                <i class="fas fa-calendar me-1"></i> Schedule Now
            </a>
        </div>
    </div>
</aside>
