<?php
namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;

class PricingPlan extends Resource
{
    public static $model = 'App\\Models\\PricingPlan';

    public static $group = 'Pricing';

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

            NovaTabTranslatable::make([
                Text::make('Name')
                    ->sortable()
                    ->rules('required', 'max:255'),
            ]),

            Number::make('Price Monthly', 'price_monthly')->rules('required'),
            Number::make('Price Yearly', 'price_yearly')->rules('required'),
            Boolean::make('Is Active', 'is_active')->sortable(),

            HasMany::make('Features', 'features', PricingPlanFeature::class),
        ];
    }
}
