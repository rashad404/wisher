<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Resource;
use Laravel\Nova\Http\Requests\NovaRequest;

class Wish extends Resource
{
    public static $model = \App\Models\Wish::class;

    public static $title = 'title';

    public static $search = [
        'id', 'title', 'text',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Event')->sortable(),

            Select::make('Language', 'lang')
                ->options([
                    'az' => 'Azerbaijani',
                    'en' => 'English',
                    'ru' => 'Russian',
                ])->sortable(),

            Text::make('Title')
                ->sortable()
                ->rules('required', 'max:255'),

            Textarea::make('Text')
                ->rules('required'),
        ];
    }
}
