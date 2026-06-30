<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\AboutCoreValue;
use App\Models\AboutExpertiseArea;
use App\Models\AboutTeamMember;
use App\Models\AboutWhyChooseUs;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the main about page record
        $about = About::create([
            'our_story_title' => 'Our Story',
            'our_story_content' => "Chartered Insights is a full-service Chartered Accountancy firm headquartered in Biratnagar, Nepal, delivering a complete range of Audit & Assurance, Taxation, Risk Advisory, Accounting, and Business Consulting services to businesses, not-for-profit organizations, and government entities.\n\nWe were founded with a vision to empower businesses with financial clarity, robust compliance, and strategic insights that help them navigate challenges and seize opportunities in a competitive, evolving marketplace.\n\nBy combining deep technical knowledge, sector-specific expertise, and a client-focused service approach, Chartered Insights has become a trusted partner for organizations seeking professional, ethical, and growth-oriented solutions.",
            'our_story_image' => null, // Will be set when an image is uploaded
            'core_values_title' => 'Our Core Values & Client-First Philosophy',
            'core_values_subtitle' => 'These foundational principles guide every interaction, decision, and service we provide to our clients.',
            'leadership_title' => 'Our Leadership Team',
            'leadership_subtitle' => 'Meet the experienced professionals leading our firm with vision, expertise, and unwavering commitment to client success.',
            'expertise_title' => 'Our People – Expertise that Drives Value',
            'expertise_subtitle' => 'Our multidisciplinary team combines diverse skills and industry experience to deliver exceptional results.',
            'why_choose_us_title' => 'Why Businesses Choose Chartered Insights',
            'why_choose_us_subtitle' => 'Our track record speaks for itself - proven expertise, exceptional service, and measurable results.',
            'cta_title' => 'Ready to Partner with Us?',
            'cta_subtitle' => 'Experience the difference that expert guidance, innovative solutions, and unwavering commitment can make for your organization. Let\'s discuss how we can help you achieve your goals.',
            'is_active' => true,
        ]);

        // Create core values
        $coreValues = [
            [
                'title' => 'Partner-Led Engagements',
                'description' => 'Every assignment is directly supervised by a partner or senior professional to ensure quality, accountability, and strategic insight from start to finish.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Culture of Excellence',
                'description' => 'We adhere to international best practices while delivering solutions tailored to the Nepali business landscape, ensuring both compliance and practical value.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Client-First Mindset',
                'description' => 'We prioritize client goals and challenges, providing customized solutions that not only meet legal and regulatory requirements but also support business performance.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Long-Term Relationships',
                'description' => 'Our focus extends beyond one-time engagements. We cultivate lasting partnerships built on trust, reliability, and consistent delivery.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Personal Ownership',
                'description' => 'Every team member takes ownership of their work, ensuring timely execution, high quality, and measurable results for clients.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Commitment to Learning & Growth',
                'description' => 'We invest in our people by offering training, professional certifications, and leadership opportunities to continually enhance our service quality.',
                'icon_svg' => '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($coreValues as $value) {
            AboutCoreValue::create(array_merge($value, ['about_id' => $about->id]));
        }

        // Create team members
        $teamMembers = [
            [
                'name' => 'CA Roshan Kumar Yadav',
                'position' => 'Founder & Managing Partner',
                'bio' => 'A member of the Institute of Chartered Accountants of Nepal (ICAN), with a proven track record in Audit & Assurance, Taxation, Risk Management, and Strategic Advisory across healthcare, banking, manufacturing, and international development sectors.',
                'image' => null, // Will be set when images are uploaded
                'linkedin_url' => null,
                'twitter_url' => null,
                'email' => 'roshan@charteredinsights.com',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'CA Sunil Shrestha',
                'position' => 'Leader - Internal Audit & Risk Advisory',
                'bio' => 'A specialist in internal audits, enterprise risk management, corporate governance, and SOP implementation, bringing deep technical expertise and practical solutions to complex organizational challenges.',
                'image' => null,
                'linkedin_url' => null,
                'twitter_url' => null,
                'email' => 'sunil@charteredinsights.com',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Senior Partner',
                'position' => 'Leader - Offshore & Outsourced Services',
                'bio' => 'Responsible for delivering outsourced accounting, virtual CFO services, payroll management, and compliance solutions to international clients while ensuring global best practices and cost-effectiveness.',
                'image' => null,
                'linkedin_url' => null,
                'twitter_url' => null,
                'email' => 'offshore@charteredinsights.com',
                'sort_order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($teamMembers as $member) {
            AboutTeamMember::create(array_merge($member, ['about_id' => $about->id]));
        }

        // Create expertise areas
        $expertiseAreas = [
            [
                'title' => 'Trailblazing Professional Expertise',
                'description' => 'Our leadership team has delivered impactful assignments in Nepal and abroad, covering sectors such as healthcare, manufacturing, banking, technology, education, and development organizations.',
                'icon' => 'fas fa-rocket',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Multidisciplinary Knowledge Base',
                'description' => 'We combine the skills of Chartered Accountants, ACCA members, semi-qualified professionals, and industry specialists, enabling us to address diverse and complex challenges.',
                'icon' => 'fas fa-graduation-cap',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Mentoring & Knowledge Sharing',
                'description' => 'We maintain a strong mentorship culture, where experienced professionals guide the next generation, fostering growth, innovation, and technical mastery.',
                'icon' => 'fas fa-chalkboard-teacher',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Collaborative, Client-Centric Teamwork',
                'description' => 'Our team works in close partnership with clients, ensuring our strategies align with their vision and objectives while delivering sustainable results.',
                'icon' => 'fas fa-handshake',
                'sort_order' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($expertiseAreas as $area) {
            AboutExpertiseArea::create(array_merge($area, ['about_id' => $about->id]));
        }

        // Create why choose us items
        $whyChooseUsItems = [
            [
                'title' => 'Proven Expertise',
                'description' => '100+ successful client engagements across industries with measurable impact and results.',
                'icon' => 'fas fa-medal',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Partner-Level Involvement',
                'description' => 'Senior professionals lead every assignment, ensuring quality and strategic oversight.',
                'icon' => 'fas fa-user-tie',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Comprehensive Services',
                'description' => 'One firm for all your audit, tax, risk, and advisory needs with integrated solutions.',
                'icon' => 'fas fa-cogs',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'title' => 'Technology-Enabled Solutions',
                'description' => 'Cloud-based systems, secure client portals, and real-time reporting capabilities.',
                'icon' => 'fas fa-laptop-code',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'title' => 'Ethical & Transparent',
                'description' => 'Clear fee structures, no hidden charges, and unwavering commitment to confidentiality.',
                'icon' => 'fas fa-balance-scale',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'title' => 'Results-Driven Approach',
                'description' => 'Focus on measurable outcomes and sustainable business improvements for every client.',
                'icon' => 'fas fa-chart-line',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($whyChooseUsItems as $item) {
            AboutWhyChooseUs::create(array_merge($item, ['about_id' => $about->id]));
        }

        $this->command->info('About page seeded successfully with sample data!');
    }
}
