@extends('layouts.app')

@section('title', 'Chỉnh sửa bài viết')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">✏️ Chỉnh sửa bài viết</h1>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm">
                ← Hủy
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>⚠ Vui lòng kiểm tra lại các trường sau:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm">
            <div class="card-body p-4">

                <form action="{{ route('posts.update', $post) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Tiêu đề --}}
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Tiêu đề bài viết <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title" value="{{ old('title', $post->title) }}" required>
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Nội dung --}}
                    <div class="mb-3">
                        <label for="content" class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror"
                                  id="content" name="content" rows="10" required>{{ old('content', $post->content) }}</textarea>
                        @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- DANH MỤC --}}
                    <div class="mb-3">
                        <label for="category_id" class="form-label fw-bold">📂 Danh mục <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror"
                                id="category_id" name="category_id">
                            <option value="">-- Chọn danh mục --</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            <option value="draft" {{ old('status', $post->status) === 'draft' ? 'selected' : '' }}>📝 Lưu nháp</option>
                            <option value="published" {{ old('status', $post->status) === 'published' ? 'selected' : '' }}>✅ Xuất bản</option>
                            <option value="archived" {{ old('status', $post->status) === 'archived' ? 'selected' : '' }}>📦 Lưu trữ</option>
                        </select>
                    </div>

                    {{-- TAGS --}}
                    <div class="mb-3">
                        <label for="tags" class="form-label fw-bold">🏷️ Tags</label>
                        <select name="tags[]" id="tags" class="form-select" multiple>
                            @foreach ($tags as $tag)
                                <option value="{{ $tag->id }}"
                                    {{ in_array($tag->id, old('tags', $selectedTags ?? [])) ? 'selected' : '' }}>
                                    {{ $tag->name }}
                                </option>
                            @endforeach
                        </select>
                        <div class="form-text text-muted">Giữ <kbd>Ctrl</kbd> (hoặc <kbd>⌘ Cmd</kbd>) để chọn nhiều tag.</div>
                        @error('tags')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-success px-4">✅ Cập nhật</button>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">Hủy</a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection

@push('styles')
    <style>
        textarea { resize: vertical; min-height: 200px; }
        .form-label { color: #1B2A4A; }
        select[multiple] { min-height: 120px; }
    </style>
@endpush