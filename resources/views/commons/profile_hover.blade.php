<div class="profile-hover">
    <div class="profile-hover-img-name">
        <a href="{{route('users.show',['user'=>$user->id])}}"><img class="hover-profile-img"
                src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}"></a>
        <p class='hover-profile-user'><a href="{{route('users.show',['user'=>$user->id])}}">
                {{$user->name}}</a>
        </p>
        @include('users.follow_unfollow_button')
    </div>
    <p class="hover-profile-user-introduction">{{$user->introduction}}</p>
    <div class="profile-hover-info-items">
        <div class="profile-hover-info-item"><a href="{{route('users.show',['user'=>$user->id])}}">
                <div class="posts-counts">{{count($user->posts)}}</div>
            </a><span>投稿</span></div>
        <div class="profile-hover-info-item"><a href="{{route('users.followers',['user'=>$user->id])}}">{{count($user->followers)}}</a><span>フォロワー</span></div>
    </div>
</div>