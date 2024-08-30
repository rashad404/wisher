<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Translatable\HasTranslations;

class Category extends Model
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
        'desc',
        'parent_id',
        'status',
        'sort_order'
    ];

    public $translatable = ['name', 'desc']; // Specify the translatable attributes

    // Define relationship for parent category
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Define relationship for child categories
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

}
