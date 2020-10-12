@auth
    <div class="side-profile">
        <div class="side-profile-img"><a href="{{route('users.show',['user'=>$me->id])}}"><img class="top-post-img"
                src="/storage/{{!empty($me->profile_image) ? 'avatar/'.$me->profile_image : 'images/no-image.jpg'}}"></a></div>
        <div class="side-profile-status">
            <div class="side-profile-item posts-itemu"><a href="{{route('users.show',['user'=>$me->id])}}"><div class="posts-counts">{{$me->posts_count}}</div></a><span>投稿</span></div>
            <div class="side-profile-item followers-item"><a href="{{route('users.followers',['user'=>$me->id])}}">{{$me->followers_count}}</a><span>フォロワー</span></div>
            <div class="side-profile-item score-item">{{$me->total}}<span>スコア</span></div>
        </div>
    </div>
@endauth