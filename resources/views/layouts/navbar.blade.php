@auth
<header class="mb-4">
    <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color:#2ea6ff;">
        @endauth
        @guest
        @if (Request::routeIs('posts.index'))
        <header>
            <nav class="navbar navbar-expand-md navbar-dark" style="background-color:#2ea6ff;">
                @else
                <header class="mb-4">
                    <nav class="navbar navbar-expand-md navbar-dark shadow-sm" style="background-color:#2ea6ff;">
                        @endif
                        @endguest
                        {{-- トップページへのリンク --}}
                        <h1><a class="navbar-brand" href="/">カタローヤ</a></h1>

                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="nav-bar">
                            <ul class="navbar-nav mr-auto"></ul>
                            <ul class="navbar-nav">
                                @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}"><i class="fas fa-sign-in-alt"></i>
                                        {{ __('ログイン') }}</a>
                                </li>
                                @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}"><i class="fas fa-user-plus"></i>
                                        {{ __('新規登録') }}</a>
                                </li>
                                @endif
                                @else
                                <li class="nav-item dropdown">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('users.show',Auth::user()->id) }}"><i
                                            class="fas fa-user"></i> マイページ</a>
                                </li>
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                    document.getElementById('logout-form').submit();">
                                        {{ __('ログアウト') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                                </li>
                                @endguest
                            </ul>
                        </div>
                    </nav>
                </header>