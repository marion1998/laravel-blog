<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=DB::table('posts')
            ->select('posts.id as idpost', 'posts.title','posts.author','posts.content','posts.created_at','posts.updated_at','users.id as iduser','users.name as name')
            ->join('users', function ($join) {
                $join->on('posts.author', '=', 'users.id');
            })
            ->get();
        $user = Auth::user();
        return view('listpost',compact('posts'),compact('user'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user!=NULL){
            return view('create', compact('user'));
        }else{
            return redirect('posts');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post= new \App\Post;
        $post->title=$request->get('title');
        $post->author=$request->get('author');
        $post->content=nl2br($request->get('content'));
        $post->save();
        $tags= $request->get('tags');
        $tagList= explode(",",$tags);
        $tagListTr= array_map('trim',$tagList);
        $post->attachTags($tagListTr);
        $post->save();
        return redirect('posts')->with('success', 'Information has been added');
    }
    
    /**
     * Liste les posts pour un tag donné.
     *
     * @param  string  $tag
     * @return \Illuminate\Http\Response
     */
    public function showTag($tag)
    {
        $user = Auth::user();
        $posts=\App\Post::withAnyTags([$tag])->get();
        $disptag=$tag;
        
        return view('showtag',['posts'=>$posts, 'user'=>$user, 'disptag'=>$disptag]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //requete: select le post a l'id $id -> puis rechercher l'user en question vien l'id user
        //pour récupérer le nom de l'user qui a écrit le post
        $req=DB::table('posts')
            ->select('posts.id as idpost', 'posts.title','posts.author','posts.content','posts.created_at','posts.updated_at','users.id as iduser','users.name as name')
            ->where('posts.id', '=', $id)
            ->join('users', function ($join) {
                $join->on('posts.author', '=', 'users.id');
            })
            ->get();
        //requete: select les comments a l'id de post $id -> puis rechercher l'user en question via l'id user
        //pour récupérer le nom de l'user qui a écrit chaque commentaire
        $comments=DB::table('comments')
            ->where('post_id', "=", $id)
            ->join('users', function ($join) {
                $join->on('comments.author', '=', 'users.id');
            })
            ->get();
        $post=$req[0];
        //requete pour récupérer les tags
        $tags=DB::table('taggables')
            ->select('tags.name','tags.slug')
            ->where('taggables.taggable_id','=',$id)
            ->join('tags', function ($join){
                $join->on('taggables.tag_id','=','tags.id');
            })
            ->get();
        $user = Auth::user();
        return view('show',['post'=>$post, 'comments'=>$comments, 'user'=>$user, 'tags'=>$tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $infos = DB::table('posts')
            ->where('id','=',$id)
            ->get();
        $info=$infos[0];
        return view('edit',['user'=>$user,'info'=>$info]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::table('posts')
            ->where('id', $id)
            ->update(['title' => $request->get('title'),'content'=>nl2br($request->get('content'))]);
        return redirect('posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=-1)
    {

            $user=Auth::user();
            $post=DB::table('posts')->where('id', '=', $id)->get();
            if ($post[0]->author == $user->id){
                DB::table('posts')->where('id', '=', $id)->delete();
            }
            return redirect('posts');

    }
}
