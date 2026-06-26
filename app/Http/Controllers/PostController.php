<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return 'Danh sách bài viết (index)';
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