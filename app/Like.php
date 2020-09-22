<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function like_exist($id, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $exist = Like::where('user_id', '=', $id)->where('post_id', '=', $post_id)->get();

        // 空でないなら
        if (!$exist->isEmpty()) {
            return true;
        } else {
            return false;
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
