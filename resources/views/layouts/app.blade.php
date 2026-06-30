<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Phú Xuân Blog') | Phú Xuân Blog</title>

    {{-- Bootstrap 5 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet">

    {{-- CSS riêng của từng trang --}}
    @stack('styles')
</head>
<body class="bg-light">

    {{-- Navbar --}}
    @include('partials.navbar')

    <div class="container mt-4">

        {{-- Flash messages --}}
        @include('partials.flash-messages')

        {{-- Nội dung chính --}}
        @yield('content')
    </div>

    {{-- Footer --}}
    @include('partials.footer')

    {{-- Bootstrap 5 JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
    </script>

    {{-- Auto-dismiss flash messages sau 5 giây --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.alert-dismissible').forEach(function (alert) {
                setTimeout(function () {
                    var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                    if (bsAlert) bsAlert.close();
                }, 5000);
            });
        });
    </script>

    {{-- JavaScript riêng của từng trang --}}
    @stack('scripts')
</body>
</html>