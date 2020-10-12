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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // Categoryモデルとのリレーション
    public function category()
    {
        return $this->hasOne(Category::class);
    }

    public function textLimit($content)
    {
        //文字数の上限
        $limit = 30;
 
        if (mb_strlen($content) > $limit) {
            $content = mb_substr($content, 0, $limit);
            return $content. '[‪...続き‬を読む]' ;
        } else {
            return $content;
        }
    }
}
