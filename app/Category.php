<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'category_name',
    ];

    // Postモデルとのリレーション
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
