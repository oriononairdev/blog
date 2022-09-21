<?php

use App\Http\Controllers\Blog\Admin\PostController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Spatie\Health\Http\Controllers\HealthCheckResultsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// AUTH
require __DIR__.'/auth.php';

// NOVA
// Route::get('nova/imports/transactions', [TransactionController::class, 'import'])->middleware(['auth', 'admin']);

Route::name('blog.')->group(static function () {
    Route::group([
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
        static function () {
            Route::get('/', 'App\Http\Controllers\Blog\BlogController@index')->name('home');

            Route::view('contact', 'blog.pages.contact')->name('contact');

            Route::view('search', 'blog.pages.search')->name('search');

            Route::redirect('orion', 'admin')->name('orion');

            Route::get('admin', 'App\Http\Controllers\Blog\Admin\AdminController@dashboard')->middleware(['auth', 'admin'])->name('admin');

            Route::get('{id}-{slug}', 'App\Http\Controllers\Blog\BlogController@single')->name('single');

            Route::get('category/{category}', 'App\Http\Controllers\Blog\BlogController@category')->name('category');

            Route::get('tag/{tag}', 'App\Http\Controllers\Blog\BlogController@tag')->name('tag');

            Route::view('terminal', 'blog.pages.terminal')->name('terminal');

            Route::view('watchlist', 'blog.pages.watchlist')->name('watchlist');

            Route::webhooks('webhook-webmentions', 'webmentions');

            Route::get('health', HealthCheckResultsController::class)->middleware(['auth', 'admin']);

            Route::get('{page}', 'App\Http\Controllers\Blog\BlogController@page')->name('page');

            Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(static function () {
                Route::resource('posts', PostController::class);

                Route::post('posts/upload/{post}', [PostController::class, 'upload'])->name('posts.upload');

                Route::post('posts/preview', [PostController::class, 'preview'])->name('posts.preview');

                Route::get('dashboard', 'App\Http\Controllers\Blog\Admin\AdminController@dashboard')->name('dashboard');
            });
        });
});
