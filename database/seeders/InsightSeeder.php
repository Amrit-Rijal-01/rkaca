<?php

namespace Database\Seeders;

use App\Models\Insight;
use App\Models\InsightCategory;
use Illuminate\Database\Seeder;

class InsightSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create categories first
        $categories = [
            [
                'name' => 'Audit & Assurance',
                'slug' => 'audit-assurance',
                'description' => 'Professional audit services and assurance solutions for businesses.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>',
                'color_class' => 'text-blue-600',
                'sort_order' => 1,
                'is_active' => true,
            ],
            [
                'name' => 'Tax Advisory',
                'slug' => 'tax-advisory',
                'description' => 'Strategic tax planning and advisory services.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" /></svg>',
                'color_class' => 'text-green-600',
                'sort_order' => 2,
                'is_active' => true,
            ],
            [
                'name' => 'Risk Management',
                'slug' => 'risk-management',
                'description' => 'Risk assessment and management strategies.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>',
                'color_class' => 'text-red-600',
                'sort_order' => 3,
                'is_active' => true,
            ],
            [
                'name' => 'Business Strategy',
                'slug' => 'business-strategy',
                'description' => 'Strategic business planning and development.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>',
                'color_class' => 'text-purple-600',
                'sort_order' => 4,
                'is_active' => true,
            ],
            [
                'name' => 'Technology',
                'slug' => 'technology',
                'description' => 'Technology solutions for modern businesses.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>',
                'color_class' => 'text-indigo-600',
                'sort_order' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Compliance',
                'slug' => 'compliance',
                'description' => 'Regulatory compliance and legal requirements.',
                'icon' => '<svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>',
                'color_class' => 'text-orange-600',
                'sort_order' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($categories as $categoryData) {
            InsightCategory::create($categoryData);
        }

        // Create sample insights
        $insights = [
            [
                'title' => 'Strategic Tax Planning for Growing Businesses in Nepal',
                'slug' => 'strategic-tax-planning-growing-businesses-nepal',
                'excerpt' => 'Essential tax strategies and compliance considerations for businesses expanding in Nepal\'s evolving regulatory landscape.',
                'content' => '<p>Strategic tax planning has become more crucial than ever for businesses operating in Nepal\'s dynamic economic environment. As the country continues to evolve its tax framework and regulatory requirements, companies must stay ahead of the curve to optimize their tax positions while ensuring full compliance.</p><p>This comprehensive guide explores the key tax planning strategies that growing businesses should consider, from understanding the latest changes in Nepal\'s tax code to implementing effective structures for sustainable growth.</p><h3>Key Tax Planning Strategies</h3><p>Effective tax planning goes beyond simple compliance. It involves a strategic approach to structuring your business operations in a way that minimizes tax liability while supporting your growth objectives.</p>',
                'category' => 'Tax Advisory',
                'category_slug' => 'tax-advisory',
                'author' => 'Rajesh Sharma, Tax Director',
                'published_at' => now()->subDays(5),
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 1,
                'read_time' => 8,
                'meta_description' => 'Learn essential tax planning strategies for growing businesses in Nepal. Expert insights on regulatory compliance and optimization.',
                'tags' => ['tax planning', 'business growth', 'Nepal tax law', 'compliance'],
                'is_active' => true,
            ],
            [
                'title' => 'Digital Transformation in Modern Accounting Practices',
                'slug' => 'digital-transformation-modern-accounting-practices',
                'excerpt' => 'Exploring how technology is reshaping the accounting landscape and what it means for businesses in Nepal.',
                'content' => '<p>The accounting profession is undergoing a fundamental transformation driven by digital technologies. From cloud-based accounting software to artificial intelligence and machine learning, these innovations are changing how businesses manage their financial operations.</p><p>For businesses in Nepal, embracing digital transformation in accounting is not just about staying competitive—it\'s about building the foundation for sustainable growth in an increasingly digital economy.</p><h3>Key Digital Technologies</h3><p>Several key technologies are leading this transformation, each offering unique benefits for businesses of all sizes.</p>',
                'category' => 'Technology',
                'category_slug' => 'technology',
                'author' => 'Priya Thapa, Technology Consultant',
                'published_at' => now()->subDays(3),
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 2,
                'read_time' => 6,
                'meta_description' => 'Discover how digital transformation is revolutionizing accounting practices. Learn about the latest technologies and their benefits.',
                'tags' => ['digital transformation', 'accounting technology', 'automation', 'AI'],
                'is_active' => true,
            ],
            [
                'title' => 'Understanding Risk Management in Financial Reporting',
                'slug' => 'understanding-risk-management-financial-reporting',
                'excerpt' => 'A comprehensive guide to identifying and mitigating risks in financial reporting processes.',
                'content' => '<p>Risk management in financial reporting has become increasingly critical as businesses face growing scrutiny from stakeholders, regulators, and investors. Understanding and implementing effective risk management strategies helps ensure the accuracy, completeness, and reliability of financial statements.</p><p>This article explores the key components of financial reporting risk management and provides practical strategies for implementation.</p>',
                'category' => 'Risk Management',
                'category_slug' => 'risk-management',
                'author' => 'Sunil Bajracharya, Risk Advisor',
                'published_at' => now()->subDays(7),
                'status' => 'published',
                'is_featured' => true,
                'sort_order' => 3,
                'read_time' => 10,
                'meta_description' => 'Learn about risk management strategies for financial reporting. Expert guidance on identifying and mitigating reporting risks.',
                'tags' => ['risk management', 'financial reporting', 'compliance', 'audit'],
                'is_active' => true,
            ],
            [
                'title' => 'NFRS Updates: What Businesses Need to Know',
                'slug' => 'nfrs-updates-what-businesses-need-know',
                'excerpt' => 'Latest updates to Nepal Financial Reporting Standards and their impact on business financial reporting requirements.',
                'content' => '<p>The Nepal Financial Reporting Standards (NFRS) continue to evolve, bringing new requirements and opportunities for businesses operating in Nepal. Staying current with these changes is essential for maintaining compliance and ensuring accurate financial reporting.</p>',
                'category' => 'Compliance',
                'category_slug' => 'compliance',
                'author' => 'Maya Gurung, Compliance Manager',
                'published_at' => now()->subDays(2),
                'status' => 'published',
                'is_featured' => false,
                'sort_order' => 4,
                'read_time' => 5,
                'meta_description' => 'Stay updated with the latest NFRS changes and their impact on your business financial reporting.',
                'tags' => ['NFRS', 'financial reporting', 'compliance', 'standards'],
                'is_active' => true,
            ],
            [
                'title' => 'ESG Reporting: A Growing Imperative for Businesses',
                'slug' => 'esg-reporting-growing-imperative-businesses',
                'excerpt' => 'Understanding Environmental, Social, and Governance reporting requirements and best practices for sustainable business operations.',
                'content' => '<p>Environmental, Social, and Governance (ESG) reporting has moved from a voluntary initiative to a business imperative. Companies worldwide are facing increasing pressure from investors, regulators, and stakeholders to demonstrate their commitment to sustainable practices.</p>',
                'category' => 'Business Strategy',
                'category_slug' => 'business-strategy',
                'author' => 'Sita Rai, Sustainability Consultant',
                'published_at' => now()->subDays(4),
                'status' => 'published',
                'is_featured' => false,
                'sort_order' => 5,
                'read_time' => 7,
                'meta_description' => 'Learn about ESG reporting requirements and best practices for sustainable business operations.',
                'tags' => ['ESG', 'sustainability', 'reporting', 'governance'],
                'is_active' => true,
            ],
            [
                'title' => 'Internal Audit Best Practices for SMEs',
                'slug' => 'internal-audit-best-practices-smes',
                'excerpt' => 'Essential internal audit practices that small and medium enterprises can implement to improve operations and compliance.',
                'content' => '<p>Internal auditing is not just for large corporations. Small and medium enterprises (SMEs) can significantly benefit from implementing structured internal audit practices that help improve operational efficiency, ensure compliance, and identify growth opportunities.</p>',
                'category' => 'Audit & Assurance',
                'category_slug' => 'audit-assurance',
                'author' => 'Ramesh Shrestha, Internal Audit Manager',
                'published_at' => now()->subDays(6),
                'status' => 'published',
                'is_featured' => false,
                'sort_order' => 6,
                'read_time' => 9,
                'meta_description' => 'Discover internal audit best practices that SMEs can implement to improve operations and ensure compliance.',
                'tags' => ['internal audit', 'SME', 'compliance', 'best practices'],
                'is_active' => true,
            ],
        ];

        foreach ($insights as $insightData) {
            Insight::create($insightData);
        }

        $this->command->info('Insight categories and insights seeded successfully!');
    }
}
