<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Tag::class;
    public function definition(): array
    {
        // $tags = [
        //     'Machine Learning',
        //     'Deep Learning',
        //     'Neural Networks',
        //     'Natural Language Processing',
        //     'Computer Vision',
        //     'AI Ethics',
        //     'Robotics',
        //     'Data Science',
        //     'Supervised Learning',
        //     'Unsupervised Learning',
        //     'Reinforcement Learning',
        //     'AI Research',
        //     'Autonomous Systems',
        //     'Artificial Intelligence',
        //     'Cognitive Computing'
        // ];

        return [
            'title' => $this->faker->word,
        ];
    }
}
