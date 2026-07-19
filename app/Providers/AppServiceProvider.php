<?php

namespace App\Providers;

use App\Models\ContactInformation;
use App\View\Composers\FooterComposer;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register versioned asset helper directive
        \Illuminate\Support\Facades\Blade::directive('versionedAsset', function ($expression) {
            return "<?php echo \App\Helpers\AssetHelper::versioned($expression); ?>";
        });

        // Register view composers
        View::composer('partials.footer', FooterComposer::class);
        View::composer('new.layouts.sidebar', \App\View\Composers\SidebarComposer::class);
        view::composer('*', function ($view) {
            $contactInfo = Cache::remember('contact_info', 60 * 60 * 24, function () {
                return ContactInformation::first();
            });
            $view->with('contactInfo', $contactInfo);
        });
    }
}
