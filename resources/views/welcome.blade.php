<!-- resources/views/welcome.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang chủ – MyShop</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; padding: 0 20px; }
        nav a { margin-right: 16px; color: #2E75B6; text-decoration: none; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        nav { background: #f4f4f4; padding: 12px 16px; border-radius: 6px; }
    </style>
</head>
<body>
    <h1>🏠 Chào mừng đến MyShop!</h1>

    <nav>
        <a href="{{ route('home') }}">Trang chủ</a>
        <a href="{{ route('about') }}">Giới thiệu</a>
        <a href="{{ route('shop.products') }}">Sản phẩm</a>
        <a href="{{ route('shop.cart') }}">Giỏ hàng</a>
        <a href="{{ route('contact') }}">Liên hệ</a>
    </nav>

    <p style="margin-top: 24px; color: #555;">
        Đây là trang chủ của ứng dụng demo Lab 1.
    </p>
</body>
</html>