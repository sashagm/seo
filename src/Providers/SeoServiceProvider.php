<?php

namespace Sashagm\Seo\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class SeoServiceProvider extends ServiceProvider
{
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

        Blade::directive('meta', function ($arguments) {
            $args = explode(',', $arguments);
            $key = trim($args[0], "'");
            $description = isset($args[1]) ? trim($args[1], "'") : null;
            $og_description = isset($args[2]) ? trim($args[2], "'") : null;
            $page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta($key, $description, $og_description);
            $output = '
    <meta name="keywords" content="' . $page_meta['keywords'] . '" >
    ' .
    '<meta name="description" content="' . $page_meta['description'] . '">
    ' .
    '<meta name="robots" content="' . $page_meta['robots'] . '"> 
    '.
    '<meta property="og:title" content="' . $page_meta['og_title'] . '">
    '.
    '<meta property="og:description" content="' . $page_meta['og_description'] . '">
    ';
            return $output;
        });

    }
}
