<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request)
    {

        // バリデーション
        $request->validate([
            'name' => 'required|max:30',
            'comment'=>'required|max:3000',
            'post_id' => 'required|exists:posts,id',
        ]);

        $post = Post::findOrFail($request->post_id);

        // 投稿のコメントとして作成
        $post->comments()->create([
            'name'=>$request->name,
            'comment' => $request->comment,
        ]);


        // 前のURLへリダイレクトさせる
        return back();
    }
}
