<?php

namespace App\Http\Controllers;

// ✅ Import Form Request classes
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
   public function index()
{
    // Lấy tất cả bài viết từ database, sắp xếp mới nhất trước
    $posts = Post::latest()->get();  // hoặc ->paginate(10) nếu muốn phân trang
    return view('posts.index', compact('posts'));
}

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        // $request->validated() chỉ chứa title và content
        Post::create($request->validated() + ['user_id' => 1]);

        return redirect()->route('posts.index')
                         ->with('success', 'Tạo bài viết thành công!');
    }

   public function show(Post $post)
{
    return view('posts.show', compact('post'));
}

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return redirect()->route('posts.edit', $post)
                         ->with('success', 'Cập nhật bài viết thành công!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')
                         ->with('success', 'Đã xóa bài viết.');
    }
}