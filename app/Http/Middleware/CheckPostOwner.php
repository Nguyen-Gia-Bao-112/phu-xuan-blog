<?php

namespace App\Http\Middleware;

use App\Models\Post;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckPostOwner
{
    public function handle(Request $request, Closure $next): Response
    {
        // Lấy ID từ route parameter
        $postId = $request->route('post');

        // Tìm bài viết bằng ID (không phụ thuộc vào Route Model Binding)
        $post = Post::find($postId);

        // Nếu không tìm thấy → 404
        if (!$post) {
            abort(404, 'Bài viết không tồn tại.');
        }

        // Nếu user hiện tại không phải tác giả → 403
        if (Auth::id() !== $post->user_id) {
            abort(403, 'Bạn không có quyền thực hiện thao tác này.');
        }

        return $next($request);
    }
}