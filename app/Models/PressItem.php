<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PressItem extends Model
{
    protected $fillable = ['title', 'source', 'url', 'image', 'published_at', 'excerpt'];

    protected $casts = [
        'published_at' => 'date',
    ];
}
