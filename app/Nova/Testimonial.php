<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Http\Requests\NovaRequest;

class Testimonial extends Resource
{
    public static $model = 'App\\Models\\Testimonial';

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Role')
                ->sortable()
                ->nullable()
                ->rules('max:255'),

            NovaTabTranslatable::make([
                Text::make('Message')
                    ->rules('required'),
            ]),

            Image::make('Image')->disk('public')->nullable(),

            Boolean::make('Is Active', 'is_active')->sortable(),
        ];
    }
}
