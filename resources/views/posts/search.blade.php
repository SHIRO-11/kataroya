@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')
        <div class="col-md-12 col-lg-7 top-post-wrapper">
            <p class="title"><i class="fas fa-search-plus"></i> 「{{$keyword}}」 <span>キーワードにヒットした投稿が表示されます。</span></p>
            @if ($data->isEmpty())
            検索結果にヒットした投稿はありませんでした。
            @else
             {{$data->total()}}件ヒットしました。
            @endif
            @foreach ($data as $post)
            @include('posts.top_posts_list')

            @endforeach
            {{ $data->appends(request()->input())->links() }}
        </div>
        @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection