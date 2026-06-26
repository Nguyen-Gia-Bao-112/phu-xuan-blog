{{-- resources/views/articles/show.blade.php --}}
@extends('layouts.app')

@section('title', $article['title'])

@section('content')
    <div class="mb-3">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-sm">← Quay lại danh sách</a>
    </div>

    <h1>{{ $article['title'] }}</h1>
    <p class="text-muted small">
        ✍ Tác giả: {{ $article['author'] }} &nbsp;•&nbsp; 📅 {{ $article['date'] }}
    </p>

    <div style="line-height: 1.8;">
        <p>{{ $article['content'] ?? 'Nội dung đang được cập nhật...' }}</p>
    </div>

    <div class="mt-4">
        <a href="{{ route('articles.edit', $article['id']) }}" class="btn btn-warning btn-sm">✏ Chỉnh sửa</a>
        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-sm">📋 Danh sách</a>
    </div>
@endsection