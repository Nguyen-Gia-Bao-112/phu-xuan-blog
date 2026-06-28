<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create($request->validated() + ['user_id' => 1]);

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Bài viết "' . $post->title . '" đã được tạo thành công!');
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

        return redirect()
            ->route('posts.show', $post)
            ->with('success', 'Cập nhật bài viết "' . $post->title . '" thành công!');
    }

    public function destroy(Post $post)
    {
        $title = $post->title;
        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Đã xóa bài viết: ' . $title);
    }
}