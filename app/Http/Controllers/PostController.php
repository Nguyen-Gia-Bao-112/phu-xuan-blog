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
use Illuminate\Support\Facades\Gate; // ✅ THÊM IMPORT NÀY

class PostController extends Controller
{
    public function index(Request $request)
    {
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
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
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

    public function show($id)
    {
        $post = Post::with(['tags', 'comments.user'])
                    ->withCount('comments')
                    ->findOrFail($id);
        return view('posts.show', compact('post'));
    }

    // ✅ BƯỚC 2: ÁP DỤNG GATE VÀO edit()
  public function edit($id)
{
    $post = Post::findOrFail($id);

    // Kiểm tra Gate – nếu không có quyền thì abort 403
    if (! Gate::allows('update-post', $post)) {
        abort(403, 'Bạn không có quyền chỉnh sửa bài viết này!');
    }

    $categories = Category::all();
    $tags = Tag::all();
    $selectedTags = $post->tags->pluck('id')->toArray();

    return view('posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
}
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        // Gate::authorize() tự động ném exception 403 nếu không có quyền
        Gate::authorize('update-post', $post);

        $post->update($request->validated());

        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach();
        }

        return redirect()->route('posts.index')
            ->with('success', 'Đã cập nhật bài viết thành công.');
    }

    // ✅ BƯỚC 2: ÁP DỤNG GATE VÀO destroy()
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if (! Gate::allows('delete-post', $post)) {
            abort(403, 'Bạn không có quyền xóa bài viết này!');
        }

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