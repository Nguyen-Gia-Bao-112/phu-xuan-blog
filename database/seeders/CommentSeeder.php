<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Comment;

class CommentSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo bình luận cho các bài viết
        Comment::factory()->count(50)->create();
    }
}