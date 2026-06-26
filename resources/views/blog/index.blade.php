<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Phú Xuân Blog</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 40px auto; }
        .post-card { border: 1px solid #ddd; padding: 16px; margin-bottom: 16px; border-radius: 6px; }
        .post-meta { color: #666; font-size: 13px; margin-top: 6px; }
    </style>
</head>
<body>
    <h1>Phú Xuân Blog</h1>
    <p>Tổng số bài viết: <strong>{{ count($posts) }}</strong></p>

    @forelse ($posts as $post)
        <div class="post-card">
            <h2>{{ $post['title'] }}</h2>
            <div class="post-meta">
                Tác giả: {{ $post['author'] }} | Ngày: {{ $post['date'] }}
            </div>
        </div>
    @empty
        <p>Chưa có bài viết nào.</p>
    @endforelse
</body>
</html>