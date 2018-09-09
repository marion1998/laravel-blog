@extends('layouts.app')

@section('content')
<div class="container">
   <h2>Tag: {{$disptag}}</h2>
    <div class="justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        @foreach($posts as $post)
        @php
        $date=$post->created_at;
        @endphp
        <br>     
        <div class="card">

            <a href="/posts/{{$post->id}}"><div class="card-header"><h3>{{$post->title}}</h3></div></a>
            <div class="card-body">@php echo $post->content @endphp <br></div>
        </div>
        @endforeach
        
    </div>
</div>
@endsection