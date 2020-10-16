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
            'comment_image'=>'file|mimes:jpeg,png,jpg,bmb|max:2048',
        ]);

        $post = Post::findOrFail($request->post_id);

        // 投稿のコメントとして作成
        $comment = $post->comments()->create([
            'name'=>$request->name,
            'comment' => $request->comment,
        ]);

        // 画像を保存
        if ($request->file('comment_image')) {
            //画像をstorage/app/public/avatarの中に保存。また返り値を$pathに保存。
            $path = $request->file('comment_image')->store('public/comments');
            //basenameで画像の名前だけを保存。これをしないとpublic/comments/画像名となってしまう。
            $comment->image = basename($path);
            $comment->save();
        }



        // 前のURLへリダイレクトさせる
        return back();
    }
}
