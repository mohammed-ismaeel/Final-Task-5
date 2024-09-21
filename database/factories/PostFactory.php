<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Post::class;

    public function definition(): array
    {

        $user = User::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'title' => $this->faker->catchPhrase,
            'description' => $this->faker->realText(200),
            'image' => 'posts/default.jpg', // مسار الصورة الافتراضي
            'user_id' => $user->id,
            'category_id' => $category->id,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function(Post $post){
                $tags = Tag::inRandomOrder()->take(rand(1,3))->pluck('id');
                $post->tags()->attach($tags);
            });
    }
}
