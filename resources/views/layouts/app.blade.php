<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{--
        @yield('title', 'Phú Xuân Blog')
        → Nếu view con định nghĩa @section('title', 'Tên trang')
          thì hiện 'Tên trang | Phú Xuân Blog'
        → Nếu view con KHÔNG định nghĩa → hiện 'Phú Xuân Blog' (giá trị mặc định)
    --}}
    <title>@yield('title', 'Phú Xuân Blog') | Phú Xuân Blog</title>

    {{-- Bootstrap 5 CSS từ CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- @stack('styles'): vùng chờ để view con push CSS riêng vào <head> --}}
    @stack('styles')
</head>
<body class="bg-light">

    {{-- Navbar: @include nhúng file partials/navbar.blade.php --}}
    @include('partials.navbar')

    {{-- Vùng nội dung chính – mỗi trang tự định nghĩa --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    {{-- @stack('scripts'): vùng chờ cho JS của từng trang --}}
    @stack('scripts')

</body>
</html>