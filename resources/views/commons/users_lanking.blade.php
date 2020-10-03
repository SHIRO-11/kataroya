<div class="user-lanking-wrapper">
    <h4>ユーザーランキング</h4>
    <ul class="nav nav-tabs nav-justified mb-3">

        <li class="nav-item">
            <a href="" class="nav-link active lanking-period" data-period="week">今週</a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link lanking-period" data-period="month">今月</a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link lanking-period" data-period="all">全期間</a>
        </li>
    </ul>
    @foreach ($users_lanking as $user)
    <div class="user-lanking-oner-wrapper">
        <p><a href="{{route('users.show',['user'=>$user->id])}}"><img class="top-post-img"
                    src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}">
        </p>
        <p class="user-lanking-name">{{$user->name}}</p>

    </div>
    @endforeach 
</div>