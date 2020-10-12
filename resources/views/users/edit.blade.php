@extends('layouts.app')
@section('content')

<div class="row">

    <div class="col-md-8 profile-edit">
        {!! Form::model($user, ['route' => ['users.update',$user->id],'method' => 'put','enctype'=>'multipart/form-data']) !!}

        <div class="form-group">
            {!! Form::label('name','名前') !!}
            {!! Form::text('name', old('name'),['class' => 'form-control']) !!}
        </div>

        <div class='form-group'>
            {!! Form::label('profile_image','プロフィール写真') !!}
            <img src="/storage/{{!empty($user->profile_image) ? 'avatar/'.$user->profile_image : 'images/no-image.jpg'}}" id="preview_profile_image">
            {!! Form::file('profile_image') !!}
        </div>

        <div class="form-group">
            {!! Form::label('introduction','自己紹介') !!}
            {!! Form::textarea('introduction', old('introduction'),['class' => 'form-control','rows'=>'5']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('blog_url','WebサイトのURL') !!}
            {!! Form::text('blog_url', old('blog_url'),['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('twitter_url','TwitterのURL') !!}
            {!! Form::text('twitter_url', old('twitter_url'),['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('instagram_url','InstagramのURL') !!}
            {!! Form::text('instagram_url', old('instagram_url'),['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('youtube_url','YoutubeのURL') !!}
            {!! Form::text('youtube_url', old('youtube_url'),['class' => 'form-control']) !!}
        </div>

        {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block']) !!}
        {!! Form::close() !!}
    </div>
</div>
@endsection