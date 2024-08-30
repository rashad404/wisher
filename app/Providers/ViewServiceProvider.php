<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

class ViewServiceProvider extends ServiceProvider
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
        // Bind the menu data to the header view
        View::composer('layouts.*', function ($view) {
            $menus = Menu::whereNull('parent_id')
             ->with(['children' => function($query) {
                 $query->orderBy('sort_order');
             }])
             ->orderBy('sort_order')
             ->get();
            $view->with('menus', $menus);
        });

    }
}
