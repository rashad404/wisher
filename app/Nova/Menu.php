<?php

namespace App\Nova;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\URL;
use Laravel\Nova\Http\Requests\NovaRequest;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Outl1ne\NovaSortable\Traits\HasSortableRows;

class Menu extends Resource
{
    use HasSortableRows;
    
    public static $model = \App\Models\Menu::class;

    public static $title = 'name';

    public static $group = 'Main';

    public static $search = [
        'id', 'name'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            NovaTabTranslatable::make([

                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
                Text::make('Desc')
                    ->sortable()
                    ->rules('required', 'max:255'),
            ]),

            Text::make('URL')
                ->sortable()
                ->rules('nullable'), // Allow URL to be null or valid URL
                
            BelongsTo::make('Parent Menu', 'parent', Menu::class)
                ->nullable()
                ->sortable()
                ->rules('nullable')
                ->filterable(function ($query) {
                    return $query->whereNull('parent_id');
                }),

            Boolean::make('Status')
                ->trueValue(1)
                ->falseValue(0)
                ->default(1),
        ];
    }
    public static function relatableMenus(NovaRequest $request, $query)
    {
        return $query->whereNull('parent_id');
    }
}
