<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     UsersTableSeeder::class,
        // ]);

        User::factory(20)->create();
        Category::factory(15)->create();
        Tag::factory(30)->create();
        Post::factory(20)->create();
        Comment::factory(80)->create();
    }
}
