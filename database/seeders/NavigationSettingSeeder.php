<?php

namespace Database\Seeders;

use App\Models\NavigationSetting;
use Illuminate\Database\Seeder;

class NavigationSettingSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        $navigationItems = [
            [
                'page_slug' => 'home',
                'page_title' => 'Home',
                'route_name' => 'home',
                'icon_class' => 'fas fa-home',
                'description' => 'Welcome to Chartered Insights, your trusted partner for expert financial solutions. We provide comprehensive audit, tax, and consulting services tailored to drive your business forward. Our team of experienced professionals is dedicated to delivering strategic insights and sustainable growth for clients across various industries.',
                'preview_image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Finance,Consulting,Audit',
                'metadata' => [
                    'services' => [
                        ['title' => 'Financial Planning', 'icon' => 'fas fa-chart-line'],
                        ['title' => 'Investment Advice', 'icon' => 'fas fa-piggy-bank'],
                        ['title' => 'Risk Management', 'icon' => 'fas fa-shield-alt'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'page_slug' => 'services',
                'page_title' => 'Services',
                'route_name' => 'services',
                'icon_class' => 'fas fa-file-invoice-dollar',
                'description' => 'Explore our comprehensive audit, tax, and consulting services tailored to your needs. From financial reporting and compliance to strategic business consulting, we offer solutions that ensure regulatory adherence, optimize financial performance, and support long-term success.',
                'preview_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Audit,Tax,Consulting',
                'metadata' => [
                    'services' => [
                        ['title' => 'Audit Services', 'icon' => 'fas fa-book'],
                        ['title' => 'Tax Consulting', 'icon' => 'fas fa-calculator'],
                        ['title' => 'Business Advisory', 'icon' => 'fas fa-briefcase'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'page_slug' => 'industries',
                'page_title' => 'Industries',
                'route_name' => 'industries',
                'icon_class' => 'fas fa-industry',
                'description' => 'Specialized expertise across diverse sectors to meet your unique challenges. Our industry-specific knowledge in healthcare, technology, manufacturing, and more ensures customized solutions that address your business\'s specific needs and goals.',
                'preview_image' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Healthcare,Technology,Manufacturing',
                'metadata' => [
                    'services' => [
                        ['title' => 'Healthcare', 'icon' => 'fas fa-heartbeat'],
                        ['title' => 'Technology', 'icon' => 'fas fa-laptop-code'],
                        ['title' => 'Manufacturing', 'icon' => 'fas fa-industry'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'page_slug' => 'events',
                'page_title' => 'Events',
                'route_name' => 'events',
                'icon_class' => 'fas fa-calendar',
                'description' => 'Join our upcoming events to connect and learn from industry experts. Our workshops, webinars, and networking sessions provide valuable insights and opportunities to collaborate with peers and professionals.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Workshops,Webinars,Networking',
                'metadata' => [
                    'services' => [
                        ['title' => 'Workshops', 'icon' => 'fas fa-chalkboard-teacher'],
                        ['title' => 'Webinars', 'icon' => 'fas fa-video'],
                        ['title' => 'Networking', 'icon' => 'fas fa-users'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'page_slug' => 'offices',
                'page_title' => 'Offices',
                'route_name' => 'offices',
                'icon_class' => 'fas fa-building',
                'description' => 'Discover our office locations and connect with our team near you. With multiple offices strategically located, we provide accessible, personalized support to meet your financial and consulting needs.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Locations,Support,Consulting',
                'metadata' => [
                    'services' => [
                        ['title' => 'Regional Support', 'icon' => 'fas fa-map-marker-alt'],
                        ['title' => 'Consulting Hubs', 'icon' => 'fas fa-building'],
                        ['title' => 'Client Services', 'icon' => 'fas fa-headset'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'page_slug' => 'blogs',
                'page_title' => 'Blogs',
                'route_name' => 'blogs',
                'icon_class' => 'fas fa-blog',
                'description' => 'Read our latest articles on finance, tax, and business trends. Our blog offers in-depth analyses, practical tips, and expert perspectives to help you navigate the complexities of the financial world.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Finance,Tax,Trends',
                'metadata' => [
                    'services' => [
                        ['title' => 'Finance Tips', 'icon' => 'fas fa-money-bill'],
                        ['title' => 'Tax Updates', 'icon' => 'fas fa-file-alt'],
                        ['title' => 'Industry Trends', 'icon' => 'fas fa-chart-bar'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'page_slug' => 'insights',
                'page_title' => 'Insights',
                'route_name' => 'insights',
                'icon_class' => 'fas fa-lightbulb',
                'description' => 'Stay informed with our latest industry insights and thought leadership. Our expert analyses cover emerging trends, regulatory updates, and strategic opportunities to keep your business ahead in a dynamic market.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Insights,Trends,Leadership',
                'metadata' => [
                    'services' => [
                        ['title' => 'Market Analysis', 'icon' => 'fas fa-chart-pie'],
                        ['title' => 'Regulatory Updates', 'icon' => 'fas fa-gavel'],
                        ['title' => 'Strategic Insights', 'icon' => 'fas fa-lightbulb'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'page_slug' => 'about',
                'page_title' => 'About',
                'route_name' => 'about',
                'icon_class' => 'fas fa-info-circle',
                'description' => 'Learn about our mission, values, and commitment to excellence. At Chartered Insights, we strive to deliver unparalleled financial and consulting services, fostering trust and driving success for our clients.',
                'preview_image' => 'https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Mission,Values,Excellence',
                'metadata' => [
                    'services' => [
                        ['title' => 'Our Mission', 'icon' => 'fas fa-bullseye'],
                        ['title' => 'Our Values', 'icon' => 'fas fa-handshake'],
                        ['title' => 'Our Team', 'icon' => 'fas fa-users'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'page_slug' => 'ourteam',
                'page_title' => 'Teams',
                'route_name' => 'ourteam',
                'icon_class' => 'fas fa-users',
                'description' => 'Meet our dedicated team of professionals at Roshan Kumar & Associates. Our experts in audit, tax, and consulting bring diverse expertise and a commitment to delivering exceptional results for our clients.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321497487-e288fb19713f?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Team,Experts,Professionals',
                'metadata' => [
                    'services' => [
                        ['title' => 'Audit Experts', 'icon' => 'fas fa-book-open'],
                        ['title' => 'Tax Specialists', 'icon' => 'fas fa-calculator'],
                        ['title' => 'Consulting Team', 'icon' => 'fas fa-users-cog'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'page_slug' => 'careers',
                'page_title' => 'Careers',
                'route_name' => 'careers',
                'icon_class' => 'fas fa-briefcase',
                'description' => 'Explore career opportunities to grow with Chartered Insights. Join our dynamic team of professionals dedicated to excellence in audit, tax, and advisory services, and advance your career with meaningful opportunities.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Careers,Opportunities,Professional',
                'metadata' => [
                    'services' => [
                        ['title' => 'Job Openings', 'icon' => 'fas fa-briefcase'],
                        ['title' => 'Internships', 'icon' => 'fas fa-graduation-cap'],
                        ['title' => 'Professional Growth', 'icon' => 'fas fa-chart-line'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 10,
            ],
            [
                'page_slug' => 'contact',
                'page_title' => 'Contact Us',
                'route_name' => 'contact',
                'icon_class' => 'fas fa-envelope',
                'description' => 'Get in touch with our team for personalized support and inquiries. Whether you need assistance with audits, tax planning, or strategic consulting, our experts are here to help you succeed.',
                'preview_image' => 'https://images.unsplash.com/photo-1516321310769-65e85b8e6351?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=300&h=120',
                'tags' => 'Support,Contact,Consulting',
                'metadata' => [
                    'services' => [
                        ['title' => 'Support Desk', 'icon' => 'fas fa-headset'],
                        ['title' => 'Consulting Inquiries', 'icon' => 'fas fa-envelope'],
                        ['title' => 'Feedback', 'icon' => 'fas fa-comment'],
                    ],
                ],
                'is_active' => true,
                'sort_order' => 11,
            ],
        ];

        foreach ($navigationItems as $item) {
            NavigationSetting::updateOrCreate(
                ['page_slug' => $item['page_slug']],
                $item
            );
        }
    }
}
