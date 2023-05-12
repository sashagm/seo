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
    
    public function getPageMeta($page, $additional_description = null)
    {
        $meta = Meta::where('key', $page)->first();
    
        if ($additional_description) {
            return [
                'keywords' => $meta ? $meta->keywords : null,
                'description' => $additional_description,
            ];
        }
    
        return [
            'keywords' => $meta ? $meta->keywords : null,
            'description' => $meta ? $meta->description : null,
        ];
    }
    
    public function setPageMeta($page, $data)
    {
        $meta = Meta::updateOrCreate(['key' => $page], [
            'keywords' => isset($data['keywords']) ? $data['keywords'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'additional_description' => isset($data['additional_description']) ? $data['additional_description'] : null,
        ]);
    
        return [
            'keywords' => $meta->keywords,
            'description' => $meta->description,
            'additional_description' => $meta->additional_description,
        ];
    }
    


}
