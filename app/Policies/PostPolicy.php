<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * before() – chạy TRƯỚC MỌI method khác trong Policy
     * 
     * Return true  → cho phép ngay (admin bypass)
     * Return null  → tiếp tục check method tương ứng
     * 
     * LƯU Ý: KHÔNG return false ở đây – sẽ block cả admin!
     */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->isAdmin()) {
            return true; // Admin bypass tất cả → không cần check tiếp
        }
        return null; // Không phải admin → tiếp tục check method
    }

    /**
     * Danh sách bài viết: ai cũng xem được (kể cả guest)
     */
    public function viewAny(?User $user): bool
    {
        return true;
    }

    /**
     * Chi tiết bài viết: published thì ai cũng xem, draft chỉ tác giả
     */
    public function view(?User $user, Post $post): bool
    {
        if ($post->status === 'published') {
            return true;
        }
        return $user?->id === $post->user_id;
    }

    /**
     * Tạo bài mới: phải đăng nhập
     */
    public function create(User $user): bool
    {
        return true; // Mọi user đăng nhập đều tạo được
    }

    /**
     * Sửa bài: editor có thể sửa tất cả, user thường chỉ sửa của mình
     */
    public function update(User $user, Post $post): bool
    {
        if ($user->isEditor()) {
            return true; // Editor sửa được tất cả bài
        }
        return $user->owns($post); // User thường: chỉ bài của mình
    }

    /**
     * Xóa bài: chỉ tác giả (admin đã bypass qua before())
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->owns($post);
    }
}