@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 user-index-wrapper">
            <p class="title"><i class="fas fa-chart-line"></i> ユーザー <span>ユーザーの一覧が表示されます。</span></p>
            @foreach ($users as $user)
            <div class="user-index-one-wrapper">
                <div class="user-index-left">
                    <a href="{{route('users.show',['user'=>$user->id])}}"><img class="top-post-img"
                            src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}"></a>
                    <div class="top-profile-hover">
                        <a href="{{route('users.show',['user'=>$user->id])}}"><img class="top-post-img"
                                src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}"></a>
                        <p class='top-post-user'><a href="{{route('users.show',['user'=>$user->id])}}">
                                {{$user->name}}</a>
                        </p>
                        <p class="top-post-user-introduction">{{$user->introduction}}</p>
                    </div>

                </div>
                <div class="user-index-right">
                    <h2 class="user-name"><a href="{{route('users.show',['user'=>$user->id])}}">{{$user->name}}</a>
                    </h2>
                    <p class="user-introduction">{{$user->introduction}}</p>
                </div>
            </div>
            @endforeach
        </div>
        @include('layouts.sidebar_right')
    </div>
</div>

@include('layouts.modal_post')
@endsection