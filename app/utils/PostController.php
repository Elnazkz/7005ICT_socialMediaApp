<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class PostController
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        $posts = DB::select(
            'select p.id, p.title, p.date, u.name ' .
            'from posts as p, users as u ' .
            'where p.userId = u.id');
        //sort posts in chronical order descending, showing the most recent on top
        $posts = collect($posts)->sortByDesc('date');
        return view ('home', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public static function create()
    {
        session_start();

        $session_user = $_SESSION['session_user'] ?? "";
        return view('posts.create_post', ['session_user' => $session_user]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public static function store()
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

        $title = trim(request('title'));
        $message = request('message');
        $user_name = trim(request('user_name'));
        $_SESSION['session_user'] = $user_name;

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::insert($sql, array($user_name));
            $user = DB::select("select * from Users where name = ?", array($user_name));
        }
        $user_id = $user[0]->id;
        $now = date('Y-m-d H:i:s');
        $sql = "insert into Posts (title, message, date, userId) values (?, ?, ?, ?)";
        DB::insert($sql, array($title, $message, $now, $user_id));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public static function show(int $postId)
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
    public static function edit(int $post_id)
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
    public static function update()
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
        $title = request('title');
        $message = request('message');
        $id = trim(request('pid'));
        DB::update($sql, array($title, $message, $now, $id));
        return redirect('post_details/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public static function destroy(int $post_id)
    {
        $sql = "delete from Comments where postId = ?";
        DB::delete($sql, array($post_id));
        $sql = "delete from Posts where id = ?";
        DB::delete($sql, array($post_id));

        return redirect('/');
    }

    public static function confirm_del(int $post_id) {
        $sql = "select p.id, p.title, p.message, u.name from Posts as p " .
            "left join Users u on p.userId = u.id " .
            "where p.id = ?";
        $post = DB::select($sql, array($post_id));
        return view('posts.del_post', ['post' => $post[0]]);
    }
}
