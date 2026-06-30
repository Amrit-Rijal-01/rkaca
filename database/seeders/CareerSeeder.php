<?php

namespace Database\Seeders;

use App\Models\CareerBenefit;
use App\Models\CareerTestimonial;
use App\Models\JobOpening;
use Illuminate\Database\Seeder;

class CareerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Career Benefits
        $benefits = [
            [
                'title' => 'Professional Growth',
                'description' => 'Continuous learning opportunities, professional certifications, and clear career progression paths to help you reach your potential.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Collaborative Culture',
                'description' => 'Work with diverse, talented teams in an inclusive environment that values collaboration, innovation, and mutual respect.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Comprehensive Benefits',
                'description' => 'Competitive compensation, health insurance, retirement plans, and additional perks that support your well-being and financial security.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Learning & Development',
                'description' => 'Access to training programs, workshops, conferences, and certification support to keep your skills current and competitive.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Work-Life Balance',
                'description' => 'Flexible working arrangements, paid time off, and a supportive environment that recognizes the importance of personal well-being.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Innovation Focus',
                'description' => 'Be part of a forward-thinking organization that embraces technology and innovation to deliver exceptional client service.',
                'icon' => '<svg class="w-8 h-8 text-crisp-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z" /></svg>',
                'color_class' => 'bg-fresh-teal',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($benefits as $benefit) {
            CareerBenefit::create($benefit);
        }

        // Seed Job Openings
        $jobs = [
            [
                'title' => 'Senior Auditor',
                'department' => 'Audit & Assurance',
                'location' => 'Kathmandu',
                'job_type' => 'full-time',
                'overview' => 'We are seeking an experienced Senior Auditor to join our audit team. The successful candidate will lead audit engagements, supervise junior staff, and ensure high-quality service delivery to our clients.',
                'responsibilities' => "Plan and execute audit engagements for various client types and sizes\nSupervise and mentor junior audit staff\nReview audit working papers and ensure quality standards\nInteract with clients and address audit-related queries\nPrepare comprehensive audit reports and management letters\nStay updated with auditing standards and regulations",
                'requirements' => "Bachelor's degree in Accounting, Finance, or related field\nMinimum 3-5 years of audit experience\nProfessional certification (CA, ACCA, CPA) preferred\nStrong analytical and problem-solving skills\nExcellent communication and leadership abilities\nProficiency in audit software and MS Office",
                'benefits' => "Competitive salary package\nPerformance-based bonuses\nProfessional development opportunities\nHealth and life insurance\nFlexible working arrangements",
                'category' => 'audit',
                'salary_min' => 80000,
                'salary_max' => 120000,
                'application_deadline' => '2025-09-30',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Tax Consultant',
                'department' => 'Tax Advisory',
                'location' => 'Pokhara',
                'job_type' => 'full-time',
                'overview' => 'Join our tax advisory team as a Tax Consultant to provide comprehensive tax planning and compliance services to our diverse client base in the Pokhara region.',
                'responsibilities' => "Prepare and review tax returns for individuals and businesses\nProvide tax planning and advisory services\nResearch tax laws and regulations\nAssist clients with tax compliance and optimization strategies\nRepresent clients in tax authority interactions\nDevelop tax-efficient business structures",
                'requirements' => "Bachelor's degree in Accounting, Finance, or Taxation\n2-4 years of tax preparation and advisory experience\nStrong knowledge of Nepal tax laws and regulations\nAttention to detail and analytical mindset\nExcellent client communication skills\nProfessional tax certification preferred",
                'benefits' => "Competitive compensation package\nProfessional development support\nHealth insurance coverage\nFlexible working hours\nCareer growth opportunities",
                'category' => 'tax',
                'salary_min' => 60000,
                'salary_max' => 90000,
                'application_deadline' => '2025-09-15',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Business Analyst',
                'department' => 'Business Advisory',
                'location' => 'Kathmandu',
                'job_type' => 'full-time',
                'overview' => 'We are looking for a talented Business Analyst to help our clients optimize their operations, improve efficiency, and drive strategic decision-making through data-driven insights.',
                'responsibilities' => "Analyze business processes and identify improvement opportunities\nDevelop financial models and forecasts\nConduct market research and competitive analysis\nPrepare business cases and strategic recommendations\nSupport mergers and acquisitions activities\nCreate dashboards and reports for stakeholders",
                'requirements' => "Master's degree in Business Administration, Finance, or related field\n3+ years of business analysis or consulting experience\nStrong analytical and quantitative skills\nProficiency in Excel, PowerPoint, and data analysis tools\nExcellent presentation and communication skills\nIndustry experience in multiple sectors preferred",
                'benefits' => "Competitive salary and performance bonuses\nComprehensive benefits package\nProfessional certification support\nTraining and development programs\nCollaborative work environment",
                'category' => 'advisory',
                'salary_min' => 70000,
                'salary_max' => 110000,
                'application_deadline' => '2025-10-15',
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Junior Accountant',
                'department' => 'Audit & Assurance',
                'location' => 'Chitwan',
                'job_type' => 'full-time',
                'overview' => 'Entry-level position perfect for recent graduates looking to start their career in accounting and audit. Great opportunity for learning and professional development.',
                'responsibilities' => "Assist in audit fieldwork and documentation\nPrepare working papers and schedules\nPerform basic audit procedures under supervision\nMaintain client files and documentation\nSupport senior team members in various tasks\nLearn and apply auditing standards and procedures",
                'requirements' => "Bachelor's degree in Accounting or Finance\nFresh graduate or 1-2 years of experience\nStrong academic record\nEagerness to learn and grow professionally\nGood communication and teamwork skills\nBasic knowledge of accounting principles",
                'benefits' => "Entry-level competitive salary\nComprehensive training program\nMentorship from senior professionals\nCareer progression opportunities\nHealth insurance",
                'category' => 'audit',
                'salary_min' => 35000,
                'salary_max' => 50000,
                'application_deadline' => '2025-08-30',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'IT Support Specialist',
                'department' => 'Support & Admin',
                'location' => 'Kathmandu',
                'job_type' => 'full-time',
                'overview' => 'Support our technology infrastructure and help drive digital transformation initiatives across the organization.',
                'responsibilities' => "Provide technical support to staff across all offices\nMaintain and troubleshoot computer systems and networks\nImplement security protocols and data backup procedures\nSupport software installations and updates\nAssist with digital transformation projects\nTrain staff on new technology tools",
                'requirements' => "Bachelor's degree in IT, Computer Science, or related field\n2+ years of IT support experience\nKnowledge of Windows, networks, and office software\nStrong troubleshooting and problem-solving skills\nExcellent customer service orientation\nProfessional IT certifications preferred",
                'benefits' => "Competitive salary package\nTechnology training opportunities\nHealth and life insurance\nFlexible working arrangements\nCareer development support",
                'category' => 'support',
                'salary_min' => 55000,
                'salary_max' => 80000,
                'application_deadline' => '2025-09-10',
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 5,
            ],
        ];

        foreach ($jobs as $job) {
            JobOpening::create($job);
        }

        // Seed Career Testimonials
        $testimonials = [
            [
                'employee_name' => 'Priya Sharma',
                'position' => 'Senior Auditor',
                'testimonial' => 'The professional development opportunities here are exceptional. I\'ve grown from a junior auditor to a senior position in just three years, with constant support and mentorship.',
                'photo' => null,
                'years_with_company' => 3,
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'employee_name' => 'Rajesh Thapa',
                'position' => 'Tax Consultant',
                'testimonial' => 'The collaborative culture and diverse client portfolio make every day interesting. I\'m constantly learning and applying new skills in different industries.',
                'photo' => null,
                'years_with_company' => 2,
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'employee_name' => 'Sunita Karki',
                'position' => 'Business Analyst',
                'testimonial' => 'The work-life balance and supportive management make this a great place to build a career. The benefits package is comprehensive and the team is like family.',
                'photo' => null,
                'years_with_company' => 4,
                'is_active' => true,
                'sort_order' => 3,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            CareerTestimonial::create($testimonial);
        }
    }
}
