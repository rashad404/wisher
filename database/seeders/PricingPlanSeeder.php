<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PricingPlan;

class PricingPlanSeeder extends Seeder
{
    public function run()
    {
        PricingPlan::firstOrCreate([
            'name' => ['en' => 'Free Plan', 'az' => 'Pulsuz Plan'],
            'price_monthly' => 0.00,
            'price_yearly' => 0.00,
            'is_active' => true,
        ]);

        PricingPlan::firstOrCreate([
            'name' => ['en' => 'Standard Plan', 'az' => 'Standart Plan'],
            'price_monthly' => 9.99,
            'price_yearly' => 99.00,
            'is_active' => true,
        ]);

        PricingPlan::firstOrCreate([
            'name' => ['en' => 'Premium Plan', 'az' => 'Premium Plan'],
            'price_monthly' => 19.99,
            'price_yearly' => 199.00,
            'is_active' => true,
        ]);

        PricingPlan::firstOrCreate([
            'name' => ['en' => 'Enterprise Plan', 'az' => 'Müəssisə Planı'],
            'price_monthly' => null, // Custom pricing
            'price_yearly' => null, // Custom pricing
            'is_active' => true,
        ]);
    }
}
