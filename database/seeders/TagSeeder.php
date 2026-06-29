<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\Post;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = ['Laravel', 'PHP', 'Backend', 'API', 'Tutorial'];

        foreach ($tags as $name) {
            Tag::create([
                'name' => $name,
                'slug' => Str::slug($name),
            ]);
        }

        // Gắn tag ngẫu nhiên cho mỗi bài viết
        Post::all()->each(function ($post) {
            $post->tags()->sync(
                Tag::inRandomOrder()->limit(3)->pluck('id')
            );
        });
    }
}