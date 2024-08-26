<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Validation\ValidationException;

class Event extends Resource
{
    public static $model = \App\Models\Event::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name', 'date',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Date::make('Date')
                ->sortable()
                ->rules('required', 'date'),

            Boolean::make('Is Annual')
            ->sortable()
            ->rules('boolean', function ($attribute, $value, $fail) {
                if ($value && request()->input('is_monthly')) {
                    $fail('You cannot select both "Is Annual" and "Is Monthly". Please select only one.');
                }
            }),

            Boolean::make('Is Monthly')
            ->sortable()
            ->rules('boolean', function ($attribute, $value, $fail) {
                if ($value && request()->input('is_annual')) {
                    $fail('You cannot select both "Is Annual" and "Is Monthly". Please select only one.');
                }
            }),

            BelongsTo::make('Category', 'category', EventCategory::class)
                ->sortable()
                ->rules('required'),

            Select::make('Status')->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ])
                ->sortable()
                ->rules('required'),

            Text::make('Position')
                ->sortable()
                ->rules('required', 'numeric'),
        ];
    }

    public static function withValidator(NovaRequest $request, $validator)
    {
        $validator->after(function ($validator) use ($request) {
            // Eyni anda həm "Is Annual" həm də "Is Monthly" seçilibsə
            if ($request->input('is_annual') && $request->input('is_monthly')) {
                $validator->errors()->add('is_annual', 'You cannot select both "Is Annual" and "Is Monthly". Please select only one.');
                $validator->errors()->add('is_monthly', 'You cannot select both "Is Annual" and "Is Monthly". Please select only one.');
            }
        });
    }

    public static function label()
    {
        return 'Events';
    }

    public static function singularLabel()
    {
        return 'Event';
    }
}
