{{-- resources/views/posts/index.blade.php --}}

@extends('layouts.app')            {{-- Kế thừa layout cha --}}

@section('title', 'Danh sách bài viết')  {{-- Điền vào @yield('title') --}}

@section('content')               {{-- Bắt đầu điền vào @yield('content') --}}

    <div class="alert alert-success">
        ✅ Layout hoạt động! Navbar và footer hiển thị từ file riêng.
    </div>

    <h2>Danh sách bài viết</h2>
    <p>Nội dung sẽ được hoàn thiện ở Lab 2.</p>

@endsection                        {{-- Kết thúc section 'content' --}}