<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $events = [
            // Featured Event (Upcoming)
            [
                'title' => 'Annual Accounting & Finance Conference 2024',
                'slug' => 'annual-accounting-finance-conference-2024',
                'type' => 'conference',
                'description' => 'Join Nepal\'s premier gathering of accounting and finance professionals for a full day of insights, networking, and knowledge sharing. Features keynote speakers, panel discussions, and workshops on the latest industry trends. This comprehensive event covers digital transformation in accounting, regulatory updates, best practices in financial reporting, and emerging technologies that are reshaping the industry.',
                'short_description' => 'Join Nepal\'s premier gathering of accounting and finance professionals for a full day of insights, networking, and knowledge sharing. Features keynote speakers, panel discussions, and workshops on the latest industry trends.',
                'start_date' => Carbon::now()->addDays(30),
                'end_date' => Carbon::now()->addDays(30),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'location' => 'Hotel Annapurna, Kathmandu',
                'venue_type' => 'physical',
                'price' => 2500.00,
                'early_bird_price' => 2000.00,
                'registration_link' => 'https://example.com/register/conference-2024',
                'max_participants' => 200,
                'is_featured' => true,
                'is_free' => false,
                'status' => 'active',
            ],

            // Upcoming Events
            [
                'title' => 'Tax Compliance Updates for FY 2023/24',
                'slug' => 'tax-compliance-updates-fy-2023-24',
                'type' => 'webinar',
                'description' => 'Stay updated with the latest changes in tax regulations and compliance requirements. Essential for all business owners and finance professionals. This webinar will cover recent amendments to tax laws, new filing requirements, penalty structures, and compliance best practices.',
                'short_description' => 'Stay updated with the latest changes in tax regulations and compliance requirements. Essential for all business owners and finance professionals.',
                'start_date' => Carbon::now()->addDays(7),
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
                'location' => 'Online (Zoom)',
                'venue_type' => 'online',
                'registration_link' => 'https://example.com/register/tax-compliance',
                'max_participants' => 100,
                'is_featured' => false,
                'is_free' => true,
                'status' => 'active',
            ],

            [
                'title' => 'Strategic Financial Planning for SMEs',
                'slug' => 'strategic-financial-planning-smes',
                'type' => 'workshop',
                'description' => 'Interactive workshop covering budgeting, forecasting, and financial strategy for small and medium enterprises. Includes practical exercises and case studies. Participants will learn to create comprehensive financial plans, develop cash flow projections, and implement risk management strategies.',
                'short_description' => 'Interactive workshop covering budgeting, forecasting, and financial strategy for small and medium enterprises. Includes practical exercises and case studies.',
                'start_date' => Carbon::now()->addDays(14),
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'location' => 'CI Training Center',
                'venue_type' => 'physical',
                'price' => 1500.00,
                'registration_link' => 'https://example.com/register/financial-planning',
                'max_participants' => 25,
                'is_featured' => false,
                'is_free' => false,
                'status' => 'active',
            ],

            [
                'title' => 'Advanced Excel for Financial Analysis',
                'slug' => 'advanced-excel-financial-analysis',
                'type' => 'training',
                'description' => 'Master advanced Excel functions, pivot tables, and financial modeling techniques. Perfect for accounting professionals and analysts. This comprehensive training covers complex formulas, data analysis tools, automation techniques, and professional reporting methods.',
                'short_description' => 'Master advanced Excel functions, pivot tables, and financial modeling techniques. Perfect for accounting professionals and analysts.',
                'start_date' => Carbon::now()->addDays(21),
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'location' => 'CI Training Center',
                'venue_type' => 'physical',
                'price' => 3000.00,
                'registration_link' => 'https://example.com/register/excel-training',
                'max_participants' => 20,
                'is_featured' => false,
                'is_free' => false,
                'status' => 'active',
            ],

            [
                'title' => 'Enterprise Risk Management in Uncertain Times',
                'slug' => 'enterprise-risk-management-uncertain-times',
                'type' => 'webinar',
                'description' => 'Learn how to identify, assess, and mitigate business risks in today\'s volatile economic environment. Expert insights and practical frameworks. This session will cover risk assessment methodologies, crisis management strategies, and building resilient business operations.',
                'short_description' => 'Learn how to identify, assess, and mitigate business risks in today\'s volatile economic environment. Expert insights and practical frameworks.',
                'start_date' => Carbon::now()->addDays(28),
                'start_time' => '15:00:00',
                'end_time' => '16:30:00',
                'location' => 'Online (Teams)',
                'venue_type' => 'online',
                'registration_link' => 'https://example.com/register/risk-management',
                'max_participants' => 150,
                'is_featured' => false,
                'is_free' => true,
                'status' => 'active',
            ],

            // Past Events with recordings
            [
                'title' => 'Digital Transformation in Accounting',
                'slug' => 'digital-transformation-accounting',
                'type' => 'webinar',
                'description' => 'Explored automation tools, cloud accounting, and AI applications in modern accounting practices. This comprehensive session covered the latest technology trends transforming the accounting industry.',
                'short_description' => 'Explored automation tools, cloud accounting, and AI applications in modern accounting practices.',
                'start_date' => Carbon::now()->subDays(22),
                'start_time' => '14:00:00',
                'end_time' => '15:30:00',
                'location' => 'Online (Zoom)',
                'venue_type' => 'online',
                'recording_link' => 'https://example.com/recordings/digital-transformation',
                'resources_link' => 'https://example.com/resources/digital-transformation',
                'is_featured' => false,
                'is_free' => true,
                'status' => 'active',
            ],

            [
                'title' => 'Internal Audit Best Practices Workshop',
                'slug' => 'internal-audit-best-practices-workshop',
                'type' => 'workshop',
                'description' => 'Comprehensive training on risk-based auditing, compliance frameworks, and audit technology. This intensive workshop provided hands-on experience with modern audit methodologies.',
                'short_description' => 'Comprehensive training on risk-based auditing, compliance frameworks, and audit technology.',
                'start_date' => Carbon::now()->subDays(29),
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'location' => 'CI Training Center',
                'venue_type' => 'physical',
                'price' => 2500.00,
                'recording_link' => 'https://example.com/recordings/audit-practices',
                'resources_link' => 'https://example.com/resources/audit-practices',
                'max_participants' => 30,
                'is_featured' => false,
                'is_free' => false,
                'status' => 'active',
            ],

            [
                'title' => 'Business Valuation Methodologies',
                'slug' => 'business-valuation-methodologies',
                'type' => 'training',
                'description' => 'In-depth look at different valuation approaches, market multiples, and DCF modeling techniques. This technical training provided practical skills for business valuation professionals.',
                'short_description' => 'In-depth look at different valuation approaches, market multiples, and DCF modeling techniques.',
                'start_date' => Carbon::now()->subDays(37),
                'start_time' => '10:00:00',
                'end_time' => '16:00:00',
                'location' => 'Hotel Himalaya, Kathmandu',
                'venue_type' => 'physical',
                'price' => 3500.00,
                'recording_link' => 'https://example.com/recordings/business-valuation',
                'resources_link' => 'https://example.com/resources/business-valuation',
                'max_participants' => 25,
                'is_featured' => false,
                'is_free' => false,
                'status' => 'active',
            ],
        ];

        foreach ($events as $event) {
            Event::create($event);
        }
    }
}
