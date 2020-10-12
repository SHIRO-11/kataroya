<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(1);
        $users_lanking = User::total_score('week')->sortByDesc('total')->take(10);
        // サイドバーのプロフィールで使う
        $me =  User::get_me();
        return view('users.index', compact('users', 'users_lanking', 'me'));
    }

    public function show($id)
    {
        $user = User::withCount('posts', 'likes', 'followings', 'followers')->findOrFail($id);

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


        if ($request->file('profile_image')) {
            // 設定しているプロフィール画像の保存先を取得
            $image ='storage/avatar/'.$user->profile_image;
            // 設定していたプロフィール画像を削除
            \File::delete($image);

            //画像をstorage/app/public/avatarの中に保存
            $path = $request->file('profile_image')->store('public/avatar');
            //basenameで画像の名前だけを保存。これをしないとpublic/avatar/画像名となってしまう。
            $user->profile_image = basename($path);
        }

        $user->save();

        return redirect(route('users.show', [
            'user' => $user,
        ]));
    }

    // プロフィールページのいいね一覧
    public function likeslist($id)
    {
        $user = User::withCount('posts', 'likes', 'followings', 'followers')->findOrFail($id);

        $likes = $user->likes()->orderBy('created_at', 'desc')->get();

        return view('users/likeslist', compact('user', 'likes'));
    }

    // プロフィールページのフォロー中ユーザ一覧
    public function followings($id)
    {
        $user = User::withCount('posts', 'likes', 'followings', 'followers')->findOrFail($id);

        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->orderBy('pivot_created_at', 'desc')->get();


        return view('users/followings', compact('user', 'followings'));
    }
    // プロフィールページのフォロワー一覧
    public function followers($id)
    {
        $user = User::withCount('posts', 'likes', 'followings', 'followers')->findOrFail($id);

        // ユーザのフォロー一覧を取得
        $followers = $user->followers()->orderBy('pivot_created_at', 'desc')->get();


        return view('users/followers', compact('user', 'followers'));
    }

    public function lanking($period)
    {
        $users_lanking = User::total_score($period)->sortByDesc('total')->take(10);

        //下記の記述でajaxに引数の値を返す
        return response()->json($users_lanking);
    }
}
