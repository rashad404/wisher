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
                ->disk('public') // Specify the disk you are using
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

            // Conditional ProductModel field based on selected Brand
            // BelongsTo::make('Product Model', 'productModel', ProductModel::class)
            //     ->nullable()
            //     ->dependsOn('brand', fn () => null) // This line ensures the field is dependent on the Brand selection
            //     // ->searchable()
            //     ->onlyOnForms(), // Show this field only on forms
            
            // Dynamic relationship field for ProductModel filtered by Brand
            BelongsTo::make('Product Model')
                ->nullable()
                // ->searchable()
                ->required()
                ->withMeta(['belongsToId' => $this->brand]),

            KeyValue::make('Features')
                ->keyLabel('Feature')
                ->valueLabel('Value')
                ->rules('json')
                ->nullable(),
            Textarea::make('Description')
                ->rules('required'),

            // Assuming you have a separate resource for ProductVariant
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


    public static function indexQuery(NovaRequest $request, $query)
    {
        // Check if the 'brand' filter is applied in the index request
        if ($request->has('filter.brand')) {
            // Get the selected brand ID from the filter
            $brandId = $request->input('filter.brand');
    
            // Modify the query for the 'product_model' field based on the selected brand
            $query->where('brand_id', $brandId);
        }
    
        return $query;
    }
}
