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
        <div class="row">
            <div class="col-sm-12">
                「投稿」するためにはログインする必要があります。
                @include('layouts.login')
            </div>
        </div>
        <a class="js-modal-close" href="">閉じる</a>
    </div>
</div>
@endguest