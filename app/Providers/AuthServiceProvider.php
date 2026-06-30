<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Post;
use App\Policies\PostPolicy; // ✅ Import PostPolicy

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     */
    protected $policies = [
        Post::class => PostPolicy::class, // ✅ Map Post model với PostPolicy
    ];

    public function boot(): void
    {
        // 🔽 Vẫn giữ Gates từ Lab 1 (không ảnh hưởng đến Policy)
        Gate::define('update-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });

        Gate::define('delete-post', function (User $user, Post $post) {
            return $user->id === $post->user_id;
        });
    }
}