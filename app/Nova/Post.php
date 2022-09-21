<?php

namespace App\Nova;

use App\Models\BlogPost;
use Ebess\AdvancedNovaMediaLibrary\Fields\Files;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Panel;
use Outl1ne\NovaColorField\Color;
use Spatie\TagsField\Tags;

class Post extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = BlogPost::class;

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Blog';

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['webmentions'];

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'title',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make(__('ID'), 'id')->sortable(),
            Color::make('Color')
                ->compact()
                ->palette([
                    '#7DD3FC', '#F87171', '#cbd5e0',
                    '#FDE047', '#FDBA74', '#A5B4FC',
                    '#6EE7B7', '#93C5FD',
                ])->hideFromIndex(),
            Text::make('Title')->sortable()->rules('required')
                ->displayUsing(function (string $title) {
                    return Str::limit($title, 44);
                })->hideFromDetail(),
            Text::make('Title')->onlyOnDetail()->displayUsing(function (string $title) {
                $url = $this->status === 'Published' ? $this->url : $this->previewurl;

                return '<a href="'.$url.'" target="_blank" class="no-underline dim text-primary font-bold">'.$title.'</a>';
            })->asHtml(),
            Select::make('Type')->options([
                'Original' => 'Original',
                'Link' => 'Link',
            ])->rules('required')->hideFromIndex()/*->withMeta(["value" => '0'])*/,
            BelongsTo::make('Category')->sortable(),
            Code::make('Languages', 'lang')->json(),

            new Tabs('Post', [
                'Content' => [
                    new Panel('Content', $this->contentFields()),
                ],
                'Gallery' => [
                    Images::make('Images', 'blog_images')
                    ->setFileName(function ($originalFilename, $extension) {
                        return md5($originalFilename).'.'.$extension;
                    })
                        ->enableExistingMedia()
                        ->hideFromIndex(),
                ],
                'Meta' => [
                    new Panel('Meta', $this->metaFields()),
                ],
                'Files' => [
                    Files::make('Files', 'multiple_files'),
                ],
            ]),
        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return array
     */
    protected function contentFields()
    {
        return [
            Markdown::make('Summary', 'summarymarkdown')->rules('required'),
            Markdown::make('Content', 'markdown')->rules('required'),
        ];
    }

    /**
     * Get the meta fields for the resource.
     *
     * @return array
     */
    protected function metaFields()
    {
        return [
            Tags::make('Tags')->hideFromIndex(),
            Url::make('Tweet Url')->alwaysClickable()->label('Twitter')->hideFromIndex(),
            Url::make('External Url')->alwaysClickable()->label('External')->hideFromIndex(),
            Select::make('Status', 'status')->options([
                'Published' => 'Published',
                'Draft' => 'Draft',
                'Archived' => 'Archived',
            ])->sortable()->rules('required'),
            Date::make('Published At')->sortable()->rules('required'),
            Boolean::make('Is Pinned?', 'is_pinned')->hideFromIndex(),
            Url::make('', function () {
                return $this->status === 'Published' ? $this->url : $this->previewurl;
            })->alwaysClickable()->label(' ')->onlyOnIndex(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
