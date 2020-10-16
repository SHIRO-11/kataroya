@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="show-post-wrapper">
            <div id="show-main-post-wrapper">
                <p class="category" id='show-post-category'><i class="fas fa-tags"></i> {{$post->category->category_name}}</p>
                <h2 id="show-post-title">{{$post->title}}</h2>
                <p id="show-post-content">{!! nl2br(e($post->content)) !!}</p>
                @if ($post->image)
                    <img class="post-image" src="/storage/posts/{{$post->image}}">
                @endif
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
                <p class="reply-marke"><i class="fas fa-comments"></i> {{$post->comments_count}}</p>
                <p id='show-post-user'><a href="{{route('users.show',['user'=>$post->user->id])}}"><img id="show-post-img" src="/storage/{{!empty($post->user->profile_image) ? 'avatar/'.$post->user->profile_image : 'images/no-image.jpg'}}"> {{$post->user->name}}</a>
                    さんの投稿</p>
                <p id="show-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
            </div>

            @foreach ($comments as $comment)
            <div id="comment-wrapper">
                <p id="comment-name"><span id="loop-index">【{{$loop->index}}】 {{$comment->name}}</span> <span>さんのコメント</span></p>
                <p id="comment-date"><i class="fas fa-calendar-alt"></i> {{$comment->created_at}}</p>
                <p id='comment-comment'>{!! nl2br(e($comment->comment)) !!}</p>
                @if ($comment->image)
                <img class="post-image" src="/storage/comments/{{$comment->image}}">
                @endif
                <p><a class="reply" data-index="{{ $loop->index }}" href="">返信する</a></p>
            </div>
            @endforeach
        </div>
    </div>
</div>

<div class="content">
    <a class="js-modal-open-comment" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="row">
            <div class="col-sm-12">
                <p class="comment-form">コメント</p>
                {!! Form::open(['route' => 'comments.store','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name',old('name','名無し'), ['class' => 'form-control']) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('comment_image','画像を添付する場合') !!}
                    <img src="" id="preview_comment_image">
                    {!! Form::file('comment_image') !!}
                </div>
        
                <div class="form-group">
                    {!! Form::label('comment', 'コメント') !!}
                    {!! Form::textarea('comment', old('content'), ['class' => 'form-control','rows'=>"8"]) !!}
                </div>
                {{Form::hidden('post_id', $post->id)}}
                {!! Form::submit('コメントする', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a class="js-modal-close-comment" href="">閉じる</a>
    </div>
</div>
@endsection 