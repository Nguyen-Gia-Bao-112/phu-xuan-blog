@extends('layouts.app')

{{-- @section với 2 tham số: tên section và giá trị ngắn gọn --}}
@section('title', $post->title)

@section('content')

{{-- Breadcrumb: giúp user biết đang ở đâu trong site --}}
<nav aria-label="breadcrumb" class="mb-4">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
        <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">Bài viết</a></li>
        {{--
            Str::limit giới hạn tiêu đề breadcrumb để không quá dài
            active: item cuối của breadcrumb không cần link
        --}}
        <li class="breadcrumb-item active">{{ Str::limit($post->title, 40) }}</li>
    </ol>
</nav>

<div class="row">
    <div class="col-lg-8">

        {{-- Card nội dung chính --}}
        <div class="card shadow-sm">
            <div class="card-body p-4">

                {{-- Tiêu đề bài viết --}}
                <h1 class="h2 mb-3">{{ $post->title }}</h1>

                {{-- Meta thông tin --}}
                <div class="d-flex align-items-center gap-3 mb-4 pb-3 border-bottom">
                    <span class="text-muted">👤 {{ $post->author }}</span>
                    <span class="text-muted">📅 {{ $post->created_at->format('d/m/Y H:i') }}</span>
                  <x-badge :status="$post->status" />
                </div>

                {{--
                    NỘI DUNG BÀI VIẾT:
                    Dùng {{ }} (có escape): an toàn, nhưng không render HTML
                    Dùng {!! !!} (không escape): render HTML, nhưng chỉ dùng khi nội dung đã sanitize
                    → Hiện tại dùng {{ }} vì nội dung là text thuần
                --}}
                <div class="post-content" style="line-height: 1.8; font-size: 1.05rem;">
                    {{ $post->body }}
                </div>

            </div>
        </div>

        {{-- Nút điều hướng --}}
        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                ← Quay lại danh sách
            </a>
            <div class="d-flex gap-2">
                <a href="{{ route('posts.edit', $post->id) }}"
                   class="btn btn-outline-primary">✏ Sửa bài</a>
                {{-- Form xóa với @csrf và @method('DELETE') --}}
                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"
                            onclick="return confirm('Xác nhận xóa bài viết này?')">
                        🗑 Xóa
                    </button>
                </form>
            </div>
        </div>

    </div>

    {{-- Sidebar --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header"><strong>📋 Thông tin bài viết</strong></div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <strong>ID:</strong> {{ $post->id }}
                </li>
                <li class="list-group-item">
                    <strong>Tác giả:</strong> {{ $post->author }}
                </li>
                <li class="list-group-item">
                    <strong>Ngày đăng:</strong><br>
                    {{ $post->created_at->format('d/m/Y') }}
                    ({{ $post->created_at->diffForHumans() }})
                </li>
                <li class="list-group-item">
                    <strong>Trạng thái:</strong>
                    @if ($post->status === 'published')
                        <span class="text-success">Đã xuất bản</span>
                    @else
                        <span class="text-warning">Bản nháp</span>
                    @endif
                </li>
            </ul>
        </div>
    </div>

</div>

@endsection