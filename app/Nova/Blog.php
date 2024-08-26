<?php
namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Kongulov\NovaTabTranslatable\NovaTabTranslatable;
use Mostafaznv\NovaCkEditor\CkEditor;
use Laravel\Nova\Http\Requests\NovaRequest;

class Blog extends Resource
{
    public static $model = 'App\\Models\\Blog';

    public static $group = 'Main';

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            NovaTabTranslatable::make([
                Text::make('Title')->sortable()->rules('required', 'max:255'),
                CkEditor::make('Content')->rules('required'),
            ]),

            Image::make('Image')->rules('nullable', 'image', 'max:1024'),
            Date::make('Published At')->rules('nullable', 'date'),
        ];
    }
}
