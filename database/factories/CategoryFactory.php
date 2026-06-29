<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Công nghệ', 'Lập trình', 'Thiết kế', 'Kinh doanh',
            'Du lịch', 'Ẩm thực', 'Sức khỏe', 'Giáo dục',
            'Thể thao', 'Giải trí', 'Khoa học', 'Văn hóa',
        ]);

        return [
            'name'        => $name,
            'slug'        => Str::slug($name),
            'description' => $this->faker->sentences(2, true),
        ];
    }
}