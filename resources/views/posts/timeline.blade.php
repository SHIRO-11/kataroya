@extends('layouts.app')

@section('content')
<div class="main-wrapper">
<div class="row">
    @include('layouts.sidebar_left')

    <div class='col-md-12 col-lg-7 top-post-wrapper'>
        <p class="title"><i class="fas fa-clipboard-list"></i> タイムライン <span>フォローしているユーザーの投稿一覧</span></p>
        @foreach ($posts as $post)
        @include('posts.top_posts_list')
        @endforeach
    </div>
    @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection