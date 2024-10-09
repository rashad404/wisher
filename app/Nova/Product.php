<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\KeyValue;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Illuminate\Support\Facades\Log;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Product>
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $group = 'Products';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

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

            Image::make('Main Image', 'main_image')
                ->disk('public')
                ->nullable(),

            Text::make('Name')
                ->sortable()
                ->rules('required', 'max:255'),

            Select::make('Condition')
                ->options([
                    'new' => 'New',
                    'used' => 'Used',
                ])
                ->displayUsingLabels()
                ->sortable()
                ->rules('required'),

            Number::make('Price')
                ->step(0.01),

            Number::make('Discounted Price', 'discounted_price')
                ->step(0.01)
                ->nullable(),

            Text::make('SKU')
                ->nullable(),

            BelongsTo::make('Category'),

            BelongsTo::make('Brand', 'brand', Brand::class)
                ->nullable(),

            BelongsTo::make('Product Model')
                ->nullable()
                ->required()
                ->withMeta(['belongsToId' => $this->brand]),

            KeyValue::make('Features')
                ->keyLabel('Feature')
                ->valueLabel('Value')
                ->rules('nullable', 'json')
                ->resolveUsing(function ($value) {
                    return is_string($value) ? json_decode($value, true) : $value;
                })
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    $value = $request->input($attribute);
                    $model->{$attribute} = is_array($value) ? json_encode($value) : $value;
                })
                ->nullable(),

            Textarea::make('Description')
                ->rules('required'),

            HasMany::make('Variants', 'variants', ProductVariant::class),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }

    /**
     * Modify the query for the index endpoint.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        if ($request->has('filter.brand')) {
            $brandId = $request->input('filter.brand');
            $query->where('brand_id', $brandId);
        }

        return $query;
    }

    /**
     * Handle any post-create operations.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \App\Models\Product  $model
     * @return void
     */
    public static function afterCreate(NovaRequest $request, $model)
    {
        static::processFeatures($request, $model);
    }

    /**
     * Handle any post-update operations.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \App\Models\Product  $model
     * @return void
     */
    public static function afterUpdate(NovaRequest $request, $model)
    {
        static::processFeatures($request, $model);
    }

    /**
     * Process and save the features field.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \App\Models\Product  $model
     * @return void
     */
    protected static function processFeatures(NovaRequest $request, $model)
    {
        Log::info('Processing features for product', ['product_id' => $model->id]);

        if ($request->has('features')) {
            $features = $request->get('features');
            Log::info('Raw features data', ['features' => $features]);

            if (is_string($features)) {
                Log::info('Features is a string, attempting to decode');
                $decodedFeatures = json_decode($features, true);
                if (json_last_error() === JSON_ERROR_NONE) {
                    Log::info('Successfully decoded features string');
                    $model->features = $features; // It's already a valid JSON string
                } else {
                    Log::error('Failed to decode features string', ['json_error' => json_last_error_msg()]);
                    $model->features = '{}'; // Set to empty object if decoding fails
                }
            } elseif (is_array($features)) {
                Log::info('Features is an array, encoding to JSON');
                $model->features = json_encode($features);
            } else {
                Log::warning('Features is neither a string nor an array', ['type' => gettype($features)]);
                $model->features = '{}'; // Set to empty object for unexpected types
            }

            try {
                $model->save();
                Log::info('Product saved successfully', ['product_id' => $model->id]);
            } catch (\Exception $e) {
                Log::error('Failed to save product', ['error' => $e->getMessage()]);
            }
        } else {
            Log::info('No features data in request');
        }
    }
}
