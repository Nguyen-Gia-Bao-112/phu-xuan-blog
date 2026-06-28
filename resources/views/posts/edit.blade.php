{{-- resources/views/posts/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Chỉnh sửa: ' . $post->title)

@section('content')
<div class='container mt-4' style='max-width: 760px;'>

    <div class='d-flex justify-content-between align-items-center mb-4'>
        <h2>✏️ Chỉnh sửa bài viết</h2>
        <a href='{{ route("posts.show", $post) }}' class='btn btn-outline-secondary'>
            ← Xem bài viết
        </a>
    </div>

    @if ($errors->any())
        <div class='alert alert-danger'>
            <strong>⚠ Vui lòng kiểm tra lại:</strong>
            <ul class='mb-0 mt-2'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class='alert alert-success'>{{ session('success') }}</div>
    @endif

    <div class='card shadow-sm'>
        <div class='card-body p-4'>
            <form method='POST' action='{{ route("posts.update", $post) }}'>
                @csrf
                @method('PUT')

                <div class='mb-4'>
                    <label for='title' class='form-label fw-bold'>
                        Tiêu đề <span class='text-danger'>*</span>
                    </label>
                    <input
                        type='text'
                        id='title'
                        name='title'
                        value='{{ old("title", $post->title) }}'
                        class='form-control @error("title") is-invalid @enderror'
                    >
                    @error('title')
                        <div class='invalid-feedback'>{{ $message }}</div>
                    @enderror
                </div>

                <div class='mb-4'>
                    <label for='content' class='form-label fw-bold'>
                        Nội dung <span class='text-danger'>*</span>
                    </label>
                    <textarea
                        id='content'
                        name='content'
                        rows='8'
                        class='form-control @error("content") is-invalid @enderror'
                    >{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <div class='invalid-feedback'>{{ $message }}</div>
                    @enderror
                </div>

                <hr>
                <div class='d-flex gap-2'>
                    <button type='submit' class='btn btn-success px-4'>
                        ✅ Cập nhật
                    </button>
                    <a href='{{ route("posts.show", $post) }}' class='btn btn-light'>Hủy</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection