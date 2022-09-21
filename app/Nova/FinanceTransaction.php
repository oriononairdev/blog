<?php

namespace App\Nova;

use App\Enums\TransactionType;
use App\Nova\Metrics\TransactionsPerCategory;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Spatie\TagsField\Tags;
use Vyuldashev\NovaMoneyField\Money;

class FinanceTransaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\FinanceTransaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'amount',
    ];

    public static function label()
    {
        return 'Transactions';
    }

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['account', 'category'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $types = [];
        foreach (TransactionType::cases() as $type) {
            $types[$type->value] = $type->value;
        }

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Select::make('Type')->options($types)->rules(['required']),
            Money::make('Amount', $this->account->currency ?? 'TRY')->locale('tr')
                ->storedInMinorUnits()
                ->sortable()->rules(['required']),
            Text::make('Description')->hideFromIndex(),
            BelongsTo::make('Account', 'account', FinanceAccount::class)->sortable(),
            BelongsTo::make('Category', 'category', FinanceCategory::class)->sortable()->searchable(),
            Date::make('Date')->sortable()->rules(['required']),
            Tags::make('Tags')->hideFromIndex(),
        ];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->reorder()->orderByDesc('date');
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new TransactionsPerCategory)->width('full'),
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\Date,
        ];
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
