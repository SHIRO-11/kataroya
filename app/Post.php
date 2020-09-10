<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title','category','content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
