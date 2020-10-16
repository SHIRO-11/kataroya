<?php

namespace App\Http\Controllers;

use App\Post;
use App\Like;
use App\User;
use App\Category;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        // プロフィールで使用
        $me =  User::get_me();
        // ランキングで使用
        $users_lanking = User::total_score('week')->sortByDesc('total')->take(10);
        // いいねで使用
        $like_model = new Like;
        // カテゴリーを重複せずに取得
        $categories = Category::groupBy('category_name')->get('category_name');

        // カテゴリーをグループで集計して数を調べる
        $categories_count = DB::table('categories')
        ->select(DB::raw('count(*) as categories_count,category_name'))
        ->groupBy('category_name')
        ->get();

        return view('categories.index', compact('me', 'users_lanking', 'like_model', 'categories', 'categories_count'));
    }

    public function show($category)
    {
        // プロフィールで使用
        $me =  User::get_me();
        // ランキングで使用
        $users_lanking = User::total_score('week')->sortByDesc('total')->take(10);
        // いいねで使用
        $like_model = new Like;

        // $posts = Category::where('category_name', '=', $category)->orderBy('created_at', 'desc')->paginate(10);
        $posts = Post::whereHas('category', function ($query) use ($category) {
            $query->where('category_name', '=', $category);
        })->withCount('likes', 'comments')->orderBy('created_at', 'desc')->paginate(10);

        return view('categories.show', compact('me', 'users_lanking', 'like_model', 'posts', 'category'));
    }
}
