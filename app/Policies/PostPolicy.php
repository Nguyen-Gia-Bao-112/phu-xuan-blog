<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
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
     * Sửa bài: chỉ tác giả
     */
    public function update(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    /**
     * Xóa bài: chỉ tác giả
     */
    public function delete(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }
}