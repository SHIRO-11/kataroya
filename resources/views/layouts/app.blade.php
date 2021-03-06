<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>カタローヤ｜のんびり掲示板でお話ししよう</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css"
        integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    @include('layouts.navbar')
    @include('layouts.guest_head')
    <div class="container">
        {{-- エラーメッセージ --}}
        @include('layouts.error')
        @yield('content')

        <div class="modal js-modal-commons">
            <div class="modal__bg js-modal-close-commons"></div>
            <div class="modal__content">
                @include('layouts.modal_login',['content'=>'タイムラインを見る'])
                <a class="js-modal-close-commons" href="">閉じる</a>
            </div>
        </div>
    </div>
</body>
</html>
