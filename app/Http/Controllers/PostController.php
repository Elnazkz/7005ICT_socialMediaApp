<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//use App\Http\Requests\StorePostRequest;
//use App\Http\Requests\UpdatePostRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //$posts = Post::all();
        $posts = DB::select('select p.id, p.title, u.name from posts as p, my_users as u where p.user_id = u.id');
        return view ('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create_post');
    }

    /**
     * Store a newly created resource in storage.
     */
    //public function store(StorePostRequest $request)
    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required|alpha',
            'title' => 'required|min:3',
            'message' => 'required'
        ]);
        $post = new Post();
        $post->title = trim($request->title);
        $post->message = $request->message;
        $user_name = trim($request->user_name);
        $user = DB::select("select * from my_users where name = '" . $user_name . "'");

        if ($user != null) {
            $post->user_id = $user[0]->id;
        } else {
            $my_user = new MyUser();
            $my_user->name = $user_name;
            $my_user->save();
            $post->user_id = $my_user->id;
        }
        $post->save();
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
