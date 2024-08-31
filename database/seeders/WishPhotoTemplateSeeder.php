<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WishPhotoTemplate;

class WishPhotoTemplateSeeder extends Seeder
{
    public function run()
    {
        WishPhotoTemplate::create([
            'name' => 'Christmas Greetings',
            'category' => 'christmas',
            'image_path' => 'wish_photo_templates/christmas.jpg',
            'editable_areas' => json_encode([
                [
                    'x' => 100,
                    'y' => 100,
                    'width' => 200,
                    'height' => 50,
                    'default_text' => 'Merry Christmas!',
                    'font_size' => 24,
                    'font_family' => 'Arial',
                    'color' => '#FF0000'
                ]
            ])
        ]);

        // Add more templates as needed
    }
}