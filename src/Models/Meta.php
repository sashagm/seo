<?php

namespace Sashagm\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'keywords',
        'description',
        'additional_description',
        'robots',
        'og_title',
        'og_description',
    ];


    public function getRobotsAttribute($value)
    {
        return $value ?? 'index,follow';
    }

    public function getOgTitleAttribute($value)
    {
        return $value ?? $this->title;
    }

    public function getOgDescriptionAttribute($value)
    {
        return $value ?? $this->description;
    }


}
