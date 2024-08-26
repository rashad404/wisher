<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Illuminate\Http\Request;

class Brand extends Resource
{
    public static $model = 'App\Models\Brand';
    public static $title = 'name';

    public static $group = 'Products';

    public static $search = [
        'id', 'name',
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            HasMany::make('ProductModels', 'models', ProductModel::class),
        ];
    }
}
