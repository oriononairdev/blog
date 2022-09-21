<?php

namespace App\Models\Presenters;

use App\Models\Post;
use Illuminate\Support\Str;
use Spatie\LaravelMarkdown\MarkdownRenderer;

trait PostPresenter
{
    /**
     * Summary accessor.
     *
     * @param  string|null  $value
     * @return string|null
     */
    public function getSummaryAttribute(?string $value): ?string
    {
        return $value ? app(MarkdownRenderer::class)->toHtml($value) : '';
    }

    public function getPlainSummaryAttribute(): string
    {
        return strip_tags(trim(preg_replace('/\s+/', ' ', $this->summary)));
    }

    /**
     * Summary Markdown accessor.
     *
     * @param  string  $value
     * @return string|null
     */
    public function getSummaryMarkdownAttribute(): ?string
    {
        return $this->getRawOriginal('summary');
    }

    /**
     * @param $value
     * @return void
     */
    public function setSummaryMarkdownAttribute($value): void
    {
        $this->summary = $value;
    }

    /**
     * Content accessor.
     *
     * @param  string  $value
     * @return string
     */
    public function getContentAttribute(string $value): ?string
    {
        return app(MarkdownRenderer::class)->toHtml($value);
    }

    /**
     * Markdown accessor.
     *
     * @return string
     */
    public function getMarkdownAttribute(): ?string
    {
        return $this->getRawOriginal('content');
    }

    /**
     * @param $value
     * @return void
     */
    public function setMarkdownAttribute($value): void
    {
        $this->content = $value;
    }

    public function getPlainContentAttribute(): string
    {
        return strip_tags(trim(preg_replace('/\s+/', ' ', $this->content)));
    }

    /**
     * Get url for the post.
     *
     *
     * @return string
     */
    public function getUrlAttribute(): ?string
    {
        return route('blog.single', [$this->id ?? 'xx', $this->slug ?? 'new-post']);
    }

    /**
     * Get preview url for the post.
     *
     * @return string|null
     */
    public function getPreviewUrlAttribute(): ?string
    {
        return $this->url.'?preview='.$this->preview_secret;
    }

    /**
     * Get tags for the post.
     *
     *
     * @return string
     */
    public function getAllTagsAttribute(): ?string
    {
        return $this->tags->pluck('name');
    }

    /**
     * Get domain from external_url.
     *
     *
     * @return string
     */
    public function getDomainAttribute(): ?string
    {
        return parse_url($this->external_url, PHP_URL_HOST);
    }

    public function getReadingTimeAttribute(): int
    {
        return (int) ceil(str_word_count(strip_tags($this->content)) / 200);
    }

    /**
     * Type lower accessor.
     *
     * @return string|null
     */
    public function getTypeLowerAttribute(): ?string
    {
        return Str::lower($this->type);
    }

    /**
     * Type lower accessor.
     *
     * @return string|null
     */
    public function getCategoryNameAttribute(): ?string
    {
        return Str::ucfirst($this->category->name);
    }
}
