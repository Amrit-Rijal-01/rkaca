<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key_statistics_title',
        'key_statistics_subtitle',
        'statistics',
        'why_choose_us_title',
        'why_choose_us_subtitle',
        'why_choose_us_image',
        'why_choose_us_image_alt',
        'features',
        'home_logo',
        'hero_title',
        'hero_subtitle',
        'hero_image',
    ];

    protected $casts = [
        'statistics' => 'array',
        'features' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the home settings instance (singleton pattern)
     */
    public static function getInstance()
    {
        return static::first() ?: static::create([
            'key_statistics_title' => 'Key Statistics',
            'key_statistics_subtitle' => 'Our achievements and milestones that demonstrate our commitment to excellence.',
            'why_choose_us_title' => 'Why Choose Chartered Insights',
            'why_choose_us_subtitle' => 'Partner with a firm that combines deep expertise, proven methodologies, and unwavering commitment to your success.',
            'why_choose_us_image' => null, // Will be set when user uploads an image
            'why_choose_us_image_alt' => 'Professional team collaboration',
            'statistics' => [
                ['label' => 'Happy Clients', 'value' => '100', 'icon' => 'users'],
                ['label' => 'Years Experience', 'value' => '15', 'icon' => 'calendar'],
                ['label' => 'Projects Completed', 'value' => '500', 'icon' => 'briefcase'],
                ['label' => 'Expert Team Members', 'value' => '25', 'icon' => 'team'],
            ],
            'features' => [
                [
                    'title' => 'Partner-Led Engagements',
                    'description' => 'Every assignment is directly supervised by a partner or senior professional to ensure quality, accountability, and strategic insight.',
                    'icon' => 'fa-solid fa-check',
                ],
                [
                    'title' => 'Deep Industry Expertise',
                    'description' => 'Specialized knowledge across multiple sectors, ensuring tailored solutions that address your industry-specific challenges.',
                    'icon' => 'fa-solid fa-check',
                ],
                [
                    'title' => 'Technology-Enabled Solutions',
                    'description' => 'Leveraging cutting-edge technology and digital tools to deliver efficient, accurate, and timely results.',
                    'icon' => 'fa-solid fa-check',
                ],
                [
                    'title' => 'Client-Centric Approach',
                    'description' => 'Building long-term partnerships through exceptional service, clear communication, and measurable results.',
                    'icon' => 'fa-solid fa-check',
                ],
            ],
        ]);
    }

    /**
     * Get default statistics
     */
    public function getStatisticsAttribute($value)
    {
        $decoded = json_decode($value, true);

        return $decoded ?: [];
    }

    /**
     * Get default features
     */
    public function getFeaturesAttribute($value)
    {
        $decoded = json_decode($value, true);

        return $decoded ?: [];
    }
}
