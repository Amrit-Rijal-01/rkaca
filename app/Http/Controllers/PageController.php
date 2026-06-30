<?php

namespace App\Http\Controllers;

use App\Models\FooterSetting;
use App\Models\HomeSetting;
use App\Models\Insight;
use App\Models\InsightCategory;
use App\Models\Page;

class PageController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'home')->active()->first();
        $homeSetting = HomeSetting::getInstance();
        $footerSetting = FooterSetting::getInstance();

        // dd($homeSetting, $footerSetting);
        return view('home', compact('page', 'homeSetting', 'footerSetting'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->active()->first();

        return view('about', compact('page'));
    }

    public function insights()
    {
        $page = Page::where('slug', 'insights')->active()->first();

        return view('insights', compact('page'));
    }

    public function insightDetail($slug)
    {
        $insight = Insight::where('slug', $slug)
            ->published()
            ->with('insightCategory')
            ->firstOrFail();

        // Get related insights (same category, exclude current)
        $relatedInsights = Insight::published()
            ->byCategory($insight->category_slug)
            ->where('id', '!=', $insight->id)
            ->limit(3)
            ->get();

        return view('insight-detail', compact('insight', 'relatedInsights'));
    }

    public function insightsByCategory($categorySlug)
    {
        $category = InsightCategory::where('slug', $categorySlug)
            ->active()
            ->firstOrFail();

        $insights = Insight::published()
            ->byCategory($categorySlug)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        return view('insights-category', compact('category', 'insights'));
    }

    public function show($slug)
    {
        $page = Page::where('slug', $slug)->active()->firstOrFail();

        return view('page', compact('page'));
    }
}
