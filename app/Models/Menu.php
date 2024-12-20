<?php

namespace App\Models;

use App\Traits\HasTranslatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;


class Menu extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasTranslatable;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'name',
        'desc',
        'url',
        'parent_id',
        'status',
    ];
    public $translatable = ['name', 'desc']; // Specify the translatable attribute

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

}
