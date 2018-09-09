@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Ajout d'un commentaire</h2><br />
    <form method="post" action="{{url('comments')}}" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="author"  value="{{$user->id}}" hidden>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <label for="Number">Contenu:</label>
                <textarea name="content"></textarea>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-group col-md-4">
                <input type="text" class="form-control" name="idPost" value="{{$idpost}}" hidden>
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
