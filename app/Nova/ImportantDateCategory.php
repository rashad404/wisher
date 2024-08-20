<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class ImportantDateCategory extends Resource
{
    public static $model = \App\Models\ImportantDateCategory::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Position')
                ->sortable()
                ->rules('required', 'numeric'),
        ];
    }

    public static function label()
    {
        return 'Important Date Categories';
    }

    public static function singularLabel()
    {
        return 'Important Date Category';
    }
}