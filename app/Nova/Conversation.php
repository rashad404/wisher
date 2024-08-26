<?php
namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Conversation extends Resource
{
    public static $model = \App\Models\Conversation::class;

    public static $group = 'Messages';
    
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('User1', 'user1', User::class),
            BelongsTo::make('User2', 'user2', User::class),
            HasMany::make('Messages'),
        ];
    }
}
