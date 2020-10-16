@auth

<div class="modal-content">
    <a class="js-modal-open-post" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
        <div class="row">
            <div class="col-sm-12">
                <p class="comment-form">投稿</p>
                {!! Form::open(['route' => 'posts.store','enctype'=>'multipart/form-data']) !!}
                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {{ Form::select('category', Config::get('array.category'),'',['placeholder' => 'カテゴリー選択']) }}
                </div>

                <div class="form-group">
                    {!! Form::label('content', '本文') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control','rows'=>"8"]) !!}
                </div>

                <div class='form-group'>
                    {!! Form::label('post_image','画像を添付する場合') !!}
                    <img src="" id="preview_post_image">
                    {!! Form::file('post_image') !!}
                </div>

                {!! Form::submit('投稿する', ['class' => 'btn btn-primary btn-block']) !!}
                {!! Form::close() !!}
            </div>
        </div>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endauth
@guest
<div class="modal-content">
    <a class="js-modal-open-post" href=""><i class="fas fa-plus"></i></a>
</div>
<div class="modal js-modal">
    <div class="modal__bg js-modal-close"></div>
    <div class="modal__content">
            @include('layouts.modal_login',['content'=>'投稿'])
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endguest