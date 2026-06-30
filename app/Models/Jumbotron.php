<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Jumbotron extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_slug',
        'title',
        'subtitle',
        'background_image_url',
        'button_text',
        'button_link',
        'is_active',
        'is_multi_slide',
        'sort_order',
        'slide_order',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_multi_slide' => 'boolean',
    ];

    /**
     * Boot the model and register model events
     */
    protected static function boot()
    {
        parent::boot();

        // Clear cache when jumbotron is created, updated, or deleted
        static::saved(function ($jumbotron) {
            Cache::forget("jumbotron_{$jumbotron->page_slug}");
            Cache::forget("jumbotrons_{$jumbotron->page_slug}");
        });

        static::deleted(function ($jumbotron) {
            Cache::forget("jumbotron_{$jumbotron->page_slug}");
            Cache::forget("jumbotrons_{$jumbotron->page_slug}");
        });
    }

    /**
     * Get jumbotron by page slug (for single slide pages)
     */
    public static function getByPageSlug($slug)
    {
        return static::where('page_slug', $slug)
            ->where('is_active', true)
            ->where('is_multi_slide', false)
            ->orderBy('sort_order')
            ->first();
    }

    /**
     * Get all slides for a page (for multi-slide pages like home)
     */
    public static function getSlidesByPageSlug($slug)
    {
        return static::where('page_slug', $slug)
            ->where('is_active', true)
            ->where('is_multi_slide', true)
            ->orderBy('slide_order')
            ->get();
    }

    /**
     * Check if a page uses multi-slide setup
     */
    public static function isMultiSlidePage($slug)
    {
        return static::where('page_slug', $slug)
            ->where('is_multi_slide', true)
            ->exists();
    }

    /**
     * Get next slide order for a page
     */
    public static function getNextSlideOrder($pageSlug)
    {
        $lastOrder = static::where('page_slug', $pageSlug)
            ->where('is_multi_slide', true)
            ->max('slide_order');

        return ($lastOrder ?? 0) + 1;
    }

    /**
     * Get all available page slugs for admin dropdown
     */
    public static function getAvailablePageSlugs()
    {
        return [
            'home' => 'Home Page',
            'about' => 'About Us',
            'services' => 'Services',
            'industries' => 'Industries',
            'insights' => 'Insights & Articles',
            'careers' => 'Careers',
            'contact' => 'Contact Us',
            'offices' => 'Our Offices',
            'events' => 'Events',
            'blogs' => 'Blog Articles',
        ];
    }

    /**
     * Get pages that support multi-slide
     */
    public static function getMultiSlidePages()
    {
        return [
            'home' => 'Home Page',
        ];
    }

    /**
     * Check if page supports multi-slide
     */
    public static function supportsMultiSlide($pageSlug)
    {
        return array_key_exists($pageSlug, static::getMultiSlidePages());
    }
}
