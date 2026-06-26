<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
{
    // Tạm thời return view để test layout
    // Buổi 5-6 sẽ thay bằng dữ liệu thật từ database
    return view('posts.index');
}

    public function create()
    {
        return 'Form tạo bài viết (create)';
    }

    public function store(Request $request)
    {
        return 'Lưu bài viết (store)';
    }

    public function show($post)
    {
        return 'Xem chi tiết bài viết có ID: ' . $post;
    }

    public function edit($post)
    {
        return 'Sửa bài viết có ID: ' . $post;
    }

    public function update(Request $request, $post)
    {
        return 'Cập nhật bài viết ID: ' . $post;
    }

    public function destroy($post)
    {
        return 'Xóa bài viết ID: ' . $post;
    }
}