<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            [
                'title' => 'Audit & Assurance',
                'slug' => 'audit-assurance',
                'description' => 'Independent audits, reviews, and assurance services that provide confidence in your financial reporting and compliance with regulatory requirements.',
                'detailed_description' => 'Our audit and assurance services provide independent verification of your financial information, helping stakeholders make informed decisions with confidence.',
                'category' => 'audit',
                'features' => [
                    'Financial statement audits',
                    'Internal audit services',
                    'Compliance audits',
                    'Due diligence reviews',
                ],
                'sub_services' => [
                    'Statutory Audits' => [
                        'Annual financial audits',
                        'Regulatory compliance audits',
                        'Special purpose audits',
                    ],
                    'Internal Audits' => [
                        'Operational audits',
                        'IT audits',
                        'Process audits',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />',
                'status' => 'active',
                'sort_order' => 1,
                'is_featured' => true,
            ],
            [
                'title' => 'Tax Advisory',
                'slug' => 'tax-advisory',
                'description' => 'Strategic tax planning, compliance, and advisory services to optimize your tax position and ensure regulatory adherence across all jurisdictions.',
                'detailed_description' => 'Our comprehensive tax advisory services help you navigate complex tax regulations while optimizing your tax position and ensuring full compliance.',
                'category' => 'tax',
                'features' => [
                    'Corporate tax planning',
                    'VAT and excise compliance',
                    'Tax litigation support',
                    'International tax advisory',
                ],
                'sub_services' => [
                    'Tax Planning' => [
                        'Corporate tax strategies',
                        'Personal tax planning',
                        'Tax-efficient structuring',
                    ],
                    'Tax Compliance' => [
                        'VAT registration and filing',
                        'Income tax returns',
                        'Withholding tax compliance',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" />',
                'status' => 'active',
                'sort_order' => 2,
                'is_featured' => true,
            ],
            [
                'title' => 'Risk Advisory',
                'slug' => 'risk-advisory',
                'description' => 'Comprehensive risk assessment, management strategies, and internal control solutions to protect and strengthen your organization against uncertainties.',
                'detailed_description' => 'Our risk advisory services help organizations identify, assess, and manage risks while building robust internal control systems.',
                'category' => 'risk',
                'features' => [
                    'Enterprise risk management',
                    'Internal control assessment',
                    'Fraud risk management',
                    'Cybersecurity governance',
                ],
                'sub_services' => [
                    'Risk Assessment' => [
                        'Enterprise risk evaluation',
                        'Operational risk analysis',
                        'Financial risk assessment',
                    ],
                    'Control Systems' => [
                        'Internal control design',
                        'Control testing',
                        'Remediation support',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />',
                'status' => 'active',
                'sort_order' => 3,
                'is_featured' => true,
            ],
            [
                'title' => 'Business Consulting',
                'slug' => 'business-consulting',
                'description' => 'Strategic advisory services, process optimization, and growth planning to help your business reach its full potential in competitive markets.',
                'detailed_description' => 'Our business consulting services provide strategic guidance and operational improvements to drive growth and enhance business performance.',
                'category' => 'consulting',
                'features' => [
                    'Strategic planning',
                    'Business process improvement',
                    'Performance management',
                    'Market entry strategies',
                ],
                'sub_services' => [
                    'Strategy Development' => [
                        'Business strategy formulation',
                        'Market analysis',
                        'Competitive positioning',
                    ],
                    'Operational Excellence' => [
                        'Process optimization',
                        'Performance metrics',
                        'Change management',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />',
                'status' => 'active',
                'sort_order' => 4,
                'is_featured' => true,
            ],
            [
                'title' => 'Financial Reporting',
                'slug' => 'financial-reporting',
                'description' => 'Professional financial statement preparation, analysis, and reporting services that meet international standards and regulatory requirements.',
                'detailed_description' => 'Our financial reporting services ensure accurate, compliant, and insightful financial statements that meet all regulatory requirements.',
                'category' => 'reporting',
                'features' => [
                    'NFRS/IFRS compliance',
                    'Management reporting',
                    'Financial analysis',
                    'Budgeting and forecasting',
                ],
                'sub_services' => [
                    'Financial Statements' => [
                        'NFRS/IFRS preparation',
                        'Consolidated statements',
                        'Interim reporting',
                    ],
                    'Management Reports' => [
                        'Dashboard reporting',
                        'KPI monitoring',
                        'Variance analysis',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1586892478025-2b5472316f22?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />',
                'status' => 'active',
                'sort_order' => 5,
                'is_featured' => true,
            ],
            [
                'title' => 'Corporate Advisory',
                'slug' => 'corporate-advisory',
                'description' => 'Strategic corporate guidance, governance consulting, and transaction advisory to support your business objectives and stakeholder interests.',
                'detailed_description' => 'Our corporate advisory services provide expert guidance on governance, transactions, and strategic corporate matters.',
                'category' => 'advisory',
                'features' => [
                    'Corporate governance',
                    'Mergers & acquisitions',
                    'Business valuations',
                    'Regulatory compliance',
                ],
                'sub_services' => [
                    'Governance' => [
                        'Board advisory',
                        'Compliance frameworks',
                        'Policy development',
                    ],
                    'Transactions' => [
                        'M&A advisory',
                        'Due diligence',
                        'Valuation services',
                    ],
                ],
                'featured_image' => 'https://images.unsplash.com/photo-1560472354-b33ff0c44a43?q=80&w=600&auto=format&fit=crop',
                'svg_icon' => '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />',
                'status' => 'active',
                'sort_order' => 6,
                'is_featured' => true,
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
