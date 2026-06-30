<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->published()                          // Local Scope
            ->with(['user', 'category', 'tags'])   // Eager loading
            ->withCount('comments')                // Đếm comments
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($q, $catId) {
                $q->ofCategory($catId);            // Scope with parameter
            })
            ->when($request->sort === 'popular', function ($q) {
                $q->popular();                     // Scope popular
            }, function ($q) {
                $q->orderByDesc('published_at');   // Default: mới nhất
            })
            ->paginate(10)->withQueryString();

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(StorePostRequest $request)
    {
        Post::create($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Đã thêm bài viết mới thành công.');
    }

    public function show($id)
    {
        $post = Post::with(['tags', 'comments.user'])
                    ->withCount('comments')
                    ->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->validated());

        return redirect()->route('posts.index')
            ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index')
            ->with('success', 'Đã xóa bài viết.');
    }

    // ─── Soft Delete Methods ─────────────────────────────────────────
    public function trashed()
    {
        $posts = Post::onlyTrashed()->latest('deleted_at')->paginate(10);
        return view('posts.trashed', compact('posts'));
    }

    public function restore($id)
    {
        Post::onlyTrashed()->findOrFail($id)->restore();

        return redirect()->route('posts.trashed')
            ->with('success', 'Đã khôi phục bài viết thành công.');
    }
}