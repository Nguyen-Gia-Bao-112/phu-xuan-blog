@extends('layouts.app')

@section('title', $post->title)

@section('content')

{{-- Breadcrumb --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
        <li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <h1 class="h2 mb-3">{{ $post->title }}</h1>

                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <span class="text-muted">👤 Tác giả: {{ $post->user_id }}</span>
                    <span class="text-muted">📅 {{ $post->created_at->format('d/m/Y H:i') }}</span>
                    {{-- Tạm thời bỏ badge vì chưa có cột status --}}
                </div>

                {{-- ✅ ĐÃ SỬA: dùng content thay vì body --}}
                <div class="post-content" style="line-height: 1.8; font-size: 1.05rem;">
                    {{ $post->content }}
                </div>

            </div>
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                ← Quay lại danh sách
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-outline-primary">✏ Sửa bài</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Xác nhận xóa bài viết này?')">
                        🗑 Xóa
                    </button>
                </form>
            </div>
        </div>

    </div>

    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><strong>📋 Thông tin bài viết</strong></div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>ID:</strong> {{ $post->id }}</li>
                <li class="list-group-item"><strong>Tác giả:</strong> {{ $post->user_id }}</li>
                <li class="list-group-item">
                    <strong>Ngày đăng:</strong><br>
                    {{ $post->created_at->format('d/m/Y') }}
                    ({{ $post->created_at->diffForHumans() }})
                </li>
                {{-- Tạm thời bỏ trạng thái vì chưa có cột status --}}
            </ul>
        </div>
    </div>

</div>

@endsection