<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo admin account cố định
        User::create([
            'name'     => 'Admin Blog',
            'email'    => 'admin@phu-xuan-blog.test',
            'password' => bcrypt('password'),
        ]);

        // Tạo 9 user ngẫu nhiên
        User::factory()->count(9)->create();
    }
}