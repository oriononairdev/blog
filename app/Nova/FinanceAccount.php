<?php

namespace App\Nova;

use App\Enums\AccountStatus;
use App\Enums\AccountType;
use App\Nova\Metrics\Balance;
use App\Nova\Metrics\BalancePerAccount;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Vyuldashev\NovaMoneyField\Money;

class FinanceAccount extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\FinanceAccount::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'type', 'balance',
    ];

    public static function label()
    {
        return 'Accounts';
    }

    /**
     * The relationships that should be eager loaded on index queries.
     *
     * @var array
     */
    public static $with = ['transactions'];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $currencies = $types = $statuses = [];
        foreach (\App\Models\FinanceCurrency::all()->pluck('code') as $code) {
            $currencies[$code] = $code;
        }
        foreach (AccountType::cases() as $type) {
            $types[$type->value] = $type->value;
        }
        foreach (AccountStatus::cases() as $status) {
            $statuses[$status->value] = $status->value;
        }

        return [
            ID::make(__('ID'), 'id')->sortable(),
            Text::make('Name')->sortable(),
            Select::make('Status')->options($statuses)->sortable(),
            Select::make('Type')->options($types)->sortable(),
            Money::make('Balance', $this->currency ?? 'USD')->locale('tr')->storedInMinorUnits()->sortable(),
            Select::make('Currency')->options($currencies)->sortable()->onlyOnForms(),
            HasMany::make('Transactions', 'transactions', FinanceTransaction::class),
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
        return [
            new Balance,
            (new BalancePerAccount)->width('2/3'),
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

    /**
     * Get currency symbol.
     *
     * @return string
     */
    public function getCurrencySymbol(): string
    {
        return match ($this->currency) {
            'USD' => '$',
            default => '₺',
        };
    }
}
