<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;
use App\Category;
use Carbon\Carbon; //カーボンを使用する
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $me =  User::get_me();

        $data = [];
        // ユーザの投稿の一覧を作成日時の降順で取得
        $posts = Post::withCount('likes', 'comments')->orderBy('created_at', 'desc')->paginate(15);
        $like_model = new Like;

        $users_lanking = User::total_score('week')->sortByDesc('total');

        $data = [
                'posts' => $posts,
                'like_model'=>$like_model,
                'users_lanking'=>$users_lanking,
                'me' => $me,
            ];

        // Welcomeビューでそれらを表示
        return view('posts.index', $data);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'title' => 'required|max:255',
            'category'=>'required',
            'content'=>'required|max:3000',
        ]);

        // 認証済みユーザ（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
        $post = $request->user()->posts()->create([
            'title'=>$request->title,
            'content' => $request->content,
        ]);

        // カテゴリーも保存。リレーション関係にある時はsaveメソッドを使う
        $post->category()->create([
            'category_name'=>$request->category,
        ]);


        // 前のURLへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $comments=$post->comments()->get();
        $like_model = new Like;

        $post = Post::withCount('likes', 'comments')->findOrFail($post->id);

        return view('posts.show', compact('post', 'comments', 'like_model'));
    }

    public function edit(Post $post)
    {
        //
    }


    public function update(Request $request, Post $post)
    {
        //
    }

    public function destroy(Post $post)
    {
        //
    }

    public function ajaxlike(Request $request)
    {
        $id = Auth::user()->id;
        $post_id = $request->post_id;
        $like = new Like;
        $post = Post::findOrFail($post_id);

        // 空でないなら
        if ($like->like_exist($id, $post_id)) {
            //likesテーブルのレコードを削除
            $like = Like::where('post_id', $post_id)->where('user_id', $id)->delete();
        } else {
            //likesテーブルに新しいレコードを作成する
            $like = new Like;
            $like->post_id = $request->post_id;
            $like->user_id = Auth::user()->id;
            $like->save();
        }

        //loadCountとすればリレーションの数を○○_countという形で取得できる（今回の場合はいいねの総数）
        $postLikesCount = $post->loadCount('likes')->likes_count;


        //一つの変数にajaxに渡す値をまとめる
        //今回ぐらい少ない時は別にまとめなくてもいいけど一応。笑
        $json = [
            'postLikesCount' => $postLikesCount,
        ];
        //下記の記述でajaxに引数の値を返す
        return response()->json($json);
    }

    public function category()
    {
        return view('posts.category');
    }

    public function trend($period)
    {
        // 現在の日時を取得
        $now = Carbon::now();
        // Likeモデルを取得
        $like_model = new Like;
        //$postsを定義
        $posts = null;
        //ログイン中のユーザーを取得
        $me =  User::get_me();


        $users_lanking = User::total_score('week')->sortByDesc('total');


        // 前期間
        if ($period == "all") {
            $posts = Post::withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }
        // 昨日
        elseif ($period =='day') {
            $yestaday = $now->subDay();
            $posts = Post::where('created_at', '>', $yestaday)->withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }
        // 1週間
        elseif ($period =='week') {
            $week = $now->subWeek();
            $posts = Post::where('created_at', '>', $week)->withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }
        // 1ヶ月
        elseif ($period =='month') {
            $month = $now->subMonth();
            $posts = Post::where('created_at', '>', $month)->withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }
        // 半年
        elseif ($period =='half-a-year') {
            // 指定された4半期数減らす
            $half_a_year = $now->subQuarters(2);
            $posts = Post::where('created_at', '>', $half_a_year)->withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }
        // 1年
        elseif ($period =='year') {
            $year = $now->subYear();
            $posts = Post::where('created_at', '>', $year)->withCount('likes', 'comments')->orderBy('likes_count', 'desc')->orderBy('comments_count', 'desc')->paginate(10);
        }


        return view('posts.trend', compact('posts', 'like_model', 'users_lanking', 'me'));
    }

    public function timeline()
    {
        //ログイン中のユーザーを取得(サイドバーのプロフィールで使用する)
        $me =  User::get_me();

        // ログイン中のユーザーを取得
        $user = User::withCount('posts', 'likes', 'followings')->findOrFail($me->id);
        // ユーザーのランキングを取得（サイドバーのランキングで使用する）
        $users_lanking = User::total_score('week')->sortByDesc('total');
        // いいね機能に使う
        $like_model = new Like;
        // ユーザのフォロー一覧を取得
        $followings = $user->followings;
        // 投稿を格納するコレクション
        $posts = collect([]);
        // フォロー中のユーザーの投稿を$postsに追加する
        foreach ($followings as $following) {
            $a = $following->posts()->withCount('likes', 'comments')->get();
            foreach ($a as $post) {
                // コレクションの最後に追加する
                $posts->push($post);
            }
        }
        // 降順に並び替える
        $posts = $posts->SortByDesc('created_at');

        return view('posts/timeline', compact('user', 'posts', 'me', 'users_lanking', 'like_model'));
    }
}
