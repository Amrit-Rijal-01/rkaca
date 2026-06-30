<?php

namespace Database\Seeders;

use App\Models\Jumbotron;
use Illuminate\Database\Seeder;

class JumbotronSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing jumbotrons
        Jumbotron::truncate();

        // Create multiple slides for home page (multi-slide carousel)
        $homeSlides = [
            [
                'page_slug' => 'home',
                'title' => 'Welcome to Chartered Insights',
                'subtitle' => 'Your trusted partner for comprehensive accounting, taxation, and business advisory services in Nepal.',
                'background_image_url' => 'https://images.unsplash.com/photo-1559526324-4b87b5e36e44?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Get Started',
                'button_link' => '/contact',
                'is_active' => true,
                'is_multi_slide' => true,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'home',
                'title' => 'Expert Financial Solutions',
                'subtitle' => 'From audit and taxation to strategic business consulting, we provide comprehensive services to drive your success.',
                'background_image_url' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Our Services',
                'button_link' => '/services',
                'is_active' => true,
                'is_multi_slide' => true,
                'slide_order' => 2,
            ],
            [
                'page_slug' => 'home',
                'title' => 'Trusted by Leading Businesses',
                'subtitle' => 'Join over 500+ satisfied clients who trust us with their financial and business needs across Nepal.',
                'background_image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'View Industries',
                'button_link' => '/industries',
                'is_active' => true,
                'is_multi_slide' => true,
                'slide_order' => 3,
            ],
            [
                'page_slug' => 'home',
                'title' => 'Innovation Meets Excellence',
                'subtitle' => 'Leveraging cutting-edge technology and deep industry expertise to deliver exceptional results for your business.',
                'background_image_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Learn More',
                'button_link' => '/about',
                'is_active' => true,
                'is_multi_slide' => true,
                'slide_order' => 4,
            ],
        ];

        // Create single jumbotrons for other pages
        $singleJumbotrons = [
            [
                'page_slug' => 'about',
                'title' => 'About Chartered Insights',
                'subtitle' => 'Discover our journey, values, and commitment to delivering exceptional financial and business solutions.',
                'background_image_url' => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Our Story',
                'button_link' => '#our-story',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'services',
                'title' => 'Our Professional Services',
                'subtitle' => 'Comprehensive audit, tax, and advisory services tailored to meet your business needs and drive growth.',
                'background_image_url' => 'https://images.unsplash.com/photo-1554224155-6726b3ff858f?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'View All Services',
                'button_link' => '#services-overview',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'industries',
                'title' => 'Industry Expertise',
                'subtitle' => 'Specialized knowledge across diverse sectors to provide targeted solutions for your industry challenges.',
                'background_image_url' => 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Explore Industries',
                'button_link' => '#industries-list',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'insights',
                'title' => 'Insights & Articles',
                'subtitle' => 'Stay ahead with our latest thought leadership, industry analysis, and expert perspectives on accounting, taxation, and business trends.',
                'background_image_url' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Read Latest',
                'button_link' => '#latest-insights',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'careers',
                'title' => 'Join Our Team',
                'subtitle' => 'Build your career with us and be part of a dynamic team committed to excellence and professional growth.',
                'background_image_url' => 'https://images.unsplash.com/photo-1600880292089-90a7e086ee0c?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'View Openings',
                'button_link' => '#job-openings',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'contact',
                'title' => 'Get in Touch',
                'subtitle' => 'Connect with our team of experts and discover how we can help transform your business.',
                'background_image_url' => 'https://images.unsplash.com/photo-1551434678-e076c223a692?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Contact Us',
                'button_link' => '#contact-form',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'offices',
                'title' => 'Our Offices',
                'subtitle' => 'Find our locations across Nepal and connect with our local teams for personalized service.',
                'background_image_url' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Find Location',
                'button_link' => '#office-locations',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'events',
                'title' => 'Events & Seminars',
                'subtitle' => 'Join our educational events, workshops, and seminars to stay updated with the latest industry developments.',
                'background_image_url' => 'https://images.unsplash.com/photo-1590283603385-17ffb3a7f29f?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'View Events',
                'button_link' => '#upcoming-events',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
            [
                'page_slug' => 'blogs',
                'title' => 'Blog Articles',
                'subtitle' => 'Read our latest blog posts covering industry trends, regulatory updates, and business insights.',
                'background_image_url' => 'https://images.unsplash.com/photo-1563013544-824ae1b704d3?q=80&w=1600&auto=format&fit=crop',
                'button_text' => 'Read Blogs',
                'button_link' => '#blog-posts',
                'is_active' => true,
                'is_multi_slide' => false,
                'slide_order' => 1,
            ],
        ];

        // Insert home page slides
        foreach ($homeSlides as $slide) {
            Jumbotron::create($slide);
        }

        // Insert single jumbotrons for other pages
        foreach ($singleJumbotrons as $jumbotron) {
            Jumbotron::create($jumbotron);
        }

        $this->command->info('Created '.count($homeSlides).' slides for home page and '.count($singleJumbotrons).' single jumbotrons for other pages.');
    }
}
