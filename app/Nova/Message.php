<?php
namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Message extends Resource
{
    public static $model = \App\Models\Message::class;

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Conversation'),
            BelongsTo::make('Sender', 'sender', User::class),
            Text::make('Body')->sortable(),
            Boolean::make('Is Seen'),
        ];
    }
}
