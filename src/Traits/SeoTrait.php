<?php

namespace  Sashagm\Seo\Traits;


use Exception;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Blade;

trait SeoTrait
{
    public function bootSeo()
    {


        Blade::directive('meta', function ($arguments) {
            $args = explode(',', $arguments);
            $key = trim($args[0], "'");
            $description = isset($args[1]) ? trim($args[1], "'") : null;
            $og_description = isset($args[2]) ? trim($args[2], "'") : null;

            if (!$key) {
                throw new Exception("Seo configuration error: key not set!");
            }

            $page_meta = app(\Sashagm\Seo\Services\MetaService::class)->getPageMeta($key, $description, $og_description);

            // Get meta tags from .env file
            $og_type = config('seo.og_type') ?? throw new Exception('og_type value is missing in seo.php');
            $og_locale = config('seo.og_locale') ?? throw new Exception('og_locale value is missing in seo.php');
            $og_site_name = config('seo.og_site_name') ?? throw new Exception('og_site_name value is missing in seo.php');
            $og_image = config('seo.og_image') ?? throw new Exception('og_image value is missing in seo.php');

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

