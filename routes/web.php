<?php

    use Illuminate\Support\Facades\Auth;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/','PostsController@index');

Auth::routes();
Route::get('/comments/create','PostsController@index');
Route::get('/comments/create/{idpost}', function ($idpost){
    $user = Auth::user();
    if ($user!=NULL){
        return view('createCom',['idpost'=>$idpost, 'user'=>$user]);
    }else{
        return redirect('posts/'.$idpost);
    }
});

Route::post('/posts/update','PostsController@index');
Route::post('/posts/update/{id}','PostsController@update');

Route::get('/posts/destroy', 'PostsController@index');
Route::get('/posts/destroy/{idpost}', 'PostsController@destroy');

//Route::get('/home', 'HomeController@index')->name('home');
Route::resource('posts','PostsController');
Route::resource('comments','CommentsController');

Route::get('/posts/tag','PostsController@index');
Route::get('/posts/tag/{tag}','PostsController@showTag');
Route::any('{all}', array('uses'=>'PostsController@index'))->where('all','.*');
