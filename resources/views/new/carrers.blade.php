@extends('new.layouts.sidebar')

@push('seo')
    {!! \App\Helpers\SeoHelper::meta('Careers at Roshan Kumar & Associates', 'Explore job openings, career opportunities, and why Roshan Kumar & Associates is a great place to grow your professional career.', 'careers, accounting vacancies, jobs in Nepal, audit career, employment') !!}
@endpush

@section('styles')
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts: Inter & Lora -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lora:wght@500;600;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/carrers.css') }}">
@endsection

@section('content')
    <div class="rka-scope" id="main-content">
        <main>
            <!-- Hero Section -->
            @if ($jumbotrons->isNotEmpty())
                @foreach ($jumbotrons as $jumbotron)
                    <section class="hero-section"
                        style="background-image: url('{{ $jumbotron->background_image_url }}'); background-position: center; background-size: cover;">
                        <div class="hero-content gsap-animate">
                            <h1>{{ $jumbotron->title }}</h1>
                            <p>{{ $jumbotron->subtitle }}</p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ $jumbotron->button_link }}" class="btn-primary-filled"><i
                                        class="fas fa-briefcase"></i> {{ $jumbotron->button_text }}</a>
                                <a href="/contact" class="btn-primary-outline"><i class="fas fa-envelope"></i> Contact
                                    HR</a>
                            </div>
                        </div>
                    </section>
                @endforeach
            @endif

            <!-- Why Choose Section -->
            <section class="why-choose-section">
                <div class="section-container">
                    <h2 class="gsap-animate">Why Choose Chartered Insights?</h2>
                    <p class="lead gsap-animate">We believe our people are our greatest asset. That's why we invest in
                        creating an environment where talent thrives and careers flourish.</p>
                    <div class="row g-4">
                        @foreach ($carrer_benefits as $index => $benefit)
                            <div class="col-lg-4 col-md-6 gsap-animate" data-delay="{{ $index * 0.2 }}">
                                <div class="benefit-card">
                                    <div class="benefit-icon-wrapper">
                                        <div class="benefit-icon">
                                            {!! $benefit->icon !!}
                                        </div>
                                    </div>
                                    <div class="benefit-content">
                                        <h3>{{ $benefit->title }}</h3>
                                        <p>{{ $benefit->description }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            <!-- Current Openings Section -->
            <section class="openings-section" id="openings">
                <div class="section-container">
                    <h2 class="gsap-animate">Current Openings</h2>
                    <p class="lead gsap-animate">Explore exciting career opportunities across our various departments and
                        locations.</p>
                    <ul class="nav nav-tabs mb-4" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab"
                                aria-controls="all" aria-selected="true">All Positions</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="audit-tab" data-bs-toggle="tab" href="#audit" role="tab"
                                aria-controls="audit" aria-selected="false">Audit & Assurance</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="tax-tab" data-bs-toggle="tab" href="#tax" role="tab"
                                aria-controls="tax" aria-selected="false">Tax Advisory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="business-tab" data-bs-toggle="tab" href="#business" role="tab"
                                aria-controls="business" aria-selected="false">Business Advisory</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="support-tab" data-bs-toggle="tab" href="#support" role="tab"
                                aria-controls="support" aria-selected="false">Support & Admin</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                            <div class="job-list">
                                @foreach ($job_openings as $index => $job)
                                    <div class="job-banner gsap-animate" data-department="{{ $job->category }}">
                                        <div class="job-info">
                                            <h3>{{ $job->title }}</h3>
                                            @if ($job->is_featured == 1)
                                                <p class="featured">Featured</p>
                                            @endif
                                            <p>{{ $job->category }}</p>
                                            <p>{{ $job->location }}</p>
                                            <p>{{ $job->job_type }}</p>

                                        </div>
                                        <div class="btn-container">
                                            <button class="btn-primary-outline" data-bs-toggle="collapse"
                                                data-bs-target="#s{{ $job->id }}" aria-expanded="false"
                                                aria-controls="senior-auditor-details">View Details</button>
                                            <button class="btn-primary-filled apply-btn" data-bs-toggle="modal"
                                                data-bs-target="#applyModal" data-job-id="{{ $job->id }}"
                                                data-job-title="{{ $job->title }}"
                                                data-job-department="{{ $job->category }}"
                                                data-job-location="{{ $job->location }}"
                                                data-job-type="{{ $job->job_type }}"
                                                data-job-salary-min="{{ $job->salary_min }}"
                                                data-job-salary-max="{{ $job->salary_max ?? 'N/A' }}">Apply Now</button>
                                        </div>
                                    </div>
                                    <div class="collapse" id="s{{ $job->id }}">

                                        <div class="job-details">
                                            <h4>Position Overview</h4>
                                            <p>{{ $job->overview }}</p>
                                            <h4>Key Responsibilities</h4>
                                            @foreach (explode("\n", trim($job->responsibilities)) as $item)
                                                @if (!empty(trim($item)))
                                                    <li>{{ trim($item) }}</li>
                                                @endif
                                            @endforeach
                                            <h4>Requirements</h4>
                                            <ul>
                                                @foreach (explode("\n", trim($job->requirements)) as $item)
                                                    @if (!empty(trim($item)))
                                                        <li>{{ trim($item) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <h4>What We Offer</h4>
                                            <ul>
                                                @foreach (explode("\n", trim($job->benefits)) as $item)
                                                    @if (!empty(trim($item)))
                                                        <li>{{ trim($item) }}</li>
                                                    @endif
                                                @endforeach
                                            </ul>
                                            <h4>Compensation</h4>
                                            <p>NPR {{ $job->salary_min }} - {{ $job->salary_max }}</p>
                                            <h4>Application Deadline</h4>
                                            <p>{{ $job->application_deadline }}</p>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- <div class="job-banner gsap-animate" data-department="business">
                                    <div class="job-info">
                                        <h3>Business Analyst</h3>
                                        <p class="featured">Featured</p>
                                        <p>Business Advisory</p>
                                        <p>Kathmandu</p>
                                        <p>Full-time</p>
                                    </div>
                                    <div class="btn-container">
                                        <button class="btn-primary-outline" data-bs-toggle="collapse" data-bs-target="#business-analyst-details" aria-expanded="false" aria-controls="business-analyst-details">View Details</button>
                                        <button class="btn-primary-filled" data-bs-toggle="modal" data-bs-target="#apply-business-analyst">Apply Now</button>
                                    </div>
                                </div>
                                <div class="collapse" id="business-analyst-details">
                                    <div class="job-details">
                                        <h4>Position Overview</h4>
                                        <p>We are looking for a skilled Business Analyst to support our advisory team in delivering strategic insights and solutions to clients.</p>
                                        <h4>Key Responsibilities</h4>
                                        <ul>
                                            <li>Analyze client business processes and identify improvement opportunities</li>
                                            <li>Develop data-driven recommendations and reports</li>
                                            <li>Collaborate with cross-functional teams to implement solutions</li>
                                            <li>Facilitate client workshops and presentations</li>
                                        </ul>
                                        <h4>Requirements</h4>
                                        <ul>
                                            <li>Bachelor’s degree in Business, Finance, or related field</li>
                                            <li>2-4 years of business analysis experience</li>
                                            <li>Strong analytical and problem-solving skills</li>
                                            <li>Excellent communication and presentation skills</li>
                                        </ul>
                                        <h4>What We Offer</h4>
                                        <ul>
                                            <li>Competitive salary package</li>
                                            <li>Professional development opportunities</li>
                                            <li>Health and life insurance</li>
                                            <li>Flexible working arrangements</li>
                                        </ul>
                                        <h4>Compensation</h4>
                                        <p>NPR 60,000 - 90,000</p>
                                        <h4>Application Deadline</h4>
                                        <p>October 15, 2025</p>
                                    </div>
                                </div>
                                <div class="job-banner gsap-animate" data-department="tax">
                                    <div class="job-info">
                                        <h3>Tax Consultant</h3>
                                        <p>Tax Advisory</p>
                                        <p>Pokhara</p>
                                        <p>Full-time</p>
                                    </div>
                                    <div class="btn-container">
                                        <button class="btn-primary-outline" data-bs-toggle="collapse" data-bs-target="#tax-consultant-details" aria-expanded="false" aria-controls="tax-consultant-details">View Details</button>
                                        <button class="btn-primary-filled" data-bs-toggle="modal" data-bs-target="#apply-tax-consultant">Apply Now</button>
                                    </div>
                                </div>
                                <div class="collapse" id="tax-consultant-details">
                                    <div class="job-details">
                                        <h4>Position Overview</h4>
                                        <p>Join our Tax Advisory team to provide expert tax planning and compliance services to our clients.</p>
                                        <h4>Key Responsibilities</h4>
                                        <ul>
                                            <li>Prepare and review tax returns</li>
                                            <li>Provide tax planning and advisory services</li>
                                            <li>Stay updated with tax laws and regulations</li>
                                            <li>Assist clients with tax audits and inquiries</li>
                                        </ul>
                                        <h4>Requirements</h4>
                                        <ul>
                                            <li>Bachelor’s degree in Accounting or Finance</li>
                                            <li>2-3 years of tax-related experience</li>
                                            <li>Knowledge of local tax regulations</li>
                                            <li>Strong analytical skills</li>
                                        </ul>
                                        <h4>What We Offer</h4>
                                        <ul>
                                            <li>Competitive salary package</li>
                                            <li>Professional development opportunities</li>
                                            <li>Health and life insurance</li>
                                            <li>Flexible working arrangements</li>
                                        </ul>
                                        <h4>Compensation</h4>
                                        <p>NPR 50,000 - 80,000</p>
                                        <h4>Application Deadline</h4>
                                        <p>October 10, 2025</p>
                                    </div>
                                </div>
                                <div class="job-banner gsap-animate hidden-job" data-department="audit">
                                    <div class="job-info">
                                        <h3>Junior Accountant</h3>
                                        <p>Audit & Assurance</p>
                                        <p>Chitwan</p>
                                        <p>Full-time</p>
                                    </div>
                                    <div class="btn-container">
                                        <button class="btn-primary-outline" data-bs-toggle="collapse" data-bs-target="#junior-accountant-details" aria-expanded="false" aria-controls="junior-accountant-details">View Details</button>
                                        <button class="btn-primary-filled" data-bs-toggle="modal" data-bs-target="#apply-junior-accountant">Apply Now</button>
                                    </div>
                                </div>
                                <div class="collapse" id="junior-accountant-details">
                                    <div class="job-details">
                                        <h4>Position Overview</h4>
                                        <p>We are seeking a Junior Accountant to support our audit team with financial reporting and compliance tasks.</p>
                                        <h4>Key Responsibilities</h4>
                                        <ul>
                                            <li>Assist in preparing financial statements</li>
                                            <li>Support audit engagements</li>
                                            <li>Maintain accurate financial records</li>
                                            <li>Collaborate with senior auditors</li>
                                        </ul>
                                        <h4>Requirements</h4>
                                        <ul>
                                            <li>Bachelor’s degree in Accounting</li>
                                            <li>0-2 years of experience</li>
                                            <li>Basic knowledge of accounting principles</li>
                                            <li>Proficiency in MS Office</li>
                                        </ul>
                                        <h4>What We Offer</h4>
                                        <ul>
                                            <li>Competitive salary package</li>
                                            <li>Professional development opportunities</li>
                                            <li>Health and life insurance</li>
                                            <li>Flexible working arrangements</li>
                                        </ul>
                                        <h4>Compensation</h4>
                                        <p>NPR 40,000 - 60,000</p>
                                        <h4>Application Deadline</h4>
                                        <p>October 20, 2025</p>
                                    </div>
                                </div>
                                <div class="job-banner gsap-animate hidden-job" data-department="support">
                                    <div class="job-info">
                                        <h3>IT Support Specialist</h3>
                                        <p>Support & Admin</p>
                                        <p>Kathmandu</p>
                                        <p>Full-time</p>
                                    </div>
                                    <div class="btn-container">
                                        <button class="btn-primary-outline" data-bs-toggle="collapse" data-bs-target="#it-support-details" aria-expanded="false" aria-controls="it-support-details">View Details</button>
                                        <button class="btn-primary-filled" data-bs-toggle="modal" data-bs-target="#apply-it-support">Apply Now</button>
                                    </div>
                                </div>
                                <div class="collapse" id="it-support-details">
                                    <div class="job-details">
                                        <h4>Position Overview</h4>
                                        <p>Join our IT team to provide technical support and maintain our technology infrastructure.</p>
                                        <h4>Key Responsibilities</h4>
                                        <ul>
                                            <li>Provide technical support to staff</li>
                                            <li>Maintain IT systems and networks</li>
                                            <li>Troubleshoot hardware and software issues</li>
                                            <li>Assist in IT projects</li>
                                        </ul>
                                        <h4>Requirements</h4>
                                        <ul>
                                            <li>Bachelor’s degree in IT or related field</li>
                                            <li>1-3 years of IT support experience</li>
                                            <li>Knowledge of network administration</li>
                                            <li>Strong problem-solving skills</li>
                                        </ul>
                                        <h4>What We Offer</h4>
                                        <ul>
                                            <li>Competitive salary package</li>
                                            <li>Professional development opportunities</li>
                                            <li>Health and life insurance</li>
                                            <li>Flexible working arrangements</li>
                                        </ul>
                                        <h4>Compensation</h4>
                                        <p>NPR 50,000 - 70,000</p>
                                        <h4>Application Deadline</h4>
                                        <p>October 5, 2025</p>
                                    </div>
                                </div>
                            </div>
                            <div class="view-more-container gsap-animate">
                                <button class="btn-primary-filled" id="view-more-btn">View More</button>
                            </div>
                            <div class="text-center mt-4 gsap-animate">
                                <a href="#apply-general" class="btn-primary-filled">Submit General Application</a>
                            </div> --}}
                            </div>
                            <div class="tab-pane fade" id="audit" role="tabpanel" aria-labelledby="audit-tab">
                                <div class="job-list">
                                    @foreach ($job_openings as $index => $job)
                                        @if ($job->category == 'audit')
                                            <div class="job-banner gsap-animate" data-department="{{ $job->category }}">
                                                <div class="job-info">
                                                    <h3>{{ $job->title }}</h3>
                                                    @if ($job->is_featured == 1)
                                                        <p class="featured">Featured</p>
                                                    @endif
                                                    <p>{{ $job->category }}</p>
                                                    <p>{{ $job->location }}</p>
                                                    <p>{{ $job->job_type }}</p>

                                                </div>
                                                <div class="btn-container">
                                                    <button class="btn-primary-outline" data-bs-toggle="collapse"
                                                        data-bs-target="#s{{ $job->id }}" aria-expanded="false"
                                                        aria-controls="senior-auditor-details">View Details</button>
                                                    <button class="btn-primary-filled apply-btn" data-bs-toggle="modal"
                                                        data-bs-target="#applyModal" data-job-id="{{ $job->id }}"
                                                        data-job-title="{{ $job->title }}"
                                                        data-job-department="{{ $job->category }}"
                                                        data-job-location="{{ $job->location }}"
                                                        data-job-type="{{ $job->job_type }}"
                                                        data-job-salary-min="{{ $job->salary_min }}"
                                                        data-job-salary-max="{{ $job->salary_max ?? 'N/A' }}">Apply
                                                        Now</button>
                                                </div>
                                            </div>
                                            <div class="collapse" id="s{{ $job->id }}">

                                                <div class="job-details">
                                                    <h4>Position Overview</h4>
                                                    <p>{{ $job->overview }}</p>
                                                    <h4>Key Responsibilities</h4>
                                                    @foreach (explode("\n", trim($job->responsibilities)) as $item)
                                                        @if (!empty(trim($item)))
                                                            <li>{{ trim($item) }}</li>
                                                        @endif
                                                    @endforeach
                                                    <h4>Requirements</h4>
                                                    <ul>
                                                        @foreach (explode("\n", trim($job->requirements)) as $item)
                                                            @if (!empty(trim($item)))
                                                                <li>{{ trim($item) }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <h4>What We Offer</h4>
                                                    <ul>
                                                        @foreach (explode("\n", trim($job->benefits)) as $item)
                                                            @if (!empty(trim($item)))
                                                                <li>{{ trim($item) }}</li>
                                                            @endif
                                                        @endforeach
                                                    </ul>
                                                    <h4>Compensation</h4>
                                                    <p>NPR {{ $job->salary_min }} - {{ $job->salary_max }}</p>
                                                    <h4>Application Deadline</h4>
                                                    <p>{{ $job->application_deadline }}</p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                </div>
                            </div>
                            <div class="tab-pane fade" id="tax" role="tabpanel" aria-labelledby="tax-tab"></div>
                            <div class="tab-pane fade" id="business" role="tabpanel" aria-labelledby="business-tab">
                            </div>
                            <div class="tab-pane fade" id="support" role="tabpanel" aria-labelledby="support-tab">
                            </div>
                        </div>
                    </div>
            </section>

            <!-- Testimonials Section -->
            <section class="testimonials-section">
                <div class="section-container">
                    <h2 class="gsap-animate">What Our Team Says</h2>
                    <p class="lead gsap-animate">Hear from our team members about their experience working at Chartered
                        Insights.</p>
                    <div class="row g-4">
                        @foreach ($carrer_testimonials as $index => $data)
                            <div class="col-lg-4 col-md-6 gsap-animate" data-delay="{{ $index * 0.2 }}">
                                <div class="testimonial-card">
                                    <p>{{ $data->testimonial }}</p>
                                    <h4>{{ $data->employee_name }}</h4>
                                    <p class="role">{{ $data->position }}, {{ $data->years_with_company }} years with
                                        company</p>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>

            <!-- HR Contact Section -->
            <section class="hr-contact-section" id="hr-contact">
                <div class="section-container">
                    <h2 class="gsap-animate">Questions About Career Opportunities?</h2>
                    <p class="lead gsap-animate">Our HR team is here to help answer your questions about career
                        opportunities, application process, and what it's like to work at Chartered Insights.</p>
                    <div class="row g-4">
                        <div class="col-12 gsap-animate">
                            <div class="hr-contact-card">
                                <h3>HR Department</h3>
                                <p><strong>Email:</strong> <a href="mailto:careers@charteredinsights.com"
                                        class="text-secondary">careers@charteredinsights.com</a></p>
                                <p><strong>Phone:</strong> <a href="tel:+97714234567"
                                        class="text-secondary">+977-1-4234567 (Ext. 101)</a></p>
                                <h3>Office Hours</h3>
                                <ul>
                                    <li><strong>Sunday - Friday:</strong> 9:00 AM - 6:00 PM</li>
                                    <li><strong>Saturday:</strong> 10:00 AM - 4:00 PM</li>
                                </ul>
                                <div class="d-flex flex-wrap gap-3 justify-content-center">
                                    <a href="#apply-general" class="btn-primary-filled"><i class="fas fa-envelope"></i>
                                        Contact HR Team</a>
                                    <a href="https://linkedin.com/company/charteredinsights" target="_blank"
                                        class="btn-primary-outline"><i class="fab fa-linkedin-in"></i> Follow Us on
                                        LinkedIn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Application Modals -->
            <!-- Senior Auditor Modal -->
            <div class="modal fade" id="applyModal" tabindex="-1" aria-labelledby="applyModallabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="applyModallabel">Apply for position</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Department:</strong><span id="modalJobDepartment"></span></p>
                            <p><strong>Location:</strong><span id="modalJobLocation"></span></p>
                            <p><strong>Type:</strong><span id="modalJobType"></span></p>
                            <p><strong>Salary:</strong> NPR<span id="modalJobMin"></span>-<span id="modalJobMax"></span>
                            </p>
                            <p class="mb-4">We're excited to learn more about you! Please fill out the form below and
                                we'll review your application carefully.</p>
                            <form action="{{ route('application.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" id="modalJobId" name="job_id">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="first-name" class="form-label">First Name *</label>
                                        <input type="text" class="form-control" id="first-name" name="first_name"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="last-name" class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" id="last-name" name="last_name"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email Address *</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                            required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number *</label>
                                        <input type="tel" class="form-control" id="phone" name="phone"
                                            required>
                                    </div>
                                    <div class="col-12">
                                        <label for="resume" class="form-label">Resume/CV *</label>
                                        <input type="file" class="form-control" id="resume" name="resume"
                                            accept=".pdf,.doc,.docx" required>
                                        <small class="text-muted">Accepted formats: PDF, DOC, DOCX (Max: 5MB)</small>

                                    </div>
                                    <div class="col-12">
                                        <label for="cover-letter" class="form-label">Cover Letter</label>
                                        <textarea class="form-control" id="cover-letter" rows="5" name="cover_letter"
                                            placeholder="Tell us why you're interested in this position and what makes you a great fit..."></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="portfolio" class="form-label">Portfolio URL</label>
                                        <input type="url" class="form-control" id="portfolio" name="portfolio"
                                            placeholder="https://your-portfolio.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="linkedin" class="form-label">LinkedIn Profile</label>
                                        <input type="url" class="form-control" id="linkedin" name="linkedin"
                                            placeholder="https://linkedin.com/in/yourprofile">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="salary" class="form-label">Expected Salary (NPR)</label>
                                        <input type="number" class="form-control" id="salary" name="expected_salary"
                                            placeholder="e.g., 60000">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="start-date" class="form-label">Available Start Date</label>
                                        <input type="date" class="form-control" id="start-date" name="start_date">
                                    </div>
                                    <div class="col-12 text-center">
                                        <button type="submit" class="btn-primary-filled"><i
                                                class="fas fa-paper-plane"></i> Submit Application</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Other modals would follow similar structure -->
        </main>
    </div>
    @include('new.layouts.contactusform')
@endsection

@section('scripts')
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        function updateViewMoreButton(contanier, button) {
            if (!button) return;
            const hiddenJobs = contanier.querySelectorAll('.job-banner.hidden-job');
            button.style.display = hiddenJobs.length ? 'block' : 'none';
        }

        // Tab Filtering
        document.addEventListener('DOMContentLoaded', function() {
            const jobBanners = document.querySelectorAll('.job-banner');
            const jobDetails = document.querySelectorAll('.collapse');
            const allTabPane = document.querySelector('#all .job-list');
            const viewMoreBtn = document.querySelector('#view-more-btn');

            // Initialize "All Positions" tab
            updateViewMoreButton(allTabPane, viewMoreBtn);

            // Tab click handler
            document.querySelectorAll('.nav-tabs .nav-link').forEach(tab => {
                tab.addEventListener('click', function() {
                    const department = this.getAttribute('href').substring(1);
                    const targetPane = document.querySelector(`#${department}`);
                    const container = document.createElement('div');
                    container.className = 'job-list';
                    let visibleCount = 0;

                    // Clear all tab panes
                    document.querySelectorAll('.tab-pane').forEach(pane => {

                        pane.classList.remove('show', 'active');
                    });

                    // Populate target pane
                    jobBanners.forEach((banner, index) => {
                        const bannerDepartment = banner.getAttribute('data-department');
                        if (department === 'all' || bannerDepartment === department) {
                            const bannerClone = banner.cloneNode(true);
                            if (department === 'all' && visibleCount >= 3 && !banner
                                .classList.contains('hidden-job')) {
                                bannerClone.classList.add('hidden-job');
                            } else if (department !== 'all' && visibleCount >= 3) {
                                bannerClone.classList.add('hidden-job');
                            }
                            container.appendChild(bannerClone);
                            visibleCount++;

                            // Append corresponding job details
                            const detailsId = bannerClone.querySelector(
                                '[data-bs-toggle="collapse"]').getAttribute(
                                'data-bs-target').substring(1);
                            const detailsClone = jobDetails[index].cloneNode(true);
                            container.appendChild(detailsClone);
                        }
                    });

                    // Add View More button if needed
                    if (visibleCount > 3) {
                        const viewMoreDiv = document.createElement('div');
                        viewMoreDiv.className = 'view-more-container gsap-animate';
                        viewMoreDiv.innerHTML =
                            '<button class="btn-primary-filled" onclick="toggleViewMore(this)">View More</button>';
                        container.appendChild(viewMoreDiv);
                    }

                    // Add general application button
                    const generalAppDiv = document.createElement('div');
                    generalAppDiv.className = 'text-center mt-4 gsap-animate';
                    generalAppDiv.innerHTML =
                        '<a href="#apply-general" class="btn-primary-filled">Submit General Application</a>';
                    container.appendChild(generalAppDiv);

                    targetPane.appendChild(container);
                    targetPane.classList.add('show', 'active');

                    // Reapply GSAP animations for visible jobs
                    gsap.utils.toArray(container.querySelectorAll('.job-banner:not(.hidden-job)'))
                        .forEach((el, i) => {
                            gsap.fromTo(el, {
                                opacity: 0,
                                y: 20
                            }, {
                                opacity: 1,
                                y: 0,
                                duration: 0.8,
                                delay: i * 0.1,
                                ease: 'power3.out'
                            });
                        });

                    // Update View More button state
                    const newViewMoreBtn = container.querySelector(
                        '.view-more-container .btn-primary-filled');
                    if (newViewMoreBtn) {
                        updateViewMoreButton(container, newViewMoreBtn);
                    }
                });
            });

            // View More/View Less Toggle
            window.toggleViewMore = function(button) {
                const jobList = button.closest('.job-list');
                const hiddenJobs = jobList.querySelectorAll('.job-banner.hidden-job');
                const hiddenDetails = jobList.querySelectorAll('.job-banner.hidden-job + .collapse');
                const isShowingMore = button.textContent === 'View More';

                hiddenJobs.forEach((job, index) => {
                    job.classList.toggle('hidden-job', !isShowingMore);
                    // Ensure corresponding details remain linked
                    if (isShowingMore) {
                        hiddenDetails[index].style.display = 'block';
                        setTimeout(() => {
                            hiddenDetails[index].style.display = '';
                        }, 0);
                    }
                });

                button.textContent = isShowingMore ? 'View Less' : 'View More';

                // Reapply GSAP animations for newly visible jobs
                gsap.utils.toArray(jobList.querySelectorAll('.job-banner:not(.hidden-job)')).forEach((el,
                    i) => {
                    gsap.fromTo(el, {
                        opacity: 0,
                        y: 20
                    }, {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        delay: i * 0.1,
                        ease: 'power3.out'
                    });
                });
            };

            // Update View More button visibility
            function updateViewMoreButton(jobList, viewMoreBtn) {
                const hiddenJobs = jobList.querySelectorAll('.job-banner.hidden-job');
                if (hiddenJobs.length === 0) {
                    viewMoreBtn.closest('.view-more-container').style.display = 'none';
                } else {
                    viewMoreBtn.closest('.view-more-container').style.display = '';
                }
            }
        });
        $(document).ready(function() {
            $(document).on('click', '.apply-btn', function() {
                const jobTitle = $(this).data('job-title');
                const jobDepartment = $(this).data('job-department');
                const jobLocation = $(this).data('job-location');
                const jobType = $(this).data('job-type');
                const jobSalaryMin = $(this).data('job-salary-min');
                const jobSalaryMax = $(this).data('job-salary-max');
                const jobId = $(this).data('job-id');
                console.log('Button clicked:', {
                    jobTitle,
                    jobDepartment,
                    jobLocation,
                    jobType,
                    jobSalaryMin,
                    jobSalaryMax,
                    jobId
                });
                // Update modal content
                $('#applyModalLabel').text('Apply for ' + jobTitle);
                $('#modalJobDepartment').text('' + jobDepartment);
                $('#modalJobLocation').text('' + jobLocation);
                $('#modalJobType').text('' + jobType);
                $('#modalJobMin').text(jobSalaryMin);
                $('#modalJobMax').text(jobSalaryMax);

                // Optional: hidden input for job ID
                if ($('#modalJobId').length === 0) {
                    $('<input>').attr({
                        type: 'hidden',
                        id: 'modalJobId',
                        name: 'job_id',
                        value: jobId
                    }).appendTo('#applyModal form');
                } else {
                    $('#modalJobId').val(jobId);
                }
            });
        });
        // Handle the actual button click for view/hide details
        $(document).on('click', '.btn-primary-outline', function(e) {
            e.preventDefault();
            const button = $(this);
            const targetId = button.attr('data-bs-target');
            const collapseElement = $(targetId);

            // Manually toggle the collapse
            if (collapseElement.hasClass('show')) {
                collapseElement.collapse('hide');
            } else {
                collapseElement.collapse('show');
            }
        });

        // When collapse is shown (details are revealed)
        // $(document).on('shown.bs.collapse', '.collapse', function() {
        //     const collapseId = $(this).attr('id');
        //     const button = $(`[data-bs-target="#${collapseId}"]`);
        //     button.text('Hide Details');
        // });

        // // When collapse is hidden (details are hidden)
        // $(document).on('hidden.bs.collapse', '.collapse', function() {
        //     const collapseId = $(this).attr('id');
        //     const button = $(`[data-bs-target="#${collapseId}"]`);
        //     button.text('View Details');
        // });
    </script>
@endsection
