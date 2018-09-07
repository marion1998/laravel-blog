@extends('layouts.app')

@section('content')
<div class="container">
    <div class="justify-content-center">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <br>     
        <div class="card">
            <h3><div class="card-header">{{$post->title}}</div></h3>
            <div class="card-body"> @php echo $post->content @endphp </div>
            <div class="card-footer">Par {{$post->name}} le {{$post->created_at}} </div>
        </div>
    </div>
    @foreach($tags as $tag)
        <?php
        $tagdec = json_decode ($tag->name);
        $tagslg = json_decode($tag->slug);
        ?>
        <a href="/posts/tag/{{$tagdec->en}}">{{$tagdec->en.", "}}</a>
        
    @endforeach
    <br>
    @if($user!=NULL)
        <a  href="/comments/create/{{$post->idpost}}">Ajouter Commentaire</a>
    @endif
    <h2>Commentaires:</h2>
    @foreach($comments as $comment)
    <div class="card">
        <div class="card-body">{{$comment->content}}</div>
        <div class="card-footer">Par {{$comment->name}} le {{$comment->created_at}} </div>
    </div>
    @endforeach
    
</div>
@endsection