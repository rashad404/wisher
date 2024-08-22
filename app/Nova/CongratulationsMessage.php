<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Mostafaznv\NovaCkEditor\CkEditor;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;

class CongratulationsMessage extends Resource
{
    public static $model = \App\Models\CongratulationsMessage::class;

    public static $title = 'id';

    public static $search = [
        'id', 'message',
    ];

    public function fields(NovaRequest $request)
    {
        return [
            BelongsTo::make('Important Date Category', 'importantDateCategory', ImportantDateCategory::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Related Dates', 'importantDate', ImportantDate::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('important_date_category_id', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $categoryId = $formData->important_date_category_id;

                    if ($categoryId) {
                        $field->query(function ($query) use ($categoryId) {
                            $query->where('important_date_category_id', $categoryId);
                        });
                    }
                }),

            Select::make('Language', 'language')
                ->options([
                    'en' => 'English',
                    'az' => 'Azerbaijani',
                ])
                ->rules('required', 'in:en,az')
                ->displayUsingLabels(),

            CkEditor::make('Message')
                ->rules('required')
                ->hideFromIndex(),
        ];
    }

    public static function label()
    {
        return 'Congratulations Messages';
    }

    public static function singularLabel()
    {
        return 'Congratulations Message';
    }

}
