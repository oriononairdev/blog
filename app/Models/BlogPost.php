<?php

namespace App\Models;

use App\Http\Requests\PostRequest;
use App\Models\Presenters\PostPresenter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use JsonException;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Tags\HasTags;

class BlogPost extends Model implements HasMedia
{
    use InteractsWithMedia,
        HasFactory,
        HasSlug,
        HasTags,
        PostPresenter;

    public const TYPE_LINK = 'Link';

    public const TYPE_ORIGINAL = 'Original';

    public $with = ['tags', 'category', 'webmentions'];

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
        'lang' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'published_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->width(368)
            ->height(232)
            ->sharpen(10)
            ->nonQueued();
    }

    public static function booted()
    {
        static::creating(function (BlogPost $post) {
            $post->preview_secret = Str::random(10);
        });
    }

    public function webmentions(): HasMany
    {
        return $this->hasMany(Webmention::class)->latest();
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
     * Update model attributes from the form.
     *
     * @return static
     *
     * @throws JsonException
     */
    public function updateAttributes(PostRequest $request): static
    {
        $this->update($request->validated());
        if ($request->input('tags')) {
            $tags = json_decode($request->input('tags'), true, 512, JSON_THROW_ON_ERROR);
            $tagsArr = [];
            foreach ($tags as $tag) {
                $tagsArr[] = strtolower(trim($tag['value']));
            }
            $this->syncTags($tagsArr);
        }
        if (! $request->input('is_pinned')) {
            $this->is_pinned = 0;
            $this->save();
        }

        return $this;
    }

    /**
     * Update model attributes from the form.
     *
     * @return static
     *
     * @throws JsonException
     */
    public function syncSaveTags(PostRequest $request): static
    {
        if ($request->input('tags')) {
            $tags = json_decode($request->input('tags'), true, 512, JSON_THROW_ON_ERROR);
            $tagsArr = [];
            foreach ($tags as $tag) {
                $tagsArr[] = strtolower(trim($tag['value']));
            }
            $this->syncTags($tagsArr);
        }

        return $this;
    }

    /**
     * Get the category that owns the post.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(BlogCategory::class, 'category_id', 'id');
    }

    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection|array
    {
        return BlogCategory::all();
    }

    /**
     * Scope a query to only include published posts.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('status', 'Published');
    }

    /**
     * Scope a query to only include posts in current locale.
     *
     * @param  Builder  $query
     * @return void
     */
    public function scopeLocalized(Builder $query): void
    {
        $query->whereJsonContains('lang', App::currentLocale());
    }

    public function isDev(): bool
    {
        $dev = BlogCategory::where('name', 'Dev')->first();

        return $this->category()->is($dev);
    }

    public function isPublished(): bool
    {
        return $this->status === 'Published';
    }

    public function isOriginal(): bool
    {
        return $this->type === static::TYPE_ORIGINAL;
    }

    public function isLink(): bool
    {
        return $this->type === static::TYPE_LINK;
    }
}
