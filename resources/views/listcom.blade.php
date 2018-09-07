@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        
        @foreach($comments as $comment)
        @php
        $date=$comment['created_at'];
        @endphp
        <br>     
        <div class="card">
            <div class="card-body">{{$comment['content']}}</div>
            <div class="card-footer">Par {{$comment['author']}} le {{$date}} </div>
            </div>
        @endforeach
    </div>
</div>
@endsection