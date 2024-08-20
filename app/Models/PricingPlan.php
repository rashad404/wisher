<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;


class PricingPlan extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['name', 'price_monthly', 'price_yearly', 'is_active'];

    public $translatable = ['name'];

    public function features()
    {
        return $this->hasMany(PricingPlanFeature::class);
    }

}
