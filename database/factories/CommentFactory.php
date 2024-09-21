<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Comment::class;
    public function definition(): array
    {

        $user =User::inRandomOrder()->first();
        $post =Post::inRandomOrder()->first();
        return [
            'comment' => implode(' ', $this->faker->sentences(rand(2,7))),
            'user_id' => $user->id,
            'post_id' => $post->id,
        ];
    }
}
