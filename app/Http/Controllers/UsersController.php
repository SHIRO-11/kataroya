<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function show($id)
    {
        $user = User::withCount('posts', 'likes')->findOrFail($id);

        return view('users.show', compact('user'));
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
        ]);


        $user = $request->user();


        $user->name=$request->name;
        $user->introduction=$request->introduction;
        $user->blog_url=$request->blog_url;
        $user->twitter_url=$request->twitter_url;
        $user->instagram_url=$request->instagram_url;
        $user->youtube_url=$request->youtube_url;

        $user->save();

        return redirect(route('users.show', [
            'user' => $user->id,
        ]));
    }
}
