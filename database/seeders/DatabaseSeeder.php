<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\ChatMessage;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            $user = User::factory()->create(['name' => 'User ' . $i, 'email' => $i . '@user.com']);

            //            ChatMessage::factory()->count(random_int(1, 20))->for($user)->create(['created_at' => now()->subMinutes(random_int(1, 60))]);
        }
    }
}
