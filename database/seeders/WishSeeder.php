<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wish;

class WishSeeder extends Seeder
{
    public function run()
    {
        $wishes = [
            [
                'lang' => 'az',
                'event_id' => 1,
                'title' => 'Yeni il Bayramı Təbriki',
                'text' => 'Yeni iliniz mübarək! Sağlam, xoşbəxt və uğurlu bir il arzu edirəm.',
            ],
            [
                'lang' => 'az',
                'event_id' => 3,
                'title' => '8 Mart Təbriki',
                'text' => 'Bütün qadınların 8 mart Qadınlar günü mübarək olsun!',
            ],
            [
                'lang' => 'az',
                'event_id' => 4,
                'title' => 'Novruz Bayramı Təbriki',
                'text' => 'Novruz bayramınız mübarək! Bu bayramın gətirdiyi sevinc və xoşbəxtlik daim sizinlə olsun.',
            ],
            // Add more wishes for other events...
        ];

        foreach ($wishes as $wish) {
            Wish::create($wish);
        }
    }
}
