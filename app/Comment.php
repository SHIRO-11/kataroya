<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['comment','name'];

    // コメントは一つの投稿に従属
    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
