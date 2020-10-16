@extends('layouts.app')

@section('content')
<div class="main-wrapper">
    <div class="row">
        @include('layouts.sidebar_left')

        <div class='col-md-12 col-lg-7 top-post-wrapper'>
            <p class="title"><i class="fas fa-th-list"></i> カテゴリー一覧 <span>興味のあるカテゴリーを選択して下さい。</span></p>
            {{--  カテゴリーを回してカテゴリー名を表示する  --}}
            @foreach ($categories as $category)
            <p class="category-link"><a href="{{route('categories.show',['category'=>$category->category_name])}}">{{$category->category_name}}</a>
            {{--  カテゴリーの数を回す  --}}
            @foreach ($categories_count as $category_count) 
            {{--  名前が一致したら表示するようにする  --}}
                @if ($category->category_name == $category_count->category_name)
                ({{$category_count->categories_count}})
                @endif
            @endforeach</p>
            @endforeach
        </div>
        @include('layouts.sidebar_right')
    </div>
</div>
{{-- モーダル --}}
@include('layouts.modal_post')
@endsection