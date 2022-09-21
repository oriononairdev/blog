<?php

namespace App\Nova\Metrics;

use App\Models\FinanceAccount;
use Illuminate\Database\Query\Expression;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;

class BalanceTrend extends Trend
{
    /**
     * The value's precision when rounding.
     *
     * @var int
     */
    public $precision = 2;

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        // https://stackoverflow.com/questions/67115962/use-a-model-resource-attribute-accessor-with-metrics-in-laravel-nova
        $expression = new Expression('balance_in_try / 100');

        return $this->sumByMonths($request, FinanceAccount::class, $expression)
            ->prefix('₺')
            ->format('0,0');
    }

    /**
     * Get the ranges available for the metric.
     *
     * @return array
     */
    public function ranges()
    {
        return [
            3 => __('3 Months'),
            6 => __('6 Months'),
            12 => __('This Year'),
            24 => __('Last Year'),
            60 => __('Last 5 Years'),
            120 => __('Last 10 Years'),
        ];
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'balanceTrend';
    }
}
