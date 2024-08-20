<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'name' => 'John Doe',
                'role' => 'Software Engineer',
                'message' => [
                    'en' => 'Wisher.az made it easy for me to remember important dates. Highly recommended!',
                    'az' => 'Wisher.az vacib tarixləri yadda saxlamağı asanlaşdırdı. Şiddətlə tövsiyə edirəm!',
                ],
                'image' => 'path/to/image1.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Jane Smith',
                'role' => 'Product Manager',
                'message' => [
                    'en' => 'I love how Wisher.az helps me organize my gifting process. It\'s a lifesaver!',
                    'az' => 'Wisher.az hədiyyə prosesimi təşkil etməyimə necə kömək etdiyini çox sevirəm. Bu, bir xilaskardır!',
                ],
                'image' => 'path/to/image2.jpg',
                'is_active' => true,
            ],
            [
                'name' => 'Robert Brown',
                'role' => 'CEO',
                'message' => [
                    'en' => 'Automating gift-giving with Wisher.az has been a game changer for our company.',
                    'az' => 'Wisher.az ilə hədiyyə vermə prosesini avtomatlaşdırmaq şirkətimiz üçün oyun dəyişdirici oldu.',
                ],
                'image' => 'path/to/image3.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
