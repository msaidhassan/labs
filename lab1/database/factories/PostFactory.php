<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User; // Assuming Post is related to User as creator
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        $userIds = User::pluck('id')->take(10)->toArray();

        return [
            'title' => $this->faker->unique()->sentence,
            'content' => $this->faker->paragraph,
            'posted_by' => $this->faker->randomElement($userIds), // Assign posts to existing users
            'image' => 'images/default.png', // Adjust the default image path
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

