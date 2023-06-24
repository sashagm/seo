<?php

namespace Sashagm\Seo\Services;

use Sashagm\Seo\Models\Meta;

class MetaService
{
    public function get($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->value : null;
    }

    public function set($key, $value)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['value' => $value]);

        return $meta->value;
    }


    public function getKeywords($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->keywords : null;
    }

    public function setKeywords($key, $keywords)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['keywords' => $keywords]);

        return $meta->keywords;
    }

    public function getDescription($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->description : null;
    }

    public function setDescription($key, $description)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['description' => $description]);

        return $meta->description;
    }

    public function getRobots($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->robots : null;
    }

    public function setRobots($key, $robots)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['robots' => $robots]);

        return $meta->robots;
    }

    public function getOgTitle($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->og_title : null;
    }

    public function setOgTitle($key, $og_title)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['og_title' => $og_title]);

        return $meta->og_title;
    }

    public function getOgDescription($key)
    {
        $meta = Meta::where('key', $key)->first();

        return $meta ? $meta->og_description : null;
    }

    public function setOgDescription($key, $og_description)
    {
        $meta = Meta::updateOrCreate(['key' => $key], ['og_description' => $og_description]);

        return $meta->og_description;
    }

    public function getPageMeta($page, $additional_description = null, $ogDescription = null)
    {
        $meta = Meta::where('key', $page)->first();

        if (!$meta) {
            $meta = [
                'keywords' => config('seo.default.keywords'),
                'description' => config('seo.default.description'),
                'robots' => config('seo.default.robots'),
                'og_title' => config('seo.default.og_title'),
                'og_description' => config('seo.default.og_description'),
            ];
        } else {
            $meta = [
                'keywords' => $meta->keywords,
                'description' => $meta->description,
                'robots' => $meta->robots,
                'og_title' => $meta->og_title,
                'og_description' => $meta->og_description,
            ];
        }

        if ($additional_description) {
            $meta['description'] = $additional_description;
        }

        if ($ogDescription) {
            $meta['og_description'] = $ogDescription;
        }

        return $meta;
    }

    public function setPageMeta($page, $data)
    {
        $meta = Meta::updateOrCreate(['key' => $page], [
            'keywords' => isset($data['keywords']) ? $data['keywords'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'additional_description' => isset($data['additional_description']) ? $data['additional_description'] : null,
            'robots' => isset($data['robots']) ? $data['robots'] : null,
            'og_title' => isset($data['og_title']) ? $data['og_title'] : null,
            'og_description' => isset($data['og_description']) ? $data['og_description'] : null,
        ]);

        return [
            'keywords' => $meta->keywords,
            'description' => $meta->description,
            'additional_description' => $meta->additional_description,
            'robots' => $meta->robots,
            'og_title' => $meta->og_title,
            'og_description' => $meta->og_description,
        ];
    }
}
