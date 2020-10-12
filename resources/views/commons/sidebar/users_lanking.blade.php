<div class="user-lanking-wrapper">
    <h4><i class="fas fa-trophy"></i> ユーザーランキング</h4>
    <ul class="nav nav-tabs nav-justified">

        <li class="nav-item">
            <a href="" class="nav-link active lanking-period" data-period="week">今週</a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link lanking-period" data-period="month">今月</a>
        </li>

        <li class="nav-item">
            <a href="" class="nav-link lanking-period" data-period="all">総合</a>
        </li>
    </ul>
    @foreach ($users_lanking as $user)
    <div class="user-lanking-one-wrapper">
        <div class="lanking-left">
            {{$loop->iteration}}
            <a href="{{route('users.show',['user'=>$user->id])}}">
                <img class="top-post-img"
                    src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}">
                @include('commons.profile_hover')
            </a>
            <a href="{{route('users.show',['user'=>$user->id])}}" class="user-lanking-name">{{$user->name}}</a>
        </div>
        <div class="lanking-right">
            <p class="lanking-score-count">{{$user->total}}</p><p class="score">score</p>
        </div>

    </div>
    @endforeach
</div>