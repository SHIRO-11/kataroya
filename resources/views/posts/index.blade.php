@extends('layouts.app')

@section('content')
@foreach ($posts as $post)
<div class="row">
    <div class="col-md-9">
        <div class="top-post-wrapper">
            <p class="ribbon5" id='top-post-category'>{{$post->category}}</p>
            <h2 id="top-post-title"><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h2>
            <p id="top-post-content">{{($post->textLimit($post->content))}}</p>
            @auth
            @if($like_model->like_exist(Auth::user()->id,$post->id))
            <p class="favorite-marke"><a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i
                        class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
            @else
            <p class="favorite-marke"><a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i
                        class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
            @endif
            @endauth
            {{--  ゲストユーザーのときのいいねマーク  --}}
            @guest
            <p class="favorite-marke"><a class="js-modal-open-heart" href=""><i class="fas fa-heart"></i></a> <span
                    class="likesCount">{{$post->likes_count}}</span></p>
            <div class="modal js-modal-heart">
                <div class="modal__bg__heart js-modal-close-heart"></div>
                <div class="modal__content">
                    <div class="row">
                        <div class="col-sm-12">
                            「いいね」するためにはログインする必要があります。
                            @include('layouts.login')
                        </div>
                    </div>
                    <a class="js-modal-close-heart" href="">閉じる</a>
                </div>
            </div>
            @endguest
            <p class="reply-marke"><i class="fas fa-comments"></i> {{$post->comments_count}}</p>
            <p id='top-post-user'><a href="{{route('users.show',['user'=>$post->user->id])}}">{{$post->user->name}}</a>
                さんの投稿</p>
            <p id="top-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
        </div>
    </div>
</div>
@endforeach
{{ $posts->links() }}

@auth

<div class="modal-content">
    <a class="js-modal-open-post" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="row">
            <div class="col-sm-12">
                <p class="comment-form">投稿</p>
                {!! Form::open(['route' => 'posts.store']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {{ Form::select('category', Config::get('array.category'),'',['placeholder' => 'カテゴリー選択']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', '本文') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endauth
@guest
<div class="modal-content">
    <a class="js-modal-open-post" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="row">
            <div class="col-sm-12">
                「投稿」するためにはログインする必要があります。
                @include('layouts.login')
            </div>
        </div>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endguest
@endsection