<?php
namespace Database\Seeders;

use App\Models\Conversation;
use Illuminate\Database\Seeder;

class ConversationSeeder extends Seeder
{
    public function run()
    {
        Conversation::create([
            'user1_id' => 1,
            'user2_id' => 2,
        ]);
    }
}
