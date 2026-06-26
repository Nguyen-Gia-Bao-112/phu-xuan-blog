<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $articles = [
        ['id' => 1, 'title' => 'Giới thiệu Laravel Framework', 'author' => 'Nguyễn Văn A', 'date' => '2024-01-15'],
        ['id' => 2, 'title' => 'Routing trong Laravel – Toàn tập', 'author' => 'Trần Thị B', 'date' => '2024-01-18'],
        ['id' => 3, 'title' => 'Blade Templates – Hướng dẫn chi tiết', 'author' => 'Lê Văn C', 'date' => '2024-01-22'],
        ['id' => 4, 'title' => 'Eloquent ORM – Làm việc với Database', 'author' => 'Phạm Thị D', 'date' => '2024-01-25'],
    ];

    return view('articles.index', compact('articles'));
}
    public function create()
{
    return view('articles.create');
}
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
{
    $allArticles = [
        1 => ['id' => 1, 'title' => 'Giới thiệu Laravel Framework', 'author' => 'Nguyễn Văn A', 'date' => '2024-01-15', 'content' => 'Laravel là một PHP framework mạnh mẽ, giúp xây dựng ứng dụng web nhanh chóng và an toàn.'],
        2 => ['id' => 2, 'title' => 'Routing trong Laravel – Toàn tập', 'author' => 'Trần Thị B', 'date' => '2024-01-18', 'content' => 'Routing là cơ chế ánh xạ URL đến các Controller và hành động tương ứng, giúp tổ chức code rõ ràng.'],
        3 => ['id' => 3, 'title' => 'Blade Templates – Hướng dẫn chi tiết', 'author' => 'Lê Văn C', 'date' => '2024-01-22', 'content' => 'Blade là template engine của Laravel, cung cấp cú pháp ngắn gọn và mạnh mẽ.'],
        4 => ['id' => 4, 'title' => 'Eloquent ORM – Làm việc với Database', 'author' => 'Phạm Thị D', 'date' => '2024-01-25', 'content' => 'Eloquent ORM giúp tương tác với database một cách trực quan qua các Model.'],
    ];

    if (!isset($allArticles[$id])) {
        abort(404, 'Bài viết không tồn tại');
    }

    $article = $allArticles[$id];
    return view('articles.show', compact('article'));
}

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
