@guest
@if (Request::routeIs('posts.index'))
<div class="guest-head">
    <div class="guest-head-contents">
        <h2 class="guest-head-title">誰でも手軽に参加可能な掲示板アプリで語ろう</h2>
        <p class="guest-head-content">「カタローヤ」は誰でも簡単にコメントできる掲示板アプリです。<br>登録不要で簡単に様々な掲示板にコメントすることができるので暇つぶしにはもってこい。<br>自分の好みに合った掲示板を探して語りまくりましょう。
        </p>
    </div>
    <div class="guest-head-login">
        <div class="row">
            <div class="col-sm-12">

                {!! Form::open(['route' => 'register']) !!}
                <div class="form-group">
                    {!! Form::label('name', '名前') !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('email', 'メールアドレス') !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password', 'パスワード') !!}
                    {!! Form::password('password', ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('password_confirmation', 'もう一度入力') !!}
                    {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                </div>

                {!! Form::submit('登録する', ['class' => 'btn btn-outline-light btn-block']) !!}
                {!! Form::close() !!}
            </div>
            <div class="already-register">
                <p>登録済みの方は「<a href="{{route('login')}}">こちら</a>」</p>
            </div>
        </div>
    </div>
</div>
@endif
@endguest