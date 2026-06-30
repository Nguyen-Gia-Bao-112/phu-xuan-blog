<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Post;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dữ liệu test cũ
        User::where('email', 'like', '%@test.com')->delete();

        // Admin
        $admin = User::factory()->create([
            'name'     => 'Admin Lê',
            'email'    => 'admin@test.com',
            'password' => bcrypt('password'),
            'role'     => 'admin',
        ]);

        // Editor
        $editor = User::factory()->create([
            'name'     => 'Editor Phạm',
            'email'    => 'editor@test.com',
            'password' => bcrypt('password'),
            'role'     => 'editor',
        ]);

        // User thường (Alice)
        $alice = User::factory()->create([
            'name'     => 'Alice Nguyễn',
            'email'    => 'alice@test.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);

        // User thường (Bob)
        $bob = User::factory()->create([
            'name'     => 'Bob Trần',
            'email'    => 'bob@test.com',
            'password' => bcrypt('password'),
            'role'     => 'user',
        ]);

        // Bài viết của Alice
        Post::factory()->count(3)->create([
            'user_id' => $alice->id,
            'status'  => 'published',
        ]);

        // Bài viết của Bob
        Post::factory()->count(2)->create([
            'user_id' => $bob->id,
            'status'  => 'published',
        ]);
    }
}