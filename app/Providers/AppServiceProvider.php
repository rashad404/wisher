<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
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
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts/user/*', function ($view) {
            // Retrieve the currently authenticated user
            $user = Auth::user();
            if ($user) {
                $view->with('firstName', $user->first_name);
                $view->with('lastName', $user->last_name);
            }
        });
    }
}
