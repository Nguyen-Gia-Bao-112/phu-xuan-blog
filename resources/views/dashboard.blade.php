@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">📊 Dashboard</h4>
            </div>
            <div class="card-body">

                {{-- Thông tin user --}}
                <h2 class="h3 mb-3">
                    Xin chào, <strong>{{ Auth::user()->name }}</strong>! 👋
                </h2>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <p class="text-muted mb-1">📧 Email</p>
                            <p class="fw-bold">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="p-3 bg-light rounded">
                            <p class="text-muted mb-1">📅 Tham gia từ</p>
                            <p class="fw-bold">{{ Auth::user()->created_at->format('d/m/Y') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Thống kê bài viết --}}
                @php
                    $postCount = Auth::user()->posts()->count();
                @endphp

                <div class="p-4 bg-warning bg-opacity-10 border border-warning rounded">
                    <p class="mb-1 text-warning fw-bold">📝 Bài viết của bạn</p>
                    <p class="display-6 fw-bold">{{ $postCount }} bài viết</p>
                    <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm mt-2">
                        ✏️ Viết bài mới
                    </a>
                    <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary btn-sm mt-2">
                        📰 Xem tất cả bài viết
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection