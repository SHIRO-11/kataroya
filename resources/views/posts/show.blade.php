@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="show-post-wrapper">
            <div id="show-main-post-wrapper">
                <p class="category" id='show-post-category'><i class="fas fa-tags"></i> {{$post->category}}</p>
                <h2 id="show-post-title">{{$post->title}}</h2>
                <p id="show-post-content">{!! nl2br(e($post->content)) !!}</p>
                @auth
                    @if($like_model->like_exist(Auth::user()->id,$post->id))
                    <p class="favorite-marke"><a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
                    @else
                    <p class="favorite-marke"><a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
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
                <p class="reply-marke"><i class="fas fa-comments"></i></p>
                <p id='show-post-user'><a href="{{route('users.show',['user'=>$post->user->id])}}"><img id="show-post-img" src="/storage/avatar/{{$post->user->profile_image}}"> {{$post->user->name}}</a>
                    さんの投稿</p>
                <p id="show-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
            </div>

            @foreach ($comments as $comment)
            <div id="comment-wrapper">
                <p id="comment-name"><span>【{{$loop->index}}】</span> {{$comment->name}} <span>さんのコメント</span></p>
                <p id='comment-comment'>{!! nl2br(e($comment->comment)) !!}</p>
                <p id="comment-date"><i class="fas fa-calendar-alt"></i> {{$comment->created_at}}</p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="content">
    <a class="js-modal-open" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="row">
            <div class="col-sm-12">
                <p class="comment-form">コメント</p>
                {!! Form::open(['route' => 'comments.store']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>
        
                <div class="form-group">
                    {!! Form::label('comment', 'コメント') !!}
                    {!! Form::textarea('comment', old('content'), ['class' => 'form-control']) !!}
                </div>
                {{Form::hidden('post_id', $post->id)}}
                {!! Form::submit('コメントする', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endsection 