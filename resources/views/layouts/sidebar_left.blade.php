<div class="col-md-12 col-lg-2 side-bar-left">
    <a href="{{route('posts.index')}}" class="{{ Request::routeIs('posts.index') ? 'side-active' : '' }}"><i class="fas fa-plus-circle"></i> 新着</a>
    <a href="{{route('posts.trend',['period'=>'all'])}}" class="{{ Request::is('posts/trend/*') ? 'side-active' : '' }}"><i
            class="fas fa-chart-line"></i> トレンド</a>
    <a href="#">カテゴリー</a>
    <a href="{{route('users.index')}}" class="{{ Request::routeIs('users.index') ? 'side-active' : ''}}"><i class="fas fa-users"></i> ユーザー</a>
</div>