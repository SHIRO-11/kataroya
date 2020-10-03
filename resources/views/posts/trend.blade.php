@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 top-post-wrapper">
            <ul class="nav nav-tabs nav-justified mb-3">

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'all'])}}"
                        class="nav-link {{ Request::is('posts/trend/all') ? 'active' : '' }}">全期間</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'day'])}}"
                        class="nav-link {{ Request::is('posts/trend/day') ? 'active' : '' }}">1日</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'week'])}}"
                        class="nav-link {{ Request::is('posts/trend/week') ? 'active' : '' }}">1週間</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'month'])}}"
                        class="nav-link {{ Request::is('posts/trend/month') ? 'active' : '' }}">1ヶ月</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'half-a-year'])}}"
                        class="nav-link {{ Request::is('posts/trend/half-a-year') ? 'active' : '' }}">半年</a>
                </li>

                <li class="nav-item">
                    <a href="{{route('posts.trend',['period'=>'year'])}}"
                        class="nav-link {{ Request::is('posts/trend/year') ? 'active' : '' }}">1年</a>
                </li>
            </ul>
            @foreach ($posts as $post)
            @include('posts.top_posts_list')

            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>

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