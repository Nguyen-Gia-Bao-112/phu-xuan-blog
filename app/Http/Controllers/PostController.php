<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Hàm helper: tạo dữ liệu giả dùng chung cho các method
     * Buổi 5-6 sẽ xóa hàm này và dùng Post::all() từ Eloquent
     */
    private function getFakePosts()
    {
        return collect([
            (object)[
                'id'         => 1,
                'title'      => 'Giới thiệu Laravel Framework',
                'body'       => 'Laravel là PHP framework theo kiến trúc MVC, được Taylor Otwell tạo ra năm 2011. Nó cung cấp công cụ giúp xây dựng ứng dụng web nhanh chóng và bảo mật.',
                'author'     => 'Nguyễn Văn An',
                'status'     => 'published',
                'created_at' => now()->subDays(5),
            ],
            (object)[
                'id'         => 2,
                'title'      => 'Blade Template Engine là gì?',
                'body'       => 'Blade là template engine của Laravel, cho phép viết giao diện HTML với cú pháp ngắn gọn. Blade tự động escape dữ liệu để chống tấn công XSS.',
                'author'     => 'Trần Thị Bình',
                'status'     => 'published',
                'created_at' => now()->subDays(2),
            ],
            (object)[
                'id'         => 3,
                'title'      => 'Eloquent ORM – làm việc với database',
                'body'       => 'Eloquent là Object-Relational Mapping (ORM) của Laravel. Mỗi bảng trong database tương ứng với một Model class trong PHP.',
                'author'     => 'Lê Văn Cường',
                'status'     => 'draft',
                'created_at' => now()->subDay(),
            ],
            (object)[
                'id'         => 4,
                'title'      => 'RESTful API với Laravel Sanctum',
                'body'       => 'Xây dựng API chuẩn REST, bảo vệ bằng Sanctum token. API trả về JSON, phân tách hoàn toàn frontend và backend.',
                'author'     => 'Phạm Thị Dung',
                'status'     => 'published',
                'created_at' => now(),
            ],
        ]);
    }

    /**
     * Hiển thị danh sách bài viết
     */
    public function index()
    {
        $posts = $this->getFakePosts();  // Lấy dữ liệu giả
        $totalPosts = $posts->count();   // Đếm số lượng

        return view('posts.index', compact('posts', 'totalPosts'));
    }

    /**
     * Hiển thị form tạo bài viết
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Lưu bài viết mới (chưa implement - sẽ làm ở Buổi 4)
     */
   public function store(Request $request)
{
    $validated = $request->validate(
        // Tham số 1: Rules
        [
            'title'   => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
        ],
        // Tham số 2: Custom Messages (TIẾNG VIỆT)
        [
            'title.required'   => 'Tiêu đề bài viết không được để trống.',
            'title.min'        => 'Tiêu đề phải có ít nhất :min ký tự.',
            'title.max'        => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min'      => 'Nội dung phải có ít nhất :min ký tự.',
        ]
    );

    Post::create([
        'title'   => $validated['title'],
        'content' => $validated['content'],
        'user_id' => 1,
    ]);

    return redirect()->route('posts.index')
                     ->with('success', 'Tạo bài viết thành công!');
}
    public function show(string $id)
    {
        // Tìm bài viết theo id trong collection giả
        $post = $this->getFakePosts()->firstWhere('id', (int)$id);

        // Nếu không tìm thấy → báo lỗi 404
        if (!$post) {
            abort(404, 'Bài viết không tồn tại');
        }

        return view('posts.show', compact('post'));
    }

    /**
     * Hiển thị form chỉnh sửa (chưa implement)
     */
    public function edit(string $id)
    {
        // Tạm thời redirect về trang danh sách
        return redirect()->route('posts.index');
    }

    /**
     * Cập nhật bài viết (chưa implement)
     */
    public function update(Request $request, Post $post)
{
    $validated = $request->validate(
        [
            'title'   => 'required|string|min:5|max:255',
            'content' => 'required|string|min:10',
        ],
        [
            'title.required'   => 'Tiêu đề bài viết không được để trống.',
            'title.min'        => 'Tiêu đề phải có ít nhất :min ký tự.',
            'title.max'        => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min'      => 'Nội dung phải có ít nhất :min ký tự.',
        ]
    );

    $post->update($validated);

    return redirect()->route('posts.edit', $post)
                     ->with('success', 'Cập nhật bài viết thành công!');
}
    public function destroy(string $id)
    {
        return redirect()->route('posts.index');
    }
}