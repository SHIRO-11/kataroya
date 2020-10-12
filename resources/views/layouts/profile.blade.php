<div class="col-sm-12 col-md-4" id="profile-wrapper">
    <div id='profile'>
        <div id="profile-img"><img
                src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}"
                width="100px" height="100px"></div>
        <div id="profile-name">
            <h3>{{$user->name}}</h3>
        </div>
        <div id="profile-sns">
            @if(!empty($user->twitter_url))
            <div id="twitter"><a href="{{$user->twitter_url}}"><i class="fab fa-twitter-square"></i></a></div>
            @endif
            @if(!empty($user->instagram_url))
            <div id="instagram"><a href="{{$user->instagram_url}}"><i class="fab fa-instagram-square"></i></a></div>
            @endif
            @if(!empty($user->youtube_url))
            <div id="youtube"><a href="{{$user->youtube_url}}"><i class="fab fa-youtube-square"></i></a></div>
            @endif
        </div>
        <div id="profile-introduction">{{$user->introduction}}</div>
        <div id="profile-counts-items">
            <a href="{{route('users.show',['user'=>$user->id])}}"
                class="profile-counts-item {{\Route::is('users.show') ? 'profile-active' :''}}" id="profile-posts">

                <p class="profile-number-item">{{$user->posts_count}}</p>
                <p class="profile-name-item">投稿</p>
            </a>
            <a href="{{route('users.likeslist',['user'=>$user->id])}}"
                class="profile-counts-item {{\Route::is('users.likeslist') ? 'profile-active' :''}}" id="profile-likes">
                <p class="profile-number-item">{{$user->likes_count}}</p>
                <p class="profile-name-item">いいね</p>
            </a>

            <a href="{{route('users.followings',['user'=>$user->id])}}"
                class="profile-counts-item {{\Route::is('users.followings') ? 'profile-active' :''}}"
                id="profile-followers">
                <p class="profile-number-item">{{$user->followings_count}}</p>
                <p class="profile-name-item">フォロー</p>
            </a>

            <a href="{{route('users.followers',['user'=>$user->id])}}"
                class="profile-counts-item {{\Route::is('users.followers') ? 'profile-active' :''}}" id="profile-followers">
                <p class="profile-number-item">{{$user->followers_count}}</p>
                <p class="profile-name-item">フォロワー
                </p>
            </a>

        </div>
        <div id="profile-site">
            <p>
                @if(!empty($user->blog_url))
                <i class="fas fa-globe-asia"></i>
                @endif
                <a href="{{$user->blog_url}}">{{$user->blog_url}}</a></p>
        </div>

        @auth
        @if(Auth::user()->id == $user->id)
        <div id="profile-edit">
            {!! link_to_route('users.edit', 'プロフィールを編集する', ['user'=>$user->id],['class'=>'btn btn-secondary btn-block'])
            !!}
        </div>
        @else
        @include('users.follow_unfollow_button')
        <div id="profile-follow"></div>
        @endif
        @endauth
    </div>
</div>