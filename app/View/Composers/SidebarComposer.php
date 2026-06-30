<?php

namespace App\View\Composers;

use App\Models\FooterSetting;
use App\Models\HomeSetting;
use App\Models\NavigationSetting;
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
        ]);
    }
}
