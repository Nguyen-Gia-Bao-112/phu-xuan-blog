<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // ✅ Liệt kê các field được phép mass-assign
    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];
}