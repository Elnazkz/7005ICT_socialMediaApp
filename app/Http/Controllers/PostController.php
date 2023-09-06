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
            'select p.id, p.title, p.date, u.name ' .
            'from posts as p, users as u ' .
            'where p.userId = u.id');
        return view ('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        session_start();

        $session_user = $_SESSION['session_user'] ?? "";
        return view('posts.create_post', ['session_user' => $session_user]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(Request $request)
    {
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

        session_start();

        $title = trim($request->title);
        $message = $request->message;
        $user_name = trim($request->user_name);
        $_SESSION['session_user'] = $user_name;

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::select($sql, array($user_name));
            $user = DB::select("select * from Users where name = ?", array($user_name));
        }
        $user_id = $user[0]->id;
        $now = date('Y-m-d H:i:s');
        $sql = "insert into Posts (title, message, date, userId) values (?, ?, ?, ?)";
        DB::select($sql, array($title, $message, $now, $user_id));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $postId)
    {
        $sql = "select * from posts where id = ?";
        $posts = DB::select($sql, array($postId));
        $post = $posts[0];

        $sql = "select * from Users where id = ?";
        $authors = DB::select($sql, array($post->userId));
        $author = $authors[0] ;

        $comments = CommentController::parent_comments($postId);

        return view("posts.post_details", ['post' => $post, 'user' => $author, 'parentComments' => $comments]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $post_id)
    {
        $sql = "select p.id as pid, p.title, p.message, u.id as uid, u.name from Posts as p " .
            "left join Users u on p.userId = u.id " .
            "where p.id = ?";
        $post = DB::select($sql, array($post_id));
        return view("posts.edit_post", ['post' => $post[0]]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'title' => 'required|min:3',
            'message' => 'required|words:5'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        $now = date('Y-m-d H:i:s');
        $sql = "update Posts set title = ?, message = ?, date = ? " .
            "where id = ?";
        DB::select($sql, array($request->title, $request->message, $now, $request->pid));
        return redirect('post_details/' . $request->pid);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $post_id)
    {
        $sql = "delete from Comments where postId = ?";
        DB::select($sql, array($post_id));
        $sql = "delete from Posts where id = ?";
        DB::select($sql, array($post_id));

        return redirect('/');
    }
}
