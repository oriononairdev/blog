<?php

namespace App\Providers;

use App\Nova\Category;
use App\Nova\Dashboards\Main;
use App\Nova\FinanceAccount;
use App\Nova\FinanceCategory;
use App\Nova\FinanceCurrency;
use App\Nova\FinanceTransaction;
use App\Nova\Media;
use App\Nova\Message;
use App\Nova\Page;
use App\Nova\Portfolio;
use App\Nova\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Spatie\BackupTool\BackupTool;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        Nova::serving(function (ServingNova $event) {
            app()->setLocale('en');
        });
        Nova::booted(function () {
            app()->setlocale('en');
        });

        Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::make('Blog', [
                    MenuItem::resource(Post::class),
                    MenuItem::resource(Page::class),
                    MenuItem::resource(Category::class),
                    MenuItem::resource(Message::class),
                    MenuItem::resource(Media::class),
                    MenuItem::resource(Portfolio::class),
                ])->icon('pencil-alt')->collapsable(),

                MenuSection::make('Finance', [
                    MenuItem::resource(FinanceAccount::class),
                    MenuItem::resource(FinanceTransaction::class),
                    MenuItem::resource(FinanceCategory::class),
                    MenuItem::resource(FinanceCurrency::class),
                ])->icon('currency-dollar')->collapsable(),

                MenuSection::make('Backups')->path('backups')->icon('server'),
            ];
        });
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            new BackupTool(),
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, ['z@mucahitugur.com', 'palealenta@gmail.com']);
        });
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new Main,
        ];
    }
}
