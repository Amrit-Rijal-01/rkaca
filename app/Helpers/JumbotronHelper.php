<?php

namespace App\Helpers;

use App\Models\Jumbotron;
use Illuminate\Support\Facades\Cache;

class JumbotronHelper
{
    /**
     * Get jumbotron data for a specific page
     *
     * @param  string  $pageSlug
     * @return object|null
     */
    public static function getJumbotron($pageSlug)
    {
        return Cache::remember("jumbotron_{$pageSlug}", 3600, function () use ($pageSlug) {
            return Jumbotron::getByPageSlug($pageSlug);
        });
    }

    /**
     * Get slides for a specific page (for multi-slide pages)
     *
     * @param  string  $pageSlug
     * @return \Illuminate\Support\Collection
     */
    public static function getSlides($pageSlug)
    {
        return Cache::remember("slides_{$pageSlug}", 3600, function () use ($pageSlug) {
            return Jumbotron::getSlidesByPageSlug($pageSlug);
        });
    }

    /**
     * Check if a page supports multi-slide functionality
     *
     * @param  string  $pageSlug
     * @return bool
     */
    public static function isMultiSlidePage($pageSlug)
    {
        return Jumbotron::isMultiSlidePage($pageSlug);
    }

    /**
     * Get jumbotron data with fallback defaults
     *
     * @param  string  $pageSlug
     * @param  array  $fallback
     * @return object
     */
    public static function getJumbotronWithFallback($pageSlug, $fallback = [])
    {
        // For multi-slide pages, get the first slide or use fallback
        if (self::isMultiSlidePage($pageSlug)) {
            $slides = self::getSlides($pageSlug);
            $jumbotron = $slides->first();
        } else {
            $jumbotron = self::getJumbotron($pageSlug);
        }

        if (! $jumbotron) {
            // Create default jumbotron object if none exists
            $defaults = array_merge([
                'title' => 'Welcome to Chartered Insights',
                'subtitle' => 'Your trusted partner for comprehensive business solutions.',
                'background_image_url' => 'https://images.unsplash.com/photo-1464983953574-0892a716854b?q=80&w=1600&auto=format&fit=crop',
            ], $fallback);

            return (object) $defaults;
        }

        return $jumbotron;
    }

    /**
     * Clear cache for a specific jumbotron
     *
     * @param  string  $pageSlug
     * @return void
     */
    public static function clearCache($pageSlug)
    {
        Cache::forget("jumbotron_{$pageSlug}");
        Cache::forget("slides_{$pageSlug}");
    }

    /**
     * Clear all jumbotron cache
     *
     * @return void
     */
    public static function clearAllCache()
    {
        $pages = array_keys(Jumbotron::getAvailablePageSlugs());

        foreach ($pages as $page) {
            Cache::forget("jumbotron_{$page}");
            Cache::forget("slides_{$page}");
        }
    }

    /**
     * Get jumbotron component HTML
     *
     * @param  string  $pageSlug
     * @param  array  $options
     * @return string
     */
    public static function renderJumbotron($pageSlug, $options = [])
    {
        $height = $options['height'] ?? '60vh';
        $minHeight = $options['min_height'] ?? '60vh';
        $overlayOpacity = $options['overlay_opacity'] ?? '40';
        $textColor = $options['text_color'] ?? 'crisp-white';

        // Check if this is a multi-slide page
        if (self::isMultiSlidePage($pageSlug)) {
            $slides = self::getSlides($pageSlug);

            return view('components.jumbotron-slider', compact(
                'slides',
                'pageSlug',
                'height',
                'minHeight',
                'overlayOpacity',
                'textColor'
            ))->render();
        } else {
            $jumbotron = self::getJumbotronWithFallback($pageSlug);

            return view('components.jumbotron', compact(
                'jumbotron',
                'height',
                'minHeight',
                'overlayOpacity',
                'textColor'
            ))->render();
        }
    }
}
