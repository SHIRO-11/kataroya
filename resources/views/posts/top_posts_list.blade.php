<div class="top-post-one-wrapper">
    <div class="top-post-left">
        <a href="{{route('users.show',['user'=>$post->user->id])}}"><img class="top-post-img"
                src="/storage/{{!empty($post->user->profile_image) ? 'avatar/'.$post->user->profile_image : 'images/no-image.jpg'}}"></a>

        @include('commons.profile_hover',['user'=>$post->user])

    </div>
    <div class="top-post-right">
        <p class="category" id='top-post-category'><i class="fas fa-tags"></i> {{$post->category->category_name}}</p>
        <p class="top-post-date"><i class="fas fa-calendar-alt"></i> {{$post->created_at}}</p>
        <h2 id="top-post-title"><a href="{{route('posts.show',['post'=>$post->id])}}">{{$post->title}}</a>
        </h2>
        <p id="top-post-content">{{($post->textLimit($post->content))}}</p>
        {{--  ログイン中のときのいいねマーク  --}}
        @auth
        @if($like_model->like_exist(Auth::user()->id,$post->id))
        <p class="favorite-marke"><a class="js-like-toggle loved" href="" data-postid="{{ $post->id }}"><i
                    class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
        @else
        <p class="favorite-marke"><a class="js-like-toggle" href="" data-postid="{{ $post->id }}"><i
                    class="fas fa-heart"></i></a> <span class="likesCount">{{$post->likes_count}}</span></p>
        @endif
        @endauth
        {{--  ゲストユーザーのときのいいねマーク  --}}
        @guest
        <p class="favorite-marke"><a class="js-modal-open-heart" href=""><i class="fas fa-heart"></i></a>
            <span class="likesCount">{{$post->likes_count}}</span></p>
        <div class="modal js-modal-heart">
            <div class="modal__bg__heart js-modal-close-heart"></div>
            <div class="modal__content">
                    @include('layouts.modal_login',['content'=>'いいねする'])
                <a class="js-modal-close-heart" href="">閉じる</a>
            </div>
        </div>
        @endguest
        <p class="reply-marke"><i class="fas fa-comments"></i> {{$post->comments_count}}</p>
    </div>
</div>