@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @if ($user!=NULL)
            <a  href="{{ url('/posts/create') }}">Ajouter Post</a>
        @endif
        @foreach($posts as $post)
        @php
        $date=$post->created_at;
        @endphp
        <br>     
        <div class="card">

            <a href="/posts/{{$post->idpost}}"><div class="card-header"><h3>{{$post->title}}</h3></div></a>
            <div class="card-body">@php  echo ($post->content) @endphp <br></div>
            <div class="card-footer">
                <div class="float-left">Par {{$post->name}} le {{$date}}</div>
                @if ($user!=NULL)
                @if ($user->id == $post->author)
                    <div class="float-right">
                        <a href="/posts/{{$post->idpost}}/edit"><button class="btn btn-secondary">Modifier</button></a>
                        <a href="/posts/destroy/{{$post->idpost}}"><button class="btn btn-danger">Supprimer</button></a>
                    </div> 
                @endif
                @endif
            </div>
            </div>
        @endforeach
        
    </div>
</div>
@endsection