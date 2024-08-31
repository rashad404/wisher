<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserWishPhoto;
use App\Models\User;
use App\Models\WishPhotoTemplate;

class UserWishPhotoSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();
        $templates = WishPhotoTemplate::all();

        foreach ($users as $user) {
            UserWishPhoto::create([
                'user_id' => $user->id,
                'wish_photo_template_id' => $templates->random()->id,
                'customization_data' => json_encode([
                    'text' => 'Happy Holidays!',
                    'font_size' => 24,
                    'color' => '#FFFFFF',
                    'x' => 100,
                    'y' => 100
                ]),
                'final_image_path' => 'user_wish_photos/sample_' . $user->id . '.jpg',
                'is_public' => true,
                'likes' => rand(0, 100),
                'shares' => rand(0, 50)
            ]);
        }
    }
}