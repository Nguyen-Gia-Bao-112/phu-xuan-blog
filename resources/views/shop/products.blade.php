{{-- resources/views/shop/products.blade.php --}}
@extends('layouts.app')

@section('title', 'Sản phẩm')

@section('page-header')
    <h1>🛍️ Sản phẩm</h1>
    <p class="mb-0">Danh sách sản phẩm nổi bật</p>
@endsection

@section('content')
    <div class="row g-3">
        @for($i = 1; $i <= 6; $i++)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Sản phẩm {{ $i }}</h5>
                        <p class="card-text">Giá: 100.000đ</p>
                        <a href="{{ route('shop.cart') }}" class="btn btn-outline-primary btn-sm">Thêm vào giỏ</a>
                    </div>
                </div>
            </div>
        @endfor
    </div>
    <div class="mt-4">
        <a href="{{ route('home') }}" class="btn btn-secondary">← Trang chủ</a>
        <a href="{{ route('shop.cart') }}" class="btn btn-primary">Xem giỏ hàng →</a>
    </div>
@endsection