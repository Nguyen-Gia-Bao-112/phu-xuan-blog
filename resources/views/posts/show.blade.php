@extends('layouts.app')

@section('title', $post->title)

@section('content')

<div style="max-width: 760px; margin: 0 auto;">

    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('posts.index') }}">📰 Danh sách</a>
            </li>
            <li class="breadcrumb-item active">
                {{ Str::limit($post->title, 40) }}
            </li>
        </ol>
    </nav>

    <article class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center py-3"
             style="background:#1B2A4A;">
            <h4 class="mb-0 text-white">{{ $post->title }}</h4>
            <div class="d-flex gap-2">
                <a href="{{ route('posts.edit', $post) }}"
                   class="btn btn-sm btn-light">✏️ Sửa</a>
                <form method="POST" action="{{ route('posts.destroy', $post) }}"
                      onsubmit="return confirmDelete('{{ $post->title }}')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">🗑️ Xóa</button>
                </form>
            </div>
        </div>
        <div class="card-body p-4">
            <p class="text-muted small mb-4">
                📅 Tạo lúc {{ $post->created_at->format('d/m/Y H:i') }}
                @if ($post->updated_at != $post->created_at)
                    - Cập nhật {{ $post->updated_at->diffForHumans() }}
                @endif
            </p>
            <div style="line-height:1.8; white-space:pre-wrap;">
                {{ $post->content }}
            </div>
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('posts.index') }}" class="text-muted">
                ← Quay lại danh sách
            </a>
        </div>
    </article>

    {{-- ✅ HIỂN THỊ TAG (LAB 2 BUỔI 7) --}}
    @if ($post->tags->isNotEmpty())
        <div class="mt-4">
            <strong>🏷️ Tags:</strong>
            @foreach ($post->tags as $tag)
                <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
            @endforeach
        </div>
    @endif

    {{-- ✅ HIỂN THỊ BÌNH LUẬN --}}
    <div class="mt-5">
        <h3>💬 Bình luận ({{ $post->comments_count }})</h3>

        @forelse ($post->approvedComments as $comment)
            <div class="card mb-2 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <strong>{{ $comment->user->name }}</strong>
                            <p class="mb-1">{{ $comment->body }}</p>
                        </div>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">Chưa có bình luận nào. Hãy là người đầu tiên bình luận!</p>
        @endforelse
    </div>

</div>

@endsection

@push('scripts')
<script>
    function confirmDelete(title) {
        return confirm('Bạn có chắc muốn xóa bài viết: "' + title + '"?');
    }
</script>
@endpush

@push('styles')
<style>
    .comment-card {
        transition: all 0.2s;
    }
    .comment-card:hover {
        background-color: #f8f9fa;
    }
</style>
@endpush