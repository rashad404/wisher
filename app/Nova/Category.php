<?php
// app/Nova/Category.php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Outl1ne\NovaSortable\Traits\HasSortableRows;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    use HasSortableRows;

    public static $model = \App\Models\Category::class;

    public static $title = 'name';

    public static $group = 'Products';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            NovaTabTranslatable::make([
                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),

                Text::make('Desc')
                    ->sortable()
                    ->rules('nullable', 'max:255'),
            ]),

            BelongsTo::make('Parent Category', 'parent', Category::class)
                ->nullable()
                ->sortable()
                ->rules('nullable')
                ->filterable(function ($query) {
                    return $query->whereNull('parent_id');
                }),

            Boolean::make('Status')
                ->trueValue(1)
                ->falseValue(0)
                ->default(1)
                ->sortable(),

            Text::make('Sort Order')
                ->sortable()
                ->rules('required', 'integer'),
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

    public function lenses(Request $request)
    {
        return [];
    }

    public function actions(Request $request)
    {
        return [];
    }

    public static function relatableCategories(NovaRequest $request, $query)
    {
        // Ensure only root-level categories are selectable as parents
        return $query->whereNull('parent_id');
    }
}
