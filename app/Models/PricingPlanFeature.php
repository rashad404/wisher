<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PricingPlanFeature extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = ['pricing_plan_id', 'feature_key', 'is_included'];

    public $translatable = ['feature_key'];

    public function pricingPlan()
    {
        return $this->belongsTo(PricingPlan::class);
    }
}
