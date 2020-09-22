<div class="col-md-4" id='profile'>
    <div id="profile-img"></div>
    <div id="profile-name">{{$user->name}}</div>
    <div id="profile-site"><i class="fas fa-globe-asia"></i> <a href="{{$user->blog_url}}">{{$user->blog_url}}</a></div>
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
        <a href="{{route('posts.index')}}" id="profile-posts">
            <p id="profile-posts-count">{{$user->posts_count}}</p>
            <p id="profile-posts-name">投稿</p>
        </a>
        <a href="{{route('posts.index')}}" id="profile-likes">
            <p id="profile-likes-count">{{$user->likes_count}}</p>
            <p id="profile-likes-name">いいね</p>
        </a>
        <a href="{{route('posts.index')}}" id="profile-followers">
            <p id="profile-followers-count">{{$user->likes_count}}</p>
            <p id="profile-followers-name">フォロワー</p>
        </a>
    </div>

    @auth
        @if(Auth::user()->id == $user->id)
            <div id="profile-edit">
                {!! link_to_route('users.edit', 'プロフィールを編集する', ['user'=>$user->id],['class'=>'btn btn-secondary btn-block']) !!}
            </div>
            @else
            <div id="profile-follow"></div>
            @endif
    @endauth
</div>