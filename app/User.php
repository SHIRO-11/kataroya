<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Carbon\Carbon; //カーボンを使用する
use App\Notifications\PasswordResetNotification;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new PasswordResetNotification($token));
    }

    // ユーザーの投稿
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // ユーザーのコメント
    public function comments()
    {
        return $this->hasMany(Commnet::class);
    }

    // ユーザーがいいねしているデータ
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    //このユーザがフォロー中のユーザ。（ Userモデルとの関係を定義）
    public function followings()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'user_id', 'follow_id')->withTimestamps();
    }

    // このユーザをフォロー中のユーザ。（ Userモデルとの関係を定義）

    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_follow', 'follow_id', 'user_id')->withTimestamps();
    }

    // $userIdで指定されたユーザをフォローする。
    public function follow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist || $its_me) {
            // すでにフォローしていれば何もしない
            return false;
        } else {
            // 未フォローであればフォローする
            $this->followings()->attach($userId);
            return true;
        }
    }

    
    // $userIdで指定されたユーザをアンフォローする。
    public function unfollow($userId)
    {
        // すでにフォローしているかの確認
        $exist = $this->is_following($userId);
        // 相手が自分自身かどうかの確認
        $its_me = $this->id == $userId;

        if ($exist && !$its_me) {
            // すでにフォローしていればフォローを外す
            $this->followings()->detach($userId);
            return true;
        } else {
            // 未フォローであれば何もしない
            return false;
        }
    }

    
    // 指定された $userIdのユーザをこのユーザがフォロー中であるか調べる。フォロー中ならtrueを返す。
    public function is_following($userId)
    {
        // フォロー中ユーザの中に $userIdのものが存在するか
        return $this->followings()->where('follow_id', $userId)->exists();
    }

    // ユーザーランキングに必要なユーザーのトータルスコア
    public static function total_score($period)
    {
        // 現在の時刻を取得
        $now = Carbon::now();
        // ユーザーを取得
        $users = User::all();


        // 全期間
        if ($period == 'all') {
            foreach ($users as $user) {
                // スコアを0にリセット
                $total_score = 0;

                //投稿数
                $posts_points = $user->posts()->count();

                // フォロワー数
                $followers_points = $user->followers()->count();
                // 投稿数+フォロワー数
                $total_score += $posts_points + $followers_points;

                // 投稿についている「いいね」と「コメント」の数
                $posts = $user->posts()->withCount('likes', 'comments')->get();
                foreach ($posts as $post) {
                    $total_score += $post->likes_count;
                    $total_score += $post->comments_count;
                }
                // ユーザーインスタンスにtotalを追加
                $user['total'] = $total_score;
                // dump($user['total']);
            }
        } //1ヶ月
        elseif ($period == 'month') {
            //1ヶ月前の時刻を取得
            $month = $now->subMonth();

            // ユーザーで回す
            foreach ($users as $user) {
                // スコアを0にリセット
                $total_score = 0;

                //投稿数
                $posts_points = $user->posts->where('created_at', '>', $month)->count();
                // フォロワー数
                $followers_points = $user->followers->where('created_at', '>', $month)->count();

                // 投稿数+フォロワー数
                $total_score += $posts_points + $followers_points;
                
                // 投稿についている「いいね」と「コメント」の数
                $posts = $user->posts()->get();
                foreach ($posts as $post) {
                    // 1ヶ月以内にいいねされた数
                    $likes = $post->likes->where('created_at', '>', $month)->count();
                    // 1ヶ月以内にコメントされた数
                    $comments = $post->comments->where('created_at', '>', $month)->count();

                    // いいねとコメントを加算
                    $total_score += $likes + $comments;
                }
                // ユーザーインスタンスにtotalを追加
                $user['total'] = $total_score;
                // dump($user['total']);
            }
        } elseif ($period == 'week') {
            //1週間前の時刻を取得
            $week = $now->subWeek();

            // ユーザーで回す
            foreach ($users as $user) {
                // スコアを0にリセット
                $total_score = 0;

                //投稿数
                $posts_points = $user->posts->where('created_at', '>', $week)->count();
                // フォロワー数
                $followers_points = $user->followers->where('created_at', '>', $week)->count();

                // 投稿数+フォロワー数
                $total_score += $posts_points + $followers_points;
                
                // 投稿についている「いいね」と「コメント」の数
                $posts = $user->posts()->get();
                foreach ($posts as $post) {
                    // 1ヶ月以内にいいねされた数
                    $likes = $post->likes->where('created_at', '>', $week)->count();
                    // 1ヶ月以内にコメントされた数
                    $comments = $post->comments->where('created_at', '>', $week)->count();

                    // いいねとコメントを加算
                    $total_score += $likes + $comments;
                }
                // ユーザーインスタンスにtotalを追加
                $user['total'] = $total_score;
                // dump($user['total']);
            }
        }
        return $users;
    }

    public static function get_me()
    {
        if (Auth::check()) {
            $total_score = 0;
            //ログイン中のユーザーを取得
            $id = Auth::id();
            $me = User::withCount('likes', 'followers', 'posts')->findOrFail($id);

            //投稿数
            $posts_points = $me->posts_count;
            // フォロワー数
            $followers_points = $me->followers_count;
            // 投稿数+フォロワー数
            $total_score += $posts_points + $followers_points;

            // 投稿についている「いいね」と「コメント」の数
            $posts = $me->posts()->withCount('likes', 'comments')->get();
            foreach ($posts as $post) {
                $total_score += $post->likes_count;
                $total_score += $post->comments_count;
            }
            // ユーザーインスタンスにtotalを追加
            $me['total'] = $total_score;

            return $me;
        }
    }
}
