<?php
// app/Nova/Category.php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    public static $model = 'App\Models\Category';
    public static $title = 'name';
    
    public static $group = 'Products';
    
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
        ];
    }

    public function cards(Request $request)
    {
        return [];
    }

    public function filters(Request $request)
    {
        return [];
    }
}
