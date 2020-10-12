@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.profile',['user'=>$user])

    <div class='col-sm-12 col-md-7 show-contents-wrapper'>
        <h2><i class="fas fa-clipboard-list"></i> 投稿一覧</h2>
        @foreach ($posts as $post)
        <div class="show-posts-substance">
            <p class="category show-user-post-category"><i class="fas fa-tags"></i> {{$post->category}}</p>
            <h2 class="show-post-title"><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h2>
            <p class="show-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
        </div>
        @endforeach
    </div>
</div>

@endsection