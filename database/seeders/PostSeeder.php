<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // 70 bài published
        Post::factory()->published()->count(70)->create();

        // 20 bài draft
        Post::factory()->draft()->count(20)->create();

        // 10 bài published nổi bật (view_count cao)
        Post::factory()->published()->count(10)->create([
            'view_count' => rand(10000, 50000),
        ]);

        // Gán tags ngẫu nhiên cho tất cả posts
        Post::all()->each(function ($post) {
            $tagIds = Tag::inRandomOrder()->limit(rand(1, 4))->pluck('id');
            $post->tags()->sync($tagIds);
        });
    }
}