<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();
        $users_lanking = User::total_score('week')->sortByDesc('total');
        return view('users.index', compact('users', 'users_lanking'));
    }

    public function show($id)
    {
        $user = User::withCount('posts', 'likes', 'followings')->findOrFail($id);
        $posts = $user->posts()->orderBy('id', 'desc')->get();
        

        return view('users.show', compact('user', 'posts'));
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    public function update(Request $request)
    {

        // バリデーション
        $request->validate([
            'name' => 'required|max:255',
            'introduction' => 'max:300',
            'blog_url' => 'url|nullable|max:255',
            'twitter_url' => 'url|nullable|max:255',
            'instagram_url' => 'url|nullable|max:255',
            'youtube_url' => 'url|nullable|max:255',
            'profile_image'=>'file|mimes:jpeg,png,jpg,bmb|max:2048',
        ]);

        $user = $request->user();

        $user->name=$request->name;
        $user->introduction=$request->introduction;
        $user->blog_url=$request->blog_url;
        $user->twitter_url=$request->twitter_url;
        $user->instagram_url=$request->instagram_url;
        $user->youtube_url=$request->youtube_url;

        //画像をstorage/app/public/avatarの中に保存
        $path = $request->file('profile_image')->store('public/avatar');
        //basenameで画像の名前だけを保存。これをしないとpublic/avatar/画像名となってしまう。
        $user->profile_image = basename($path);

        $user->save();

        return redirect(route('users.show', [
            'user' => $user,
        ]));
    }

    // プロフィールページのいいね一覧
    public function likeslist($id)
    {
        $user = User::withCount('posts', 'likes', 'followings')->findOrFail($id);

        $likes = $user->likes()->orderBy('created_at', 'desc')->get();

        return view('users/likeslist', compact('user', 'likes'));
    }

    public function followings($id)
    {
        $user = User::withCount('posts', 'likes', 'followings')->findOrFail($id);
        

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->get();


        return view('users/followings', compact('user', 'followings'));
    }

    public function lanking($period)
    {
        $users_lanking = User::total_score($period)->sortByDesc('total');

        //下記の記述でajaxに引数の値を返す
        return response()->json($users_lanking);
    }
}
