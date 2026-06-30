<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            [
                'name' => 'Healthcare & Medical',
                'title' => 'Healthcare & Medical',
                'slug' => 'healthcare-medical',
                'description' => 'Specialized financial solutions for hospitals, clinics, pharmaceutical companies, and healthcare providers navigating complex regulatory requirements and funding challenges.',
                'content' => 'The healthcare industry presents unique financial challenges, from managing complex revenue cycles to ensuring compliance with stringent regulations. Our specialized team understands the intricacies of medical practice accounting, healthcare compliance, and the financial impact of healthcare reform.',
                'features' => [
                    'Medical practice accounting',
                    'Healthcare compliance audits',
                    'Revenue cycle management',
                    'Medical equipment financing',
                ],
                'svg_icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'category' => 'Healthcare',
                'status' => 'active',
                'sort_order' => 1,
                'is_featured' => true,
                'meta_title' => 'Healthcare & Medical Financial Services',
                'meta_description' => 'Specialized accounting and financial services for healthcare providers, hospitals, and medical practices.',
            ],
            [
                'name' => 'Manufacturing & Industrial',
                'title' => 'Manufacturing & Industrial',
                'slug' => 'manufacturing-industrial',
                'description' => 'Comprehensive financial management for manufacturers, including inventory valuation, cost accounting, supply chain optimization, and regulatory compliance.',
                'content' => 'Manufacturing businesses require sophisticated financial management to track complex cost structures, manage inventory efficiently, and optimize supply chain operations. Our team provides expert guidance on cost accounting, regulatory compliance, and operational efficiency.',
                'features' => [
                    'Cost accounting systems',
                    'Inventory management',
                    'Supply chain finance',
                    'Industrial tax planning',
                ],
                'svg_icon' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                'category' => 'Manufacturing',
                'status' => 'active',
                'sort_order' => 2,
                'is_featured' => true,
                'meta_title' => 'Manufacturing & Industrial Financial Services',
                'meta_description' => 'Expert financial management for manufacturers including cost accounting and inventory optimization.',
            ],
            [
                'name' => 'Technology & Software',
                'title' => 'Technology & Software',
                'slug' => 'technology-software',
                'description' => 'Supporting tech companies and software developers with specialized accounting for intellectual property, R&D tax credits, and venture capital transactions.',
                'content' => 'The technology sector moves at lightning speed, requiring financial partners who understand software revenue recognition, intellectual property valuation, and the unique funding landscape of tech startups and established companies.',
                'features' => [
                    'Software revenue recognition',
                    'R&D tax incentives',
                    'IP valuation',
                    'Startup financial planning',
                ],
                'svg_icon' => 'M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
                'category' => 'Technology',
                'status' => 'active',
                'sort_order' => 3,
                'is_featured' => true,
                'meta_title' => 'Technology & Software Financial Services',
                'meta_description' => 'Specialized accounting for tech companies, startups, and software developers.',
            ],
            [
                'name' => 'Real Estate & Construction',
                'title' => 'Real Estate & Construction',
                'slug' => 'real-estate-construction',
                'description' => 'Specialized services for real estate developers, construction companies, and property management firms, including project accounting and asset valuation.',
                'content' => 'Real estate and construction projects involve complex financial structures, long-term contracts, and significant capital investments. Our expertise helps navigate project accounting, property valuations, and construction-specific compliance requirements.',
                'features' => [
                    'Project cost accounting',
                    'Property valuation',
                    'Construction audits',
                    'Real estate tax planning',
                ],
                'svg_icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'category' => 'Real Estate',
                'status' => 'active',
                'sort_order' => 4,
                'is_featured' => false,
                'meta_title' => 'Real Estate & Construction Financial Services',
                'meta_description' => 'Project accounting and financial management for real estate and construction companies.',
            ],
            [
                'name' => 'Financial Services',
                'title' => 'Financial Services',
                'slug' => 'financial-services',
                'description' => 'Comprehensive solutions for banks, insurance companies, investment firms, and fintech companies navigating complex regulatory environments.',
                'content' => 'Financial services organizations operate in heavily regulated environments requiring precise compliance and sophisticated risk management. Our team provides specialized expertise in banking compliance, insurance accounting, and fintech advisory services.',
                'features' => [
                    'Banking compliance',
                    'Insurance accounting',
                    'Investment audits',
                    'Fintech advisory',
                ],
                'svg_icon' => 'M3 10l9-7 9 7 M21 10v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6 M8 10v6M12 10v6M16 10v6 M7 21h10',
                'category' => 'Financial',
                'status' => 'active',
                'sort_order' => 5,
                'is_featured' => false,
                'meta_title' => 'Financial Services Industry Solutions',
                'meta_description' => 'Specialized services for banks, insurance companies, and fintech organizations.',
            ],
            [
                'name' => 'Non-Profit & NGOs',
                'title' => 'Non-Profit & NGOs',
                'slug' => 'non-profit-ngos',
                'description' => 'Specialized accounting and compliance services for non-profit organizations, NGOs, and charitable institutions ensuring transparency and accountability.',
                'content' => 'Non-profit organizations require specialized financial management that ensures transparency, donor compliance, and effective impact reporting. Our team understands the unique challenges of grant accounting and non-profit governance.',
                'features' => [
                    'Grant accounting',
                    'Donor compliance',
                    'Impact reporting',
                    'Non-profit audits',
                ],
                'svg_icon' => 'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z',
                'category' => 'Non-Profit',
                'status' => 'active',
                'sort_order' => 6,
                'is_featured' => false,
                'meta_title' => 'Non-Profit & NGO Financial Services',
                'meta_description' => 'Accounting and compliance services for non-profit organizations and NGOs.',
            ],
            [
                'name' => 'Hospitality & Tourism',
                'title' => 'Hospitality & Tourism',
                'slug' => 'hospitality-tourism',
                'description' => 'Financial management solutions for hotels, restaurants, travel agencies, and tourism businesses, focusing on seasonal variations and operational efficiency.',
                'content' => 'The hospitality and tourism industry faces unique challenges with seasonal fluctuations, complex inventory management, and diverse revenue streams. Our expertise helps optimize financial performance across all aspects of hospitality operations.',
                'features' => [
                    'Hotel revenue management',
                    'Restaurant accounting',
                    'Tourism tax planning',
                    'Seasonal cash flow',
                ],
                'svg_icon' => 'M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4',
                'category' => 'Hospitality',
                'status' => 'active',
                'sort_order' => 7,
                'is_featured' => false,
                'meta_title' => 'Hospitality & Tourism Financial Services',
                'meta_description' => 'Financial management for hotels, restaurants, and tourism businesses.',
            ],
            [
                'name' => 'Education & Training',
                'title' => 'Education & Training',
                'slug' => 'education-training',
                'description' => 'Comprehensive financial services for educational institutions, training centers, and e-learning platforms, ensuring efficient resource management and compliance.',
                'content' => 'Educational institutions require specialized financial management to handle student fees, institutional compliance, and resource allocation efficiently. Our team provides expertise in educational accounting and institutional financial planning.',
                'features' => [
                    'Educational accounting',
                    'Student fee management',
                    'Institutional audits',
                    'Education compliance',
                ],
                'svg_icon' => 'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                'category' => 'Education',
                'status' => 'active',
                'sort_order' => 8,
                'is_featured' => false,
                'meta_title' => 'Education & Training Financial Services',
                'meta_description' => 'Financial management for educational institutions and training centers.',
            ],
            [
                'name' => 'Retail & E-commerce',
                'title' => 'Retail & E-commerce',
                'slug' => 'retail-ecommerce',
                'description' => 'Financial solutions for retailers and e-commerce businesses, including inventory management, multi-channel revenue tracking, and customer analytics.',
                'content' => 'Retail and e-commerce businesses operate in dynamic environments with complex inventory cycles, multi-channel sales, and evolving customer behavior. Our expertise helps optimize financial performance across all retail channels.',
                'features' => [
                    'Retail accounting systems',
                    'E-commerce analytics',
                    'Multi-channel reporting',
                    'Customer profitability',
                ],
                'svg_icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z',
                'category' => 'Retail',
                'status' => 'active',
                'sort_order' => 9,
                'is_featured' => false,
                'meta_title' => 'Retail & E-commerce Financial Services',
                'meta_description' => 'Financial solutions for retail and e-commerce businesses.',
            ],
        ];

        foreach ($industries as $industry) {
            Industry::updateOrCreate(
                ['slug' => $industry['slug']],
                $industry
            );
        }
    }
}
