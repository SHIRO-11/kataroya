@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-sm-6 offset-sm-3">

        {!! Form::open(['route' => 'posts.store']) !!}
        <div class="form-group">
            {!! Form::label('title', 'タイトル') !!}
            {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {{ Form::select('category', Config::get('array.category'),'',['placeholder' => 'カテゴリー選択']) }}
        </div>

        <div class="form-group">
            {!! Form::label('content', '本文') !!}
            {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('Sign up', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection