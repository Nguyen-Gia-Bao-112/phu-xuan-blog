@extends('layouts.app')

@section('title', 'Bài viết đã xoá')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">🗑️ Bài viết đã xoá</h1>
    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
        ← Quay lại danh sách
    </a>
</div>

@if ($posts->isEmpty())
    <div class="text-center py-5">
        <p class="text-muted fs-4">📭 Không có bài viết nào trong thùng rác.</p>
    </div>
@else
    @foreach ($posts as $post)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="card-title mb-1">{{ $post->title }}</h5>
                        <small class="text-muted">
                            🗑️ Đã xoá lúc: {{ $post->deleted_at->format('d/m/Y H:i') }}
                        </small>
                    </div>
                    <form action="{{ route('posts.restore', $post->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-sm btn-success">
                            🔄 Khôi phục
                        </button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

    <div class="d-flex justify-content-center mt-3">
        {{ $posts->links() }}
    </div>
@endif

@endsection