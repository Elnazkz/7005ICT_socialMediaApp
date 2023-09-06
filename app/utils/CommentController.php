<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class CommentController
{
    /**
     * Show the form for creating a new resource.
     */
    public static function create(int $post_id)
    {
        return view('comments.create_comment', ['post_id' => $post_id]);
    }

    public static function reply(int $post_id, int $parent_id)
    {
        return view('comments.reply_comment', ['post_id' => $post_id, 'parent_id' => $parent_id]);
    }
    /**
     * Store a newly created resource in storage.
     * @throws \Exception
     */
    public static function store()
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

        $post_id = trim(request('post_id'));
        $user_name = trim(request('user_name'));
        $message = trim(request('message'));
        $parentId = request('parent_id');

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::insert($sql, array($user_name));
            $user = DB::select("select * from Users where name = ?", array($user_name));
        }
        $user_id = $user[0]->id;
        $now = date('Y-m-d H:i:s');
        $sql = "insert into Comments (message, date, userId, postId, parentCommentID) values (?, ?, ?, ?, ?)";


        DB::insert($sql, array($message, $now, $user_id, $post_id, $parentId));

        return redirect('/post_details/' . $post_id);
    }

    public static function sub_comments(int $postId, int $parentCommentID) : array {
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
