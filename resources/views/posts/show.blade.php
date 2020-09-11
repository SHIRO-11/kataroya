@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="top-post-wrapper">
            <p class="ribbon5" id='top-post-category'>{{$post->category}}</p>
            <h2 id="top-post-title"><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h2>
            <p id="top-post-content">{!! nl2br(e($post->content)) !!}</p>
            <p class="favorite-marke"><i class="fas fa-heart"></i></p>
            <p class="reply-marke"><i class="fas fa-comments"></i></p>
            <p id='top-post-user'><a href="{{route('users.show',['user'=>$post->user->id])}}">{{$post->user->name}}</a>
                さんの投稿</p>
            <p id="top-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
        </div>
    </div>
</div>
@endsection