<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Interest;

class ContactInterestSeeder extends Seeder
{
    public function run()
    {
        // Retrieve some sample contacts
        $contacts = Contact::all();

        // Sample interests and their types
        $contactInterests = [
            ['contact_name' => 'John D.', 'interest_name' => 'Laptop', 'type' => 'like'],
            ['contact_name' => 'John D.', 'interest_name' => 'Refrigerator', 'type' => 'dislike'],
            ['contact_name' => 'Mike M.', 'interest_name' => 'Smartphone', 'type' => 'like'],
            ['contact_name' => 'Mike M.', 'interest_name' => 'Blender', 'type' => 'dislike'],
            ['contact_name' => 'Olivia B.', 'interest_name' => 'Soccer', 'type' => 'like'],
            ['contact_name' => 'Olivia B.', 'interest_name' => 'Tennis', 'type' => 'dislike'],
        ];

        foreach ($contactInterests as $contactInterest) {
            $contact = $contacts->firstWhere('name', $contactInterest['contact_name']);
            $interest = Interest::where('name->en', $contactInterest['interest_name'])->first();

            if ($contact && $interest) {
                $contact->interests()->attach($interest->id, ['type' => $contactInterest['type']]);
            }
        }
    }
}
