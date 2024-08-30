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
                'name' => json_encode(['en' => 'Home']),
                'desc' => json_encode(['en' => 'Back to the homepage']),
                'url' => '/',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Our Services']),
                'desc' => json_encode(['en' => 'Discover our range of services']),
                'url' => null,
                'status' => true,
                'sort_order' => 2,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Features']),
                'desc' => json_encode(['en' => 'Learn about our features']),
                'url' => '/features',
                'status' => true,
                'sort_order' => 3,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'Pricing']),
                'desc' => json_encode(['en' => 'View our pricing plans']),
                'url' => '/pricing',
                'status' => true,
                'sort_order' => 4,
                'parent_id' => null,
            ],
            [
                'name' => json_encode(['en' => 'About']),
                'desc' => json_encode(['en' => 'Get to know more about us']),
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
                'name' => json_encode(['en' => 'Wishes']),
                'desc' => json_encode(['en' => 'Send personalized wishes']),
                'url' => '/wishes',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $ourServicesMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Gifts']),
                'desc' => json_encode(['en' => 'Choose and send gifts']),
                'url' => '/gifts',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $ourServicesMenuId,
            ],
            // Additional submenus for "Gifts" can be added here
        ];

        // Submenus for "About" with descriptions
        $aboutSubmenus = [
            [
                'name' => json_encode(['en' => 'About Us']),
                'desc' => json_encode(['en' => 'Learn more about Wisher']),
                'url' => '/about',
                'status' => true,
                'sort_order' => 1,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Blog']),
                'desc' => json_encode(['en' => 'Read our latest articles']),
                'url' => '/blog',
                'status' => true,
                'sort_order' => 2,
                'parent_id' => $aboutMenuId,
            ],
            [
                'name' => json_encode(['en' => 'Contact Us']),
                'desc' => json_encode(['en' => 'Get in touch with us']),
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
