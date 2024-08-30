<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;


class Menu extends Model
{
    use HasFactory;
    use HasTranslations;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'name',
        'url',
        'parent_id',
        'status',
    ];
    public $translatable = ['name']; // Specify the translatable attribute

    // Define relationship for parent menu
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Define relationship for child menus
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function trans($attribute)
    {
        return $this->getTranslation($attribute, app()->getLocale());
    }
}
