<!-- resources/views/articles/index.blade.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách Bài viết</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 900px; margin: 40px auto; padding: 0 20px; }
        .article-card { border: 1px solid #ddd; border-radius: 8px; padding: 16px; margin-bottom: 16px; }
        .article-card h3 { margin: 0 0 8px; color: #1B3F6E; }
        .meta { color: #888; font-size: 14px; }
        a.btn { background: #2E75B6; color: white; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 14px; }
        a { color: #2E75B6; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <h1>📝 Danh sách Bài viết</h1>
    <p>Tổng cộng: <strong>{{ count($articles) }}</strong> bài viết</p>
    <hr>

    @forelse($articles as $article)
        <div class="article-card">
            <h3>
                <a href="{{ route('articles.show', $article['id']) }}">
                    {{ $article['title'] }}
                </a>
            </h3>
            <p class="meta">
                ✍ {{ $article['author'] }}  •  📅 {{ $article['date'] }}
            </p>
        </div>
    @empty
        <p>Chưa có bài viết nào.</p>
    @endforelse

    <a href="{{ route('articles.create') }}" class="btn">+ Thêm bài viết mới</a>
    <br><br>
    <a href="{{ route('home') }}">← Trang chủ</a>
</body>
</html>