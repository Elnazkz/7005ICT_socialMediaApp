<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\MyUser;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = DB::select(
            'select p.id, p.title, u.name ' .
            'from posts as p, users as u ' .
            'where p.userId = u.id');
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
//        $request->validate([
//            'user_name' => 'required|alpha|min:3',
//            'title' => 'required|min:3',
//            'message' => 'required'
//        ]);

        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'user_name' => 'required|alpha',
            'title' => 'required|min:3',
            'message' => 'required|words:5'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        $title = trim($request->title);
        $message = $request->message;
        $user_name = trim($request->user_name);

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from users where name = '" . $user_name . "'");

        if ($user != null) {
            $user_id = $user[0]->id;
        } else {
            $sql = "insert into Users (name) VALUES ('". $user_name ."');";
            DB::select($sql);
            $user = DB::select("select * from users where name = '" . $user_name . "'");
            $user_id = $user[0]->id;
        }
        $now = date('Y-m-d H:i:s');
        $sql = "insert into posts (title, message, date, userId) values ('" . $title . "', '" . $message . "', '" . $now . "', '" . $user_id . "')";
        $post = DB::select($sql);

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $postId)
    {
        $sql = "select * from posts where id = '" . $postId . "'";
        $posts = DB::select($sql);
        $post = $posts[0];

        $authors = DB::select("select * from users where id = '" . $post->userId ."'");
        $author = $authors[0] ;

        $comments = DB::select("select * from comments as c, users as u where c.userId = u.id and postId = '" . $postId . "'");

        return view("posts.post_details", ['post' => $post, 'user' => $author, 'comments' => $comments]);
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
    public function update(Request $request, Post $post)
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
