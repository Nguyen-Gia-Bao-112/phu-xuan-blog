@extends('layouts.app')

@section('title', 'Viết bài mới')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">✏ Viết bài mới</h1>
            <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm">
                ← Hủy
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">

                {{--
                    QUAN TRỌNG: action='{{ route('posts.store') }}' method='POST'
                    @csrf BẮT BUỘC có trong mọi form POST/PUT/DELETE
                    Nếu thiếu @csrf → Laravel báo lỗi 419 (Page Expired)
                --}}
                <form action="{{ route('posts.store') }}" method="POST">
                    @csrf

                    {{-- Tiêu đề --}}
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">
                            Tiêu đề bài viết <span class="text-danger">*</span>
                        </label>
                        {{--
                            old('title'): điền lại giá trị cũ khi form bị lỗi validation
                            (sẽ dùng ở Buổi 4 khi học Validation)
                        --}}
                        <input type="text"
                               class="form-control @error('title') is-invalid @enderror"
                               id="title" name="title"
                               value="{{ old('title') }}"
                               placeholder="Nhập tiêu đề bài viết..."
                               required>
                        {{--
                            @error('title'): hiển thị lỗi validation của field 'title'
                            (sẽ hoạt động đầy đủ sau Buổi 4 khi thêm validation rules)
                        --}}
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nội dung --}}
                    <div class="mb-3">
                        <label for="body" class="form-label fw-bold">
                            Nội dung <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control @error('body') is-invalid @enderror"
                                  id="body" name="body"
                                  rows="10"
                                  placeholder="Nhập nội dung bài viết..."
                                  required>{{ old('body') }}</textarea>
                        @error('body')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Trạng thái --}}
                    <div class="mb-4">
                        <label for="status" class="form-label fw-bold">Trạng thái</label>
                        <select class="form-select" id="status" name="status">
                            {{--
                                old('status', 'draft'): giá trị cũ nếu có, mặc định 'draft'
                                So sánh để set selected đúng option
                            --}}
                            <option value="draft"
                                {{ old('status', 'draft') === 'draft' ? 'selected' : '' }}>
                                📝 Lưu nháp
                            </option>
                            <option value="published"
                                {{ old('status') === 'published' ? 'selected' : '' }}>
                                ✅ Xuất bản ngay
                            </option>
                        </select>
                    </div>

                    {{-- Nút submit --}}
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary px-4">
                            💾 Đăng bài
                        </button>
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                            Hủy
                        </a>
                    </div>

                </form>
            </div>
        </div>

    </div>
</div>

@endsection

{{-- Push CSS riêng cho trang này vào @stack('styles') của layout --}}
@push('styles')
    <style>
        textarea { resize: vertical; min-height: 200px; }
        .form-label { color: #1B2A4A; }
    </style>
@endpush