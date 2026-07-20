<?php

namespace App\View\Composers;

use App\Models\Event;
use App\Models\FooterSetting;
use App\Models\HomeSetting;
use App\Models\Industry;
use App\Models\Insight;
use App\Models\NavigationSetting;
use App\Models\Post;
use App\Models\Service;
use Illuminate\View\View;

class SidebarComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with([
            'homeSetting' => HomeSetting::getInstance(),
            'footerSetting' => FooterSetting::getInstance(),
            'navigationItems' => NavigationSetting::getSidebarNavigation(),
            'servicesNavItems' => Service::active()->topLevel()->ordered()->take(4)->get(),
            'industriesNavItems' => Industry::active()->ordered()->take(4)->get(),
            'postsNavItems' => Post::published()->orderBy('published_at', 'desc')->take(4)->get(),
            'eventsNavItems' => Event::active()->orderBy('start_date', 'asc')->take(4)->get(),
            'insightsNavItems' => Insight::published()->orderBy('published_at', 'desc')->take(4)->get(),
        ]);
    }
}
