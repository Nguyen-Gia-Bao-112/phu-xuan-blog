{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('title', 'Liên hệ')

@section('page-header')
    <h1>📞 Liên hệ</h1>
    <p class="mb-0">Chúng tôi luôn sẵn sàng lắng nghe bạn</p>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <h4>Thông tin liên hệ</h4>
            <ul class="list-unstyled">
                <li><strong>Email:</strong> contact@phuxuanblog.com</li>
                <li><strong>Điện thoại:</strong> (0236) 123 456</li>
                <li><strong>Địa chỉ:</strong> Đại học Phú Xuân, Huế</li>
            </ul>
        </div>
        <div class="col-md-6">
            <h4>Gửi tin nhắn</h4>
            <p>Form liên hệ sẽ được cập nhật ở buổi sau.</p>
        </div>
    </div>
@endsection