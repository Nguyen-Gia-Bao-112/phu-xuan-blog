{{-- resources/views/articles/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tạo bài viết mới')

@section('page-header')
    <h1>✍ Tạo bài viết mới</h1>
@endsection

@section('content')
    <form>
        @csrf
        <div class="mb-3">
            <label class="form-label">Tiêu đề</label>
            <input type="text" name="title" class="form-control" placeholder="Nhập tiêu đề...">
        </div>
        <div class="mb-3">
            <label class="form-label">Tác giả</label>
            <input type="text" name="author" class="form-control" placeholder="Tên tác giả">
        </div>
        <div class="mb-3">
            <label class="form-label">Nội dung</label>
            <textarea name="content" class="form-control" rows="6" placeholder="Viết nội dung..."></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Đăng bài</button>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary">← Quay lại</a>
    </form>
@endsection