<?php

namespace App\Nova;

use Ebess\AdvancedNovaMediaLibrary\Fields\Media;
use Illuminate\Http\Request;
use Inspheric\Fields\Url;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaColorField\Color;
use Spatie\NovaTranslatable\Translatable;
use Spatie\TagsField\Tags;

class Portfolio extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Portfolio::class;

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

    public static function label()
    {
        return 'Portfolio';
    }

    public static function singularLabel()
    {
        return 'Project';
    }

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
                ])->hideFromIndex()->hideFromDetail(),
            Translatable::make([
                Text::make('Title', 'title'),
                Text::make('Type')->hideFromIndex(),
                Markdown::make('Summary'),
                Markdown::make('Description'),
            ]),
            Date::make('Published At')->sortable(),
            Boolean::make('Is Pinned?', 'is_pinned')->hideFromIndex(),
            Boolean::make('Is Published?', 'is_published')->hideFromIndex(),
            Tags::make('Technologies', 'tags')->hideFromIndex(),
            Code::make('Links')->json(),
            Media::make('Media', 'portfolio')
                ->customPropertiesFields([
                    Markdown::make('Description'),
                ])
                ->setFileName(function ($originalFilename, $extension) {
                    return md5($originalFilename).'.'.$extension;
                })
                ->hideFromIndex(),

            /*Url::make('View')
                ->alwaysClickable()
                ->label('s')
                ->titleUsing(function ($value, $resource) {
                    return $this->is_published ? $this->internal : $this->preview;
                })
                /*->default(function () {
                    return $this->is_published ? $this->internal : $this->preview;
                })*/
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->reorder()->orderByDesc('published_at');
    }
}
