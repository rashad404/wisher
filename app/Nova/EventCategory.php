<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class EventCategory extends Resource
{
    public static $model = \App\Models\EventCategory::class;

    public static $title = 'name';

    public static $group = 'Wishes';
    
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
        return 'Event Categories';
    }

    public static function singularLabel()
    {
        return 'Event Category';
    }
}
