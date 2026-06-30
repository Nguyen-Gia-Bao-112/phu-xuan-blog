<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;     // ← Thêm dòng này
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    /**
     * GET /api/v1/posts - Danh sách bài viết
     */
    public function index(): JsonResponse
    {
        $posts = Post::with(['category', 'author'])
                     ->latest()
                     ->paginate(10);

        return response()->json([
            'success' => true,
            // ✅ Dùng PostResource::collection() thay vì $posts->items()
            'data'    => PostResource::collection($posts),
            'meta'    => [
                'current_page' => $posts->currentPage(),
                'last_page'    => $posts->lastPage(),
                'per_page'     => $posts->perPage(),
                'total'        => $posts->total(),
            ]
        ]);
    }

    /**
     * GET /api/v1/posts/{post} - Chi tiết bài viết
     */
    public function show(Post $post): JsonResponse
    {
        $post->load(['category', 'author', 'tags']);
        return response()->json([
            'success' => true,
            'data'    => new PostResource($post),  // ✅ Wrap bằng Resource
        ]);
    }

    /**
     * POST /api/v1/posts - Tạo bài viết mới
     */
   public function store(Request $request): JsonResponse
{
    $validated = $request->validate([
        'title'       => 'required|string|max:255',
        'content'     => 'required|string',          // ← ĐỔI 'body' THÀNH 'content'
        'category_id' => 'required|exists:categories,id',
        'status'      => 'in:draft,published',
    ]);

    $validated['user_id'] = 1;
    $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']) . '-' . rand(1000, 9999);
    $validated['published_at'] = now();

    $post = Post::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Tạo bài viết thành công.',
        'data'    => new PostResource($post->load('category')),
    ], 201);
}

    /**
     * PUT /api/v1/posts/{post} - Cập nhật bài viết
     */
    public function update(Request $request, Post $post): JsonResponse
    {
        $validated = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'body'        => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'status'      => 'in:draft,published',
        ]);

        $post->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Cập nhật thành công.',
            'data'    => new PostResource($post->fresh(['category'])),
        ]);
    }

    /**
     * DELETE /api/v1/posts/{post} - Xóa bài viết
     */
    public function destroy(Post $post): JsonResponse
    {
        $post->delete();
        return response()->json([
            'success' => true,
            'message' => 'Đã xóa bài viết.',
        ]);
    }
}