<?php

use App\Models\ChatCensor;
use Illuminate\Database\Seeder;

class ChatCensorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ChatCensor::class)->create([
            'from' => 'suka',
            'to' => '****'
        ]);
        factory(ChatCensor::class)->create([
            'from' => 'bitch',
            'to' => '-----'
        ]);
    }
}
