<?php

namespace App\Nova\Metrics;

use App\Models\FinanceAccount;
use Illuminate\Database\Query\Expression;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class BalancePerAccount extends Partition
{
    /**
     * Rounding precision.
     *
     * @var int
     */
    public $roundingPrecision = 2;

    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $expression = new Expression('balance_in_try / 100');

        return $this->sum($request, FinanceAccount::class, $expression, 'name');
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
        return 'balance-per-account';
    }
}
