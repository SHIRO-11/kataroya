<p>{{$content}}ためにはログインする必要があります。</p>
<div class="row">
    <div class="col-sm-12">

        {!! Form::open(['route' => 'login']) !!}
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('ログイン', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}

        {{-- ユーザ登録ページへのリンク --}}
        <p>未登録の方は「<a href="{{route('register')}}">こちら</a>」</p>
    </div>
</div>