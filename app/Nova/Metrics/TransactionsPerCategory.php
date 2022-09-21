<?php

namespace App\Nova\Metrics;

use App\Models\FinanceTransaction;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class TransactionsPerCategory extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $query = (new FinanceTransaction)->newQuery();
        $results = $query->select(
            'finance_categories.name', DB::raw('count(`amount`) as aggregate')
        )
            // https://stackoverflow.com/questions/45408158/laravel-5-4-how-to-order-by-countcolumn-in-eloquent
            ->orderBy('aggregate', 'DESC')
            ->groupBy('finance_categories.name')
            ->where('finance_categories.name', '!=', 'Transfer, withdraw')
            ->where('finance_categories.name', '!=', 'Missing')
            ->join('finance_categories', 'finance_transactions.category_id', '=', 'finance_categories.id')
            ->limit(5)
            ->get();

        return $this->result($results->mapWithKeys(function ($result) {
            return $this->formatAggregateResult($result, 'finance_categories.name');
        })->all());
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
        return 'transactions-per-category';
    }
}
