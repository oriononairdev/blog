<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPage extends Model
{
    use HasFactory;
    use HasSlug;

    protected $casts = [
        'setup' => 'array',
        'widgets' => 'array',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Content accessor.
     *
     * @param  string|null  $value
     * @return string|null
     */
    public function getContentAttribute(?string $value): ?string
    {
        return $value ? app(MarkdownRenderer::class)->toHtml($value) : '';
    }

    /**
     * Markdown accessor.
     *
     * @return string|null
     */
    public function getRawContentAttribute(): ?string
    {
        return $this->getRawOriginal('content');
    }

    /**
     * @param $value
     * @return void
     */
    public function setRawContentAttribute($value): void
    {
        $this->content = $value;
    }

    /**
     * Text accessor.
     *
     * @return string|null
     */
    public function getLowerTitleAttribute(): ?string
    {
        return Str::lower($this->title);
    }
}
