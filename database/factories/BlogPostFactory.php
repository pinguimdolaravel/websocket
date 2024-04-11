<?php

declare(strict_types = 1);

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class BlogPostFactory extends Factory
{
    protected $model = BlogPost::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'title'      => $this->faker->realText(20),
            'body'       => $this->faker->realText(),
            'status'     => $this->faker->randomElement(['published', 'draft']),
            'user_id'    => User::factory(),
        ];
    }
}
