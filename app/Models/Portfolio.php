<?php

namespace App\Models;

use ArrayAccess;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;
use Spatie\Tags\Tag;
use Spatie\Translatable\HasTranslations;

class Portfolio extends Model implements HasMedia
{
    use InteractsWithMedia,
        HasFactory,
        HasSlug,
        HasTags,
        HasTranslations;

    public array $translatable = ['title', 'type', 'summary', 'description'];

    public $with = ['tags', 'media'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'portfolio';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'links' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    public static function booted()
    {
        static::creating(function (Portfolio $project) {
            $project->preview_secret = Str::random(10);
        });
    }

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
     * Get the internal url for the project.
     *
     *
     * @return string|null
     */
    public function getInternalAttribute(): ?string
    {
        return route('portfolio.show', [$this->id ?? 'xx', $this->slug ?? 'new-post']);
    }

    /**
     * Get the preview url for the project.
     *
     *
     * @return string|null
     */
    public function getPreviewAttribute(): ?string
    {
        return $this->internal.'?preview='.$this->preview_secret;
    }

    /**
     * Summary html accessor.
     *
     * @return string
     */
    public function getSummaryHtmlAttribute(): string
    {
        return app(MarkdownRenderer::class)->toHtml($this->summary);
    }

    /**
     * Description html accessor.
     *
     * @return string
     */
    public function getDescriptionHtmlAttribute(): string
    {
        return app(MarkdownRenderer::class)->toHtml($this->description);
    }

    /**
     * Scope a query to only include published projects.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', 1);
    }

    public function scopeWithAllEnTags(
        Builder $query,
        array | ArrayAccess | Tag $tags,
        string $type = null,
    ): Builder {
        $tags = static::convertToTags($tags, $type, 'en');

        collect($tags)->each(function ($tag) use ($query) {
            $query->whereHas('tags', function (Builder $query) use ($tag) {
                $query->where('tags.id', $tag->id ?? 0);
            });
        });

        return $query;
    }
}
