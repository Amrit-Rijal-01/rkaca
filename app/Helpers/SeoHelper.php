<?php

namespace App\Helpers;

use App\Models\FooterSetting;
use Illuminate\Support\Str;

class SeoHelper
{
    private static bool $rendered = false;

    /**
     * Check if SEO meta tags have been rendered for this request.
     */
    public static function hasRendered(): bool
    {
        return self::$rendered;
    }

    /**
     * Generate HTML meta tags for SEO.
     *
     * @param  string  $title  Page title (will be suffixed with company name)
     * @param  string  $description  Page description
     * @param  string  $keywords  Page keywords
     * @param  string|null  $ogImage  URL of Open Graph image
     */
    public static function meta(string $title, string $description = '', string $keywords = '', ?string $ogImage = null): string
    {
        self::$rendered = true;

        $footerSetting = FooterSetting::getInstance();
        $companyName = $footerSetting->company_name ?? 'Roshan Kumar & Associates';
        $companyTagline = $footerSetting->company_tagline ?? 'Chartered Accountants';

        // Prepare values
        $cleanTitle = strip_tags($title);
        $fullTitle = $cleanTitle ? "{$cleanTitle} | {$companyName}" : "{$companyName} - {$companyTagline}";

        $cleanDescription = $description ? strip_tags($description) : 'Leading Chartered Accountancy firm providing comprehensive audit, tax, risk advisory, and business consulting services.';
        $shortDescription = Str::limit($cleanDescription, 155);

        $cleanKeywords = strip_tags($keywords) ?: 'chartered accountants, audit services, tax consultation, business advisory, risk management, financial consultants, Nepal';

        // Build HTML output
        $html = [];
        $html[] = '    <title>'.e($fullTitle).'</title>';
        $html[] = '    <meta name="description" content="'.e($shortDescription).'">';
        $html[] = '    <meta name="keywords" content="'.e($cleanKeywords).'">';

        // Open Graph / Facebook
        $html[] = '    <meta property="og:title" content="'.e($cleanTitle ?: $companyName).'">';
        $html[] = '    <meta property="og:description" content="'.e($shortDescription).'">';
        $html[] = '    <meta property="og:type" content="website">';
        $html[] = '    <meta property="og:url" content="'.e(url()->current()).'">';
        if ($ogImage) {
            $html[] = '    <meta property="og:image" content="'.e($ogImage).'">';
        }

        // Twitter Card
        $html[] = '    <meta name="twitter:card" content="summary_large_image">';
        $html[] = '    <meta name="twitter:title" content="'.e($cleanTitle ?: $companyName).'">';
        $html[] = '    <meta name="twitter:description" content="'.e($shortDescription).'">';
        if ($ogImage) {
            $html[] = '    <meta name="twitter:image" content="'.e($ogImage).'">';
        }

        return implode("\n", $html)."\n";
    }
}
