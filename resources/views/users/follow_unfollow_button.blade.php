@if (Auth::id() != $user->id)
<div class="follow-unfollow-btn">
    @auth
    @if (Auth::user()->is_following($user->id))
    {{-- アンフォローボタンのフォーム --}}
    <a href="" data-id="{{$user->id}}" class="btn-sm btn-danger btn-block unfollow-btn">アンフォロー</a>
    @else
    {{-- フォローボタンのフォーム --}}
    <a href="" data-id="{{$user->id}}" class="btn-sm btn-primary btn-block follow-btn">フォロー</a>
    @endif
    @endauth
</div>
@endif