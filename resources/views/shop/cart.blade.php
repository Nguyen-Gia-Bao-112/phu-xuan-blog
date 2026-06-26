{{-- resources/views/shop/cart.blade.php --}}
@extends('layouts.app')

@section('title', 'Giỏ hàng')

@section('page-header')
    <h1>🛒 Giỏ hàng của bạn</h1>
    <p class="mb-0">Có 3 sản phẩm trong giỏ</p>
@endsection

@section('content')
    <div class="alert alert-info">Giỏ hàng đang trống (demo).</div>
    <a href="{{ route('shop.products') }}" class="btn btn-primary">← Tiếp tục mua sắm</a>
    <a href="{{ route('home') }}" class="btn btn-secondary">Trang chủ</a>
@endsection