@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">📰 Danh sách bài viết</h1>
    @auth
        <a href="{{ route('posts.create') }}" class="btn btn-primary">
            ✏️ Viết bài mới
        </a>
    @endauth
</div>

{{-- FORM TÌM KIẾM VÀ LỌC --}}
<form method="GET" action="{{ route('posts.index') }}" class="row g-2 mb-4">
    <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}"
               class="form-control" placeholder="🔍 Tìm kiếm bài viết...">
    </div>
    <div class="col-md-3">
        <select name="category_id" class="form-select">
            <option value="">📂 Tất cả danh mục</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="col-md-3">
        <select name="sort" class="form-select">
            <option value="newest" {{ request('sort') === 'newest' ? 'selected' : '' }}>🆕 Mới nhất</option>
            <option value="popular" {{ request('sort') === 'popular' ? 'selected' : '' }}>🔥 Phổ biến nhất</option>
        </select>
    </div>
    <div class="col-md-2 d-flex gap-2">
        <button type="submit" class="btn btn-primary w-100">Lọc</button>
        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary w-100">Reset</a>
    </div>
</form>

@if ($posts->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted fs-4">📭 Không tìm thấy bài viết nào.</p>
    </div>
@else
    @foreach ($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1 me-3">
                        <h5 class="card-title">
                            <a href="{{ route('posts.show', $post) }}"
                               class="text-decoration-none text-dark">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small">
                            {{ Str::limit($post->excerpt ?? $post->content, 120) }}
                        </p>

                        {{-- THÔNG TIN CHI TIẾT --}}
                        <div class="d-flex flex-wrap gap-3 text-muted small">
                            <span>👤 {{ $post->user->name ?? 'Unknown' }}</span>
                            <span>·</span>
                            <span>📂 {{ $post->category->name ?? 'Không có' }}</span>
                            <span>·</span>
                            <span>📅 {{ $post->published_at?->format('d/m/Y') ?? 'Chưa đăng' }}</span>
                            <span>·</span>
                            <span>⏱️ {{ $post->reading_time }}</span>
                            <span>·</span>
                            <span>💬 {{ $post->comments_count }} bình luận</span>
                        </div>

                        {{-- Tags --}}
                        @if ($post->tags->isNotEmpty())
                            <div class="mt-2">
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    {{-- NÚT SỬA/XÓA – CHỈ HIỆN CHO TÁC GIẢ --}}
                    <div class="d-flex gap-2 flex-shrink-0">
                        @auth
                            @if (Auth::id() === $post->user_id)
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="btn btn-sm btn-outline-primary">✏️ Sửa</a>
                                <form method="POST"
                                      action="{{ route('posts.destroy', $post) }}"
                                      onsubmit="return confirmDelete('{{ $post->title }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        🗑️ Xóa
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}
    </div>
@endif

@endsection

@push('scripts')
<script>
    function confirmDelete(title) {
        return confirm('Bạn có chắc muốn xóa bài viết: "' + title + '"?');
    }
</script>
@endpush