<div class="col-md-12 col-lg-2 side-bar-left">
    <a href="{{route('posts.index')}}" class="{{ Request::routeIs('posts.index') ? 'side-active' : '' }}"><i
            class="fas fa-plus-circle"></i> 新着</a>
    <a href="{{route('posts.trend',['period'=>'all'])}}"
        class="{{ Request::is('posts/trend/*') ? 'side-active' : '' }}"><i class="fas fa-chart-line"></i> トレンド</a>
    <a href="{{route('categories.index')}}" class="{{ Request::routeIs('categories.index') || Request::routeIs('categories.show') ? 'side-active' : ''}}"><i class="fas fa-th-list"></i> カテゴリー</a>
    <a href="{{route('users.index')}}" class="{{ Request::routeIs('users.index') ? 'side-active' : ''}}"><i
            class="fas fa-users"></i> ユーザー</a>
    @auth
    <a href="{{route('posts.timeline')}}" class="{{ Request::routeIs('posts.timeline') ? 'side-active' : ''}}"><i
            class="far fa-clock"></i> タイムライン</a>
    @endauth
    @guest
    <a class="js-modal-open-commons" href=""><i class="far fa-clock"></i> タイムライン</a>
    @endguest

</div>