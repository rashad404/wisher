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
        $this->call([
            UserSeeder::class,
            GroupSeeder::class,
            InterestCategorySeeder::class,
            InterestSeeder::class,
            ContactSeeder::class,
            ContactInterestSeeder::class,
            BrandSeeder::class,
            CategorySeeder::class,
            ColorSeeder::class,
            SizeSeeder::class,
            ProductModelSeeder::class,
            ProductSeeder::class,
            ProductVariantSeeder::class,
            UserEventSeeder::class,
            EventCategorySeeder::class,
            EventSeeder::class,
            PricingPlanSeeder::class,
            PricingPlanFeatureSeeder::class,
            BlogSeeder::class,
            TestimonialSeeder::class,
            FeatureSeeder::class,
            ConversationSeeder::class,
            MessageSeeder::class,
            ActivitySeeder::class,
            WishSeeder::class,
            ReviewSeeder::class,
            MenuSeeder::class,
            WishPhotoTemplateSeeder::class,
            UserWishPhotoSeeder::class,
        ]);
    }
}
