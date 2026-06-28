{{-- resources/views/welcome.blade.php --}}
@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')

{{-- HERO SECTION --}}
<section class="hero-section text-center py-5 mb-5" style="background: linear-gradient(135deg, #1B2A4A 0%, #2d4a7a 100%); border-radius: 20px;">
    <div class="container py-5">
        <h1 class="display-4 fw-bold text-white mb-3">
            📝 Phú Xuân Blog
        </h1>
        <p class="lead text-white-50 mb-4" style="font-size: 1.25rem;">
            Nơi chia sẻ kiến thức về Laravel và lập trình web
        </p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('posts.index') }}" class="btn btn-light btn-lg px-4">
                📰 Xem bài viết
            </a>
            <a href="{{ route('posts.create') }}" class="btn btn-outline-light btn-lg px-4">
                ✏️ Viết bài mới
            </a>
        </div>
    </div>
</section>

{{-- FEATURES SECTION --}}
<div class="row g-4 mb-5">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4">
            <div class="display-4 mb-3">📚</div>
            <h5 class="card-title">Bài viết chất lượng</h5>
            <p class="card-text text-muted">Tổng hợp kiến thức Laravel từ cơ bản đến nâng cao</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4">
            <div class="display-4 mb-3">👨‍💻</div>
            <h5 class="card-title">Học cùng cộng đồng</h5>
            <p class="card-text text-muted">Chia sẻ và học hỏi từ những người cùng đam mê</p>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0 text-center p-4">
            <div class="display-4 mb-3">🚀</div>
            <h5 class="card-title">Dự án thực tế</h5>
            <p class="card-text text-muted">Áp dụng kiến thức vào dự án blog hoàn chỉnh</p>
        </div>
    </div>
</div>

{{-- BÀI VIẾT MỚI NHẤT --}}
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="h4 mb-0">📰 Bài viết mới nhất</h3>
        <a href="{{ route('posts.index') }}" class="btn btn-sm btn-outline-primary">
            Xem tất cả →
        </a>
    </div>

    @php
        $recentPosts = App\Models\Post::latest()->take(3)->get();
    @endphp

    @if ($recentPosts->isEmpty())
        <div class="text-center py-4 text-muted">
            <p>Chưa có bài viết nào. Hãy viết bài đầu tiên!</p>
            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                ✏️ Viết bài ngay
            </a>
        </div>
    @else
        <div class="row g-3">
            @foreach ($recentPosts as $post)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                                    {{ Str::limit($post->title, 40) }}
                                </a>
                            </h5>
                            <p class="card-text small text-muted">
                                {{ Str::limit($post->content, 80) }}
                            </p>
                            <small class="text-muted">
                                📅 {{ $post->created_at->diffForHumans() }}
                            </small>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="{{ route('posts.show', $post) }}" class="btn btn-sm btn-primary">
                                Đọc tiếp →
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

{{-- CALL TO ACTION --}}
<div class="text-center py-5 mt-4" style="background: #f8f9fa; border-radius: 20px;">
    <h3 class="mb-3">✨ Sẵn sàng chia sẻ kiến thức?</h3>
    <p class="text-muted mb-4">Tạo bài viết mới và đóng góp cho cộng đồng</p>
    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-lg">
        ✏️ Viết bài ngay
    </a>
</div>

@endsection