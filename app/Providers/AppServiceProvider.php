<?php

namespace App\Providers;

use App\Models\Setting;
use App\Models\Wishlist;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // view()->composer('layouts.frontend.navbar', function ($view) {
        //     if (auth()->check()) {
        //         $view->with(
        //             'wishlist',
        //             Wishlist::where('user_id', auth()->user()->id)->count()
        //         );
        //     } else {
        //         // If there is no authenticated user, set wishlist to zero or any default value
        //         $view->with('wishlist', ''); // You can change 0 to any default value you prefer
        //     }
        // });
        Paginator::useBootstrap();
        $appSetting = Setting::first();
        view()->share('appSetting', $appSetting);
    }
}
