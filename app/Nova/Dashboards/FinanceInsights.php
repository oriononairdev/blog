<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\Balance;
use Laravel\Nova\Dashboard;

class FinanceInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new Balance,
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey(): string
    {
        return 'finance-insights';
    }
}
