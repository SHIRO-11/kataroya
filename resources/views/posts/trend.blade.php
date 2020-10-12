@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 top-post-wrapper">
            <p class="title"><i class="fas fa-chart-line"></i> トレンド <span>投稿が人気順に表示されます。</span></p>
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
        @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection