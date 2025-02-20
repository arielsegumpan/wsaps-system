<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BlogCategory extends Model
{
    protected $fillable = [
        'cat_name',
        'cat_slug',
        'cat_description',
        'cat_is_visible',
    ];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function blogPosts() : HasMany
    {
        return $this->hasMany(BlogPost::class);
    }
}
