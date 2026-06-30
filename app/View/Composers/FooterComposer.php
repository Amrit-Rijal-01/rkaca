<?php

namespace App\View\Composers;

use App\Models\FooterSetting;
use Illuminate\View\View;

class FooterComposer
{
    /**
     * Bind data to the view.
     */
    public function compose(View $view): void
    {
        $view->with('footerSetting', FooterSetting::getInstance());
    }
}
