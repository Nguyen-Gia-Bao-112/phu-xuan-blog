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
    public function index(Request $request)
    {
        $posts = Post::query()
            ->published()                          // Local Scope: status = published & published_at <= now()
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

        // 🔍 DEBUG: Nếu không thấy bài viết, bỏ comment dòng dưới để kiểm tra dữ liệu
        // dd($posts);

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
        // Lấy dữ liệu đã validate
        $validated = $request->validated();

        // Gắn user_id
        $validated['user_id'] = Auth::id();

        // Tạo slug từ title
        $validated['slug'] = Str::slug($validated['title']) . '-' . Str::random(6);

        // ✅ Bắt buộc: set status và published_at để bài viết xuất hiện trên trang danh sách
        $validated['status'] = 'published';
        $validated['published_at'] = now();

        // Tạo bài viết
        $post = Post::create($validated);

        // ✅ Gắn tags (nếu có)
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

    public function edit($id)
{
    $post = Post::findOrFail($id);
    $categories = Category::all();
    $tags = Tag::all();
    $selectedTags = $post->tags->pluck('id')->toArray();

    return view('posts.edit', compact('post', 'categories', 'tags', 'selectedTags'));
}

    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        // Cập nhật dữ liệu cơ bản (title, content, category_id, status...)
        $post->update($request->validated());

        // ✅ Cập nhật tags (quan hệ many-to-many)
        if ($request->has('tags')) {
            $post->tags()->sync($request->input('tags'));
        } else {
            $post->tags()->detach(); // Nếu không chọn tag nào, xóa hết
        }

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