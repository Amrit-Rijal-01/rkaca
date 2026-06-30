<?php

namespace Database\Seeders;

use App\Models\IndustryExpertise;
use Illuminate\Database\Seeder;

class IndustryExpertiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $expertises = [
            [
                'title' => 'Specialized Knowledge',
                'description' => 'Our team brings deep industry-specific expertise and understanding of unique challenges and opportunities within each sector.',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189 6.01 6.01 0 01.75 2.815c-.949.143-1.92.143-2.869 0a6.01 6.01 0 01.75-2.815A6.01 6.01 0 0112 12.75zm0 0v-1.5a6 6 0 100-12 6 6 0 000 12z" />
</svg>',
                'icon_class' => 'fas fa-lightbulb',
                'sort_order' => 1,
                'status' => 'active',
                'is_featured' => true,
                'color_theme' => '#007bff',
            ],
            [
                'title' => 'Proven Results',
                'description' => 'We have a track record of delivering measurable outcomes and driving growth for businesses across various industries.',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
</svg>',
                'icon_class' => 'fas fa-chart-bar',
                'sort_order' => 2,
                'status' => 'active',
                'is_featured' => true,
                'color_theme' => '#28a745',
            ],
            [
                'title' => 'Strategic Partnerships',
                'description' => 'We build long-term relationships with our clients, serving as trusted advisors and strategic partners in their growth journey.',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
</svg>',
                'icon_class' => 'fas fa-handshake',
                'sort_order' => 3,
                'status' => 'active',
                'is_featured' => true,
                'color_theme' => '#ffc107',
            ],
            [
                'title' => 'Innovation Focus',
                'description' => 'We stay ahead of industry trends and leverage cutting-edge technologies to provide innovative solutions that drive competitive advantage.',
                'svg_icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
  <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.631 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 01-2.448-2.448 14.9 14.9 0 01.06-.312m-2.24 2.39a4.493 4.493 0 00-1.757 4.306 4.493 4.493 0 004.306-1.758M16.5 9a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
</svg>',
                'icon_class' => 'fas fa-rocket',
                'sort_order' => 4,
                'status' => 'active',
                'is_featured' => true,
                'color_theme' => '#dc3545',
            ],
        ];

        foreach ($expertises as $expertise) {
            IndustryExpertise::create($expertise);
        }
    }
}
