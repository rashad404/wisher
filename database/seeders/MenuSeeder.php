<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Top-level menus with descriptions
        $menus = [
            [
                'name' => json_encode(['en' => 'Home', 'az' => 'Əsas Səhifə']),
                'desc' => json_encode(['en' => 'Back to the homepage', 'az' => 'Əsas səhifəyə qayıt']),
                'url' => '/',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Our Services', 'az' => 'Xidmətlər']),
                'desc' => json_encode(['en' => 'Discover our range of services', 'az' => 'Təklif etdiyimiz xidmətlərlə tanış olun']),
                'url' => null,
                'status' => true,
                'sort_order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Features', 'az' => 'Üstünlüklər']),
                'desc' => json_encode(['en' => 'Learn about our features', 'az' => 'Platformanın imkanları']),
                'url' => '/features',
                'status' => true,
                'sort_order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Pricing', 'az' => 'Tariflər']),
                'desc' => json_encode(['en' => 'View our pricing plans', 'az' => 'Qiymət planlarımız']),
                'url' => '/pricing',
                'status' => true,
                'sort_order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'About', 'az' => 'Haqqımızda']),
                'desc' => json_encode(['en' => 'Get to know more about us', 'az' => 'Bizi daha yaxından tanıyın']),
                'url' => null,
                'status' => true,
                'sort_order' => 5,
                'parent_id' => null,
            ],
        ];

        // Insert top-level menus
        DB::table('menus')->insert($menus);

        // Fetch parent menu IDs for creating submenus
        $ourServicesMenuId = DB::table('menus')->where('name->en', 'Our Services')->value('id');
        $aboutMenuId = DB::table('menus')->where('name->en', 'About')->value('id');

        // Submenus for "Our Services" with descriptions
        $ourServicesSubmenus = [
            [
                'name' => json_encode(['en' => 'Wishes', 'az' => 'Təbriklər']),
                'desc' => json_encode(['en' => 'Send personalized wishes', 'az' => 'Şəxsi təbriklər göndərin']),
                'url' => '/wishes',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $ourServicesMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Gifts', 'az' => 'Hədiyyələr']),
                'desc' => json_encode(['en' => 'Choose and send gifts', 'az' => 'Hədiyyə seçin və göndərin']),
                'url' => '/gifts',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $ourServicesMenuId,
            ],
        ];

        // Submenus for "About" with descriptions
        $aboutSubmenus = [
            [
                'name' => json_encode(['en' => 'About Us', 'az' => 'Biz Kimik']),
                'desc' => json_encode(['en' => 'Learn more about Wisher', 'az' => 'Wisher haqqında ətraflı məlumat']),
                'url' => '/about',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Blog', 'az' => 'Bloq']),
                'desc' => json_encode(['en' => 'Read our latest articles', 'az' => 'Ən son məqalələrimiz']),
                'url' => '/blog',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Contact Us', 'az' => 'Əlaqə']),
                'desc' => json_encode(['en' => 'Get in touch with us', 'az' => 'Bizimlə əlaqə saxlayın']),
                'url' => '/contact',
                'status' => true,
                'sort_order' => 3,
                'parent_id' => $aboutMenuId,
            ],
        ];

        // Insert submenus
        DB::table('menus')->insert(array_merge($ourServicesSubmenus, $aboutSubmenus));
    }
}