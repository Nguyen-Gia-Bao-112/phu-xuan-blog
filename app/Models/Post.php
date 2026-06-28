<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Tạm thời cho phép tất cả field được mass-assign
    protected $guarded = [];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}