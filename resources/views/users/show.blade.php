@extends('layouts.app')

@section('content')
<div class="row">
    @include('layouts.profile',['user'=>$user])

    <div class='col-md-8'>

    </div>
</div>

@endsection