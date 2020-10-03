<div class="col-sm-12 col-md-4" id="profile-wrapper">
    <div id='profile'>
        <div id="profile-img"><img src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}" width="100px" height="100px"></div>
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
        <div id="profile-counts">
            @if(\Route::is('users.show'))
            <a href="{{route('users.show',['user'=>$user->id])}}" class="profile-active" id="profile-posts">
                @else
                <a href="{{route('users.show',['user'=>$user->id])}}" id="profile-posts">
                    @endif

                    <p id="profile-posts-count">{{$user->posts_count}}</p>
                    <p id="profile-posts-name">投稿</p>
                </a>
                @if(\Route::is('users.likeslist'))
                <a href="{{route('users.likeslist',['user'=>$user->id])}}" class="profile-active" id="profile-likes">
                    @else
                    <a href="{{route('users.likeslist',['user'=>$user->id])}}" id="profile-likes">
                        @endif
                        <p id="profile-likes-count">{{$user->likes_count}}</p>
                        <p id="profile-likes-name">いいね</p>
                    </a>
                    @if(\Route::is('users.followings'))
                    <a href="{{route('users.followings',['user'=>$user->id])}}" class="profile-active" id="profile-followers">
                        @else
                        <a href="{{route('users.followings',['user'=>$user->id])}}" id="profile-followers">
                        @endif
                        <p id="profile-followers-count">{{$user->followings_count}}</p>
                        <p id="profile-followers-name">フォロー</p>
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