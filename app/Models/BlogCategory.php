<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogCategory extends Model
{
    use HasSlug;

    /**
     * Get the comments for the blog post.
     */
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'category_id');
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function postCount()
    {
        return $this->hasMany(BlogPost::class, 'categoryID', 'id')->count();
    }

    /**
     * Name accessor.
     *
     * @return string|null
     */
    public function getLowerNameAttribute(): ?string
    {
        return Str::lower($this->name);
    }

    /**
     * Summary Markdown accessor.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getRawNameAttribute(): ?string
    {
        return $this->getRawOriginal('name');
    }
}
