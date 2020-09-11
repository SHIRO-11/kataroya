@extends('layouts.app')

@section('content')
@foreach ($posts as $post)
<div class="row">
    <div class="col-md-8">
        <div class="top-post-wrapper">
            <p class="ribbon5" id='top-post-category'>{{$post->category}}</p>
            <h2 id="top-post-title"><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a></h2>
            <p id="top-post-content">{{($post->textLimit($post->content))}}</p>
            <p class="favorite-marke"><i class="fas fa-heart"></i></p>
            <p class="reply-marke"><i class="fas fa-comments"></i></p>
            <p id='top-post-user'><a href="{{route('users.show',['user'=>$post->user->id])}}">{{$post->user->name}}</a> さんの投稿</p>
            <p id="top-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
        </div>
    </div>
</div>
@endforeach
{{ $posts->links() }}

<div class="row">
    <div class="col-sm-6 offset-sm-3">

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

        {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection