@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.profile',['user'=>$user])

    <div class="col-sm-12 col-md-7 show-contents-wrapper">
        <h2><i class="fas fa-clipboard-list"></i> フォロー中のユーザー一覧</h2>
        @foreach ($followings as $user)
        <div class="user-index-one-wrapper">
            <div class="user-index-left">
                <a href="{{route('users.show',['user'=>$user->id])}}"><img class="top-post-img"
                        src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}"></a>
                @include('commons.profile_hover')
    
            </div>
            <div class="user-index-right">
                <h2 class="user-name"><a href="{{route('users.show',['user'=>$user->id])}}">{{$user->name}}</a>
                </h2>
                <p class="user-introduction">{{$user->introduction}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection