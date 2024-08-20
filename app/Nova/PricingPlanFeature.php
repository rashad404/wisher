<?php
namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class PricingPlanFeature extends Resource
{
    public static $model = 'App\\Models\\PricingPlanFeature';

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

            // BelongsTo::make('Pricing Plan', 'pricingPlan', PricingPlan::class),

            BelongsTo::make('Pricing Plan', 'pricingPlan', PricingPlan::class)
            ->sortable()
            ->display(function ($pricingPlan) {
                return $pricingPlan->getTranslation('name', app()->getLocale());
            }),
        
            NovaTabTranslatable::make([
                Text::make('Feature', 'feature_key')
                    ->sortable()
                    ->rules('required', 'max:255'),
            ]),
            
            Boolean::make('Is Included', 'is_included')->sortable(),
        ];
    }
}
