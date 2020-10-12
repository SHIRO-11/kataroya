@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 user-index-wrapper">
            <p class="title"><i class="fas fa-users"></i> ユーザー <span>ユーザーの一覧が表示されます。</span></p>
            @foreach ($users as $user)
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

                    @include('users.follow_unfollow_button')
            </div>
            @endforeach
            {{ $users->links() }}
        </div>
        @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection