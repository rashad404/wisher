<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Feature extends Resource
{
    public static $model = 'App\\Models\\Feature';

    public static $group = 'Main';
    
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            NovaTabTranslatable::make([
                Text::make('Title')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make('Text')
                    ->sortable()
                    ->rules('required', 'max:500'),
            ]),
        ];
    }
}
