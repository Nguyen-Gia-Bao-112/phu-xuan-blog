<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Title động: view con có thể đặt --}}
    <title>@yield('title', 'Phú Xuân Blog') – Đại học Phú Xuân</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- Custom CSS của từng trang (nếu có) --}}
    @stack('styles')

    <style>
        body { padding-top: 0; }
        .footer { background: #343a40; color: #aaa; padding: 20px 0; margin-top: 60px; }
        .footer a { color: #ccc; text-decoration: none; }
        .page-header { background: linear-gradient(135deg, #1B3F6E 0%, #2E75B6 100%);
                       color: white; padding: 40px 0; margin-bottom: 32px; }
    </style>
</head>
<body>

    {{-- Navigation --}}
    @include('components.navbar')

    {{-- Page Header (tuỳ chọn) --}}
    @hasSection('page-header')
        <div class="page-header">
            <div class="container">
                @yield('page-header')
            </div>
        </div>
    @endif

    {{-- Nội dung chính --}}
    <main class="container py-4">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="footer">
        <div class="container text-center">
            <p class="mb-0">
                &copy; {{ date('Y') }} Phú Xuân Blog &nbsp;•&nbsp;
                <a href="{{ route('about') }}">Giới thiệu</a> &nbsp;•&nbsp;
                <a href="{{ route('contact') }}">Liên hệ</a>
            </p>
            @yield('footer-extra')
        </div>
    </footer>

    {{-- Bootstrap 5 JS (cho navbar toggle) --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Custom JS của từng trang (nếu có) --}}
    @stack('scripts')

</body>
</html>