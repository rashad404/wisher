<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;
use Illuminate\Http\Request;
use Laravel\Nova\Resource;

class Order extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searchable.
     *
     * @var array
     */
    public static $search = [
        'id', 'email_address', 'payment_method'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User'),

            Select::make('Payment Method')
                ->options([
                    'cod' => 'Cash on Delivery',
                    'card' => 'Credit/Debit Card',
                ])
                ->displayUsingLabels(),

            Text::make('Email Address'),

            Text::make('Address'),

            Text::make('City'),

            Text::make('Region'),

            Text::make('Postal Code'),

            Number::make('Subtotal')
                ->step(0.01), // Allow floating-point numbers

            Number::make('Shipping')
                ->step(0.01), // Allow floating-point numbers

            Number::make('Tax')
                ->step(0.01), // Allow floating-point numbers

            Number::make('Total')
                ->step(0.01), // Allow floating-point numbers

            BelongsTo::make('Product'),

            BelongsTo::make('Color'),

            BelongsTo::make('Size'),

            Number::make('Quantity')
                ->step(1), // Quantity should likely be an integer

            DateTime::make('Created At')->sortable(),

            DateTime::make('Updated At')->sortable(),
        ];
    }
}
