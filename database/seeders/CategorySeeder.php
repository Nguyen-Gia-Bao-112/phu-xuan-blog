<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Xóa dòng truncate này đi
        // Category::truncate();

        // Chỉ giữ lại phần tạo dữ liệu
        Category::factory()->count(12)->create();
    }
}