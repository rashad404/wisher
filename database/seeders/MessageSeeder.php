<?php
namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    public function run()
    {
        Message::create([
            'conversation_id' => 1,
            'sender_id' => 1,
            'body' => 'Hello, how are you?',
            'is_seen' => false,
        ]);

        Message::create([
            'conversation_id' => 1,
            'sender_id' => 2,
            'body' => 'I am fine, thanks!',
            'is_seen' => true,
        ]);
    }
}
