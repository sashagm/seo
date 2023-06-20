<?php

namespace Sashagm\Seo\Providers;

use Sashagm\Seo\Traits\SeoTrait;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{

    use SeoTrait;

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->mergeConfigFrom(
            __DIR__.'/../config/seo.php', 'seo'
        );

        $this->bootSeo();

    }

    
}
