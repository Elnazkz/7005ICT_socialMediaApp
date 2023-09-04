<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $post_id)
    {
        return view('comments.create_comment', ['post_id' => $post_id]);
    }

    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public function store(Request $request)
    {
        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'user_name' => 'required|min:4',
            'message' => 'required|words:5'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        $post_id = trim($request->post_id);
        $user_name = trim($request->user_name);
        $message = trim($request->message);

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::select($sql, array($user_name));
            $user = DB::select("select * from Users where name = ?", array($user_name));
        }
        $user_id = $user[0]->id;
        $now = date('Y-m-d H:i:s');
        $sql = "insert into Comments (message, date, userId, postId, parentCommentID) values (?, ?, ?, ?, ?)";
        DB::select($sql, array($message, $now, $user_id, $post_id, null));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }

    /**
     * Structure and Display Hierarchical / Multi-level data in Laravel
     * tgugnani
     * Apr 2, 2019
     * https://5balloons.info/hierarchical-data-laravel-relationship-display
     */

    public static function sub_comments(int $postId, int $parentCommentID) : array {
        $sql = "select * from Comments where postId = ? and parentCommentID = ?";
        $sql = "select c.id as cid, c.parentCommentID, c.postId, u.id as uid, c.message, c.date, u.name from Comments as c " .
            "left join Users as u on c.userId = u.id " .
            "where (c.parentCommentID = ?) and (c.postId = ?) ";
        $sub_comments = DB::select($sql, array($parentCommentID, $postId));
        return $sub_comments;
    }

    public static function parent_comments(int $postId) : array {
        $sql = "select c.id as cid, c.parentCommentID, c.postId, u.id as uid, c.message, c.date, u.name from Comments as c " .
            "left join Users as u on c.userId = u.id " .
            "where (c.parentCommentID IS NULL) and (c.postId = ?) ";
        $comments = DB::select($sql, array($postId));
        return $comments;
    }
}
