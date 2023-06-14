<?php

return [
    'og_type'               => env('APP_OG_TYPE'),
    'og_locale'             => env('APP_OG_LOCALE'),
    'og_site_name'          => env('APP_NAME'),
    'og_image'              => env('APP_OG_IMAGE'),

    'default'               => [
        'keywords'      => env('APP_KEYWORDS'),
        'description'   => env('APP_DESC'),
        'robots'        => env('APP_ROBOTS'),
        'og_title'       => env('APP_OG_TITLE'),
        'og_description' => env('APP_OG_DESC'),
    ],


];
