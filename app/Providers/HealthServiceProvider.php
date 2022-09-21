<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Health\Checks\Checks\DatabaseCheck;
use Spatie\Health\Checks\Checks\DebugModeCheck;
use Spatie\Health\Checks\Checks\EnvironmentCheck;
use Spatie\Health\Checks\Checks\RedisCheck;
use Spatie\Health\Checks\Checks\ScheduleCheck;
use Spatie\Health\Checks\Checks\UsedDiskSpaceCheck;
use Spatie\Health\Facades\Health;

class HealthServiceProvider extends ServiceProvider
{
    public function register()
    {
        Health::checks([
            DebugModeCheck::new()->expectedToBe(config('app.debug')),
            EnvironmentCheck::new()->expectEnvironment(config('app.env')),
            DatabaseCheck::new(),
            ScheduleCheck::new()->useCacheStore('file-schedule-check')->heartbeatMaxAgeInMinutes(5),
            RedisCheck::new(),
            UsedDiskSpaceCheck::new()
                ->warnWhenUsedSpaceIsAbovePercentage(75)
                ->failWhenUsedSpaceIsAbovePercentage(95),
        ]);
    }
}
