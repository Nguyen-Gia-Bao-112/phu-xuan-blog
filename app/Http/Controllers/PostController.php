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
        // Tạm thời redirect về trang danh sách
        return redirect()->route('posts.index')
            ->with('success', 'Bài viết đã được tạo thành công!');
    }

    /**
     * Hiển thị chi tiết 1 bài viết
     */
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
    public function update(Request $request, string $id)
    {
        return redirect()->route('posts.index');
    }

    /**
     * Xóa bài viết (chưa implement)
     */
    public function destroy(string $id)
    {
        return redirect()->route('posts.index');
    }
}