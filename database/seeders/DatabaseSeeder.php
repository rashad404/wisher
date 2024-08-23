<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(GroupSeeder::class);

        $this->call([
            InterestCategorySeeder::class,
            InterestSeeder::class,
        ]);
        $this->call(ContactSeeder::class);
        $this->call(ContactInterestSeeder::class);
        
        $this->call(BrandSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ColorSeeder::class);
        $this->call(SizeSeeder::class);
        $this->call(ProductModelSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(ProductVariantSeeder::class);
        $this->call(UserEventSeeder::class);
        $this->call(ImportantDateCategorySeeder::class);
        $this->call(ImportantDateSeeder::class);
        $this->call(ProductVariantSeeder::class);
        $this->call(PricingPlanSeeder::class);
        $this->call(PricingPlanFeatureSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(ConversationSeeder::class);
        $this->call(MessageSeeder::class);
        

    }
}
