<?php

declare(strict_types = 1);

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\User;
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
            $user = User::factory()->create(['name' => $username, 'email' => str($username)->slug() . '@user.com', 'username' => str($username)->slug()]);

            BlogPost::factory()->count(random_int(1, 10))->create(['user_id' => $user->id]);
        }
    }
}
