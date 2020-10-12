@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 top-post-wrapper">
            <p class="title"><i class="fas fa-plus-circle"></i> 新着 <span>投稿が新着順に表示されます。</span></p>
            @foreach ($posts as $post)
            @include('posts.top_posts_list')

            @endforeach
            {{ $posts->links() }}
        </div>
        @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection