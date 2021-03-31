<?php

namespace App\Providers;

use App\Models\User;
use Facade\Ignition\Facades\Flare;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Gate::define('viewHorizon', function (User $user) {
            return $user->admin;
        });

        Gate::define('viewMailcoach', function (User $user) {
            return $user->email === 'freek@spatie.be';
        });

        Flare::determineVersionUsing(function() {
           return '1.0';
        });

        Carbon::setToStringFormat('jS F Y');

        Model::unguard();
    }
}
