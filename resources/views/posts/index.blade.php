@extends('layouts.app')

@section('title', 'Danh sách bài viết')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">📰 Danh sách bài viết</h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        ✏️ Viết bài mới
    </a>
</div>

@if ($posts->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted fs-4">📭 Chưa có bài viết nào.</p>
        <a href="{{ route('posts.create') }}" class="btn btn-outline-primary mt-2">
            ✏️ Viết bài đầu tiên
        </a>
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
                            {{ Str::limit($post->content, 120) }}
                        </p>

                        {{-- ✅ HIỂN THỊ TÁC GIẢ, DANH MỤC, NGÀY, BÌNH LUẬN --}}
                        <div class="d-flex flex-wrap gap-2 text-muted small">
                            <span>👤 {{ $post->user->name ?? 'Unknown' }}</span>
                            <span>·</span>
                            <span>📂 {{ $post->category->name ?? 'Không có' }}</span>
                            <span>·</span>
                            <span>📅 {{ $post->created_at->diffForHumans() }}</span>
                            <span>·</span>
                            <span>💬 {{ $post->comments_count }} bình luận</span>
                        </div>

                        {{-- ✅ HIỂN THỊ TAG --}}
                        @if ($post->tags->isNotEmpty())
                            <div class="mt-2">
                                @foreach ($post->tags as $tag)
                                    <span class="badge bg-secondary me-1">{{ $tag->name }}</span>
                                @endforeach
                            </div>
                        @endif

                    </div>
                    <div class="d-flex gap-2 flex-shrink-0">
                        <a href="{{ route('posts.edit', $post) }}"
                           class="btn btn-sm btn-outline-primary">✏️ Sửa</a>

                        {{-- Form xóa với confirm dialog --}}
                        <form method="POST"
                              action="{{ route('posts.destroy', $post) }}"
                              onsubmit="return confirmDelete('{{ $post->title }}')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                🗑️ Xóa
                            </button>
                        </form>
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