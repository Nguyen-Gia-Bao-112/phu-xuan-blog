<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $posts = [
            [
                'id'     => 1,
                'title'  => 'Giới thiệu về Laravel',
                'author' => 'Nguyễn Văn An',
                'date'   => '2024-01-15'
            ],
            [
                'id'     => 2,
                'title'  => 'MVC là gì?',
                'author' => 'Trần Thị Bình',
                'date'   => '2024-01-20'
            ],
            [
                'id'     => 3,
                'title'  => 'Cài đặt môi trường Laravel',
                'author' => 'Lê Hoàng Cường',
                'date'   => '2024-01-25'
            ],
        ];

        return view('blog.index', compact('posts'));
    }
}