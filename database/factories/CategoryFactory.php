<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;
     public function definition(): array
    {
        $categories = [
            'Artificial Intelligence',
            'Machine Learning',
            'Deep Learning',
            'Neural Networks',
            'Natural Language Processing',
            'Robotics',
            'Computer Vision',
            'AI Ethics',
            'Autonomous Systems',
            'Reinforcement Learning',
            'AI Research',
            'Data Science',
            'Cognitive Computing',
            'Predictive Analytics',
            'AI in Healthcare',
            'AI in Finance',
            'AI in Education',
            'AI in Manufacturing'
        ];

        return [
            'title' => $this->faker->unique()->randomElement($categories),
           'image' => 'categories/default.jpg',
        ];
    }
}
