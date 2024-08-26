<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventSeeder extends Seeder
{
    public function run()
    {
        $events = [
            ['name' => 'Yeni il bayramı', 'date' => '2024-01-01', 'category_id' => 1], // İctimai Bayramlar
            ['name' => 'Ümumxalq hüzn günü', 'date' => '2024-01-20', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Qadınlar günü', 'date' => '2024-03-08', 'category_id' => 4], // Beynəlxalq Bayramlar
            ['name' => 'Novruz bayramı', 'date' => '2024-03-20', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Ramazan bayramı', 'date' => '2024-04-10', 'category_id' => 2], // Dini Bayramlar
            ['name' => 'Faşizm üzərində qələbə günü', 'date' => '2024-05-09', 'category_id' => 4], // Beynəlxalq Bayramlar
            ['name' => 'Müstəqillik Günü', 'date' => '2024-05-28', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Azərbaycan xalqının milli qurtuluş günü', 'date' => '2024-06-15', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Azərbaycan Respublikasının Silahlı Qüvvələri günü', 'date' => '2024-06-26', 'category_id' => 1], // İctimai Bayramlar
            ['name' => 'Qurban bayramı', 'date' => '2024-06-16', 'category_id' => 2], // Dini Bayramlar
            ['name' => 'Zəfər Günü', 'date' => '2024-11-08', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Azərbaycan Respublikasının Dövlət bayrağı günü', 'date' => '2024-11-09', 'category_id' => 3], // Milli Bayramlar
            ['name' => 'Dünya azərbaycanlılarının həmrəyliyi günü', 'date' => '2024-12-31', 'category_id' => 1], // İctimai Bayramlar
        ];

        foreach ($events as $event) {
            Event::create([
                'name' => $event['name'],
                'date' => $event['date'],
                'category_id' => $event['category_id'],
            ]);
        }
    }
}
