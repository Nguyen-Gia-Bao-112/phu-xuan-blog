<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Thứ tự QUAN TRỌNG: tránh lỗi foreign key
        $this->call([
            UserSeeder::class,       // 1. Users trước (Posts cần user_id)
            CategorySeeder::class,   // 2. Categories (Posts cần category_id)
            TagSeeder::class,        // 3. Tags (Posts cần tags để sync pivot)
            PostSeeder::class,       // 4. Posts (cần users + categories + tags đã có)
            CommentSeeder::class,    // 5. Comments (cần users + posts đã có)
        ]);
    }
}