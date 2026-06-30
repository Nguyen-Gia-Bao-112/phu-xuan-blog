<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    // Không dùng authorizeResource() nữa, thay bằng authorize() trong từng method

    public function index(Request $request)
    {
        // viewAny không cần authorize vì ai cũng xem được
        $posts = Post::query()
            ->published()
            ->with(['user', 'category', 'tags'])
            ->withCount('comments')
            ->when($request->search, function ($q, $search) {
                $q->where('title', 'like', "%{$search}%");
            })
            ->when($request->category_id, function ($q, $catId) {
                $q->ofCategory($catId);
            })
            ->when($request->sort === 'popular', function ($q) {
                $q->popular();
            }, function ($q) {
                $q->orderByDesc('published_at');
            })
            ->paginate(10)->withQueryString();

        $categories = Category::all();

        return view('posts.index', compact('posts', 'categories'));
    }

    public function create()
    {
        // Tạo bài viết: user cần đăng nhập (Policy create sẽ kiểm tra)
        $this->authorize('create', Post::class);

        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        // Tạo bài viết: user cần đăng nhập
        $this->authorize('create', Post::class);

        $validated = $request->validated();
        $validated['user_id'] = Auth::id();
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);
        $validated['status'] = 'published';
        $validated['published_at'] = now();

        $post = Post::create($validated);

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        }

        return redirect()->route('posts.index')
            ->with('success', 'Đã thêm bài viết mới thành công.');
    }

    public function show(Post $post)
    {
        // Xem chi tiết: kiểm tra Policy view
        $this->authorize('view', $post);

        $post->load(['tags', 'comments.user']);
        $post->loadCount('comments');
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        // Sửa bài: kiểm tra Policy update
        $this->authorize('update', $post);

        $categories = Category::all();
        $tags = Tag::all();
        $selectedTags = $post->tags->pluck('id')->toArray();

        return view('posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        // Sửa bài: kiểm tra Policy update
        $this->authorize('update', $post);

        $post->update($request->validated());

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')
            ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    public function destroy(Post $post)
    {
        // Xóa bài: kiểm tra Policy delete
        $this->authorize('delete', $post);

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
        $post = Post::onlyTrashed()->findOrFail($id);
        // Có thể thêm authorize('restore', $post) nếu có Policy method restore
        $post->restore();

        return redirect()->route('posts.trashed')
            ->with('success', 'Đã khôi phục bài viết thành công.');
    }
}