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
            // Important Date Category field
            BelongsTo::make('Important Date Category', 'importantDateCategory', ImportantDateCategory::class)
                ->sortable()
                ->rules('required'),

            // Related Dates field with dynamic query
            BelongsTo::make('Related Dates', 'importantDate', ImportantDate::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('important_date_category_id', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $categoryId = $formData->important_date_category_id;

                    // Check if categoryId is not null before filtering
                    if ($categoryId) {
                        $field->query(function ($query) use ($categoryId) {
                            // Ensure the field in the database matches 'category_id'
                            $query->where('category_id', $categoryId);
                        });
                    }
                }),

            // Language selection field
            Select::make('Language', 'language')
                ->options([
                    'en' => 'English',
                    'az' => 'Azerbaijani',
                ])
                ->rules('required', 'in:en,az')
                ->displayUsingLabels(),

            // Message field with CKEditor
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
