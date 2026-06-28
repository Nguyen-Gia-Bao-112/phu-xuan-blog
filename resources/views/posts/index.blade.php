@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')

{{-- Hiển thị flash message nếu có --}}
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Header section: tiêu đề + thống kê --}}
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-1">📰 Danh sách bài viết</h1>
        <p class="text-muted mb-0">Tổng cộng {{ $posts->count() }} bài viết</p>
    </div>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        ✏ Viết bài mới
    </a>
</div>

@forelse ($posts as $post)
    <div class="card mb-3 shadow-sm">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-start">
                <div class="flex-grow-1">
                    <span class="text-muted small">#{{ $loop->iteration }}</span>
                    <h5 class="card-title mt-1">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                            {{ $post->title }}
                        </a>
                    </h5>
                    <p class="card-text text-muted">
                        {{ Str::limit($post->content, 100) }}
                    </p>
                    <small class="text-muted">
                        👤 Tác giả: {{ $post->user_id }} &nbsp;·&nbsp; 📅 {{ $post->created_at->diffForHumans() }}
                    </small>
                </div>
                {{-- Tạm thời bỏ badge vì chưa có cột status --}}
            </div>
            <div class="mt-2 pt-2 border-top d-flex gap-2">
                <a href="{{ route('posts.show', $post->id) }}" class="btn btn-sm btn-outline-primary">👁 Xem</a>
                <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-outline-secondary">✏ Sửa</a>
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Xóa bài viết này?')">
                        🗑 Xóa
                    </button>
                </form>
            </div>
        </div>
    </div>
    @if ($loop->last)
        <p class="text-center text-muted small mt-3">
            — Đã hiển thị tất cả {{ $loop->count }} bài viết —
        </p>
    @endif
@empty
    <div class="text-center py-5">
        <p class="text-muted fs-4">📭 Chưa có bài viết nào.</p>
        <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">
            ✏ Viết bài đầu tiên
        </a>
    </div>
@endforelse

@endsection