{{-- resources/views/partials/navbar.blade.php --}}

<nav class="navbar navbar-expand-lg navbar-dark" style="background: #1B2A4A;">
    <div class="container">

        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            📝 Phú Xuân Blog
        </a>

        <button class="navbar-toggler" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                {{-- Menu công khai --}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">🏠 Trang chủ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('posts.index') }}">📰 Bài viết</a>
                </li>

                {{-- Chỉ hiển thị khi đã đăng nhập --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.create') }}">✏️ Viết bài</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('posts.trashed') }}">🗑️ Thùng rác</a>
                    </li>
                @endauth

                <li class="nav-item">
                    <a class="nav-link" href="/about">ℹ️ Giới thiệu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">📞 Liên hệ</a>
                </li>

                {{-- Phần Auth --}}
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            👤 {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    ⚙️ Hồ sơ
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        🚪 Đăng xuất
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">🔑 Đăng nhập</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">📝 Đăng ký</a>
                    </li>
                @endauth
            </ul>
        </div>

    </div>
</nav>