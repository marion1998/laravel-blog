@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajout de Post</h2><br />
    <form method="post" action="/posts/update/{{$info->id}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="author" value="{{$user->id}}" hidden>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Email">Titre:</label>
                <input type="text" class="form-control" name="title" value="{{$info->title}}">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Number">Contenu:</label>
                <textarea name="content">{{$info->content}}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4" style="margin-top:60px">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection