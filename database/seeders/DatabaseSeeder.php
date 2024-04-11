<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $anime = [
            'Oliver Tsubasa', // Super Campeões
            'Goku', // Dragon Ball
            'Naruto', // Naruto
            'Urameshi', // Yu Yu Hakusho
            'Gon', // Hunter x Hunter
            'Yuji Itadori', // Jujutsu Kaisen
            'Deku', // My Hero Academia
            'Monkey D Luffy', // One Piece
        ];

        foreach ($anime as $username) {
            User::factory()->create(['name' => $username, 'email' => str($username)->slug() . '@user.com', 'username' => str($username)->slug()]);
        }
    }
}
