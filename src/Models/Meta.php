<?php

namespace Sashagm\Seo\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = ['key', 'keywords', 'description', 'additional_description'];

}
