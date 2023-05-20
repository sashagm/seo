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
        $this->mergeConfigFrom(
            __DIR__.'/../config/seo.php', 'seo'
        );

        Blade::directive('meta', function ($arguments) {
            $args = explode(',', $arguments);
            $key = trim($args[0], "'");
            $description = isset($args[1]) ? trim($args[1], "'") : null;
            $og_description = isset($args[2]) ? trim($args[2], "'") : null;
            $page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta($key, $description, $og_description);
            
            // Get meta tags from .env file
            $og_type = config('seo.og_type');
            $og_locale = config('seo.og_locale');
            $og_site_name = config('seo.og_site_name');
            $og_image = config('seo.og_image');

            // Get current url 
            $canonical_url = url()->current();

            // Add meta tags to output
            $output = '
    <meta name="keywords" content="' . $page_meta['keywords'] . '" >
    <meta name="description" content="' . $page_meta['description'] . '">
    <meta name="robots" content="' . $page_meta['robots'] . '"> 
    <meta property="og:type" content="' . $og_type . '">
    <meta property="og:locale" content="' . $og_locale . '">
    <meta property="og:site_name" content="' . $og_site_name . '">
    <meta property="og:image" content="' . $og_image . '">
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
    <meta property="og:image:secure_url" content="' . $og_image . '">
    <meta property="og:title" content="' . $page_meta['og_title'] . '">
    <meta property="og:description" content="' . $page_meta['og_description'] . '">
    <link rel="canonical" href="' . $canonical_url . '">
        ';
            return $output;
        });

    }

    
}
