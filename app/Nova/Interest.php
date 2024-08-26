<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;

class Interest extends Resource
{
    public static $model = \App\Models\Interest::class;

    public static $title = 'name';

    public static $group = 'Interests';

    public static $search = ['id', 'name'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Interest Category', 'category', InterestCategory::class),

            // Translatable fields with tabs
            NovaTabTranslatable::make([
                Text::make('Name')->sortable()->rules('required', 'max:255'),
            ]),

            Number::make('Position')->sortable(),
            Boolean::make('Status')->sortable(),
        ];
    }
}
