<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    public function run()
    {
        // Top-level menus
        $menus = [
            [
                'name' => json_encode(['en' => 'Home']),
                'url' => '/',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Our Services']),
                'url' => null,
                'status' => true,
                'sort_order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Features']),
                'url' => '/features',
                'status' => true,
                'sort_order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Pricing']),
                'url' => '/pricing',
                'status' => true,
                'sort_order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'About']),
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

        // Submenus for "Our Services"
        $ourServicesSubmenus = [
            [
                'name' => json_encode(['en' => 'Wishes']),
                'url' => '/wishes',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $ourServicesMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Gifts']),
                'url' => '/gifts',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $ourServicesMenuId,
            ],
            // Additional submenus for "Gifts" can be added here
        ];

        // Submenus for "About"
        $aboutSubmenus = [
            [
                'name' => json_encode(['en' => 'About Us']),
                'url' => '/about',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Blog']),
                'url' => '/blog',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Contact Us']),
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
