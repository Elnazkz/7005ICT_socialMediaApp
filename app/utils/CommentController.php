<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class CommentController
{
    /**
     * @param int $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get post id, show comment creation page
     */
    public static function show_create(int $post_id)
    {
        session_start();
        $session_user = $_SESSION['session_user'] ?? "";

        return view('comments.create_comment', ['post_id' => Helpers::security_checks($post_id), 'session_user' => Helpers::security_checks($session_user)]);
    }

    /**
     * @param int $post_id
     * @param int $parent_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * reply to a comment
     * show create comment page
     */
    public static function reply(int $post_id, int $parent_id)
    {
        session_start();
        $session_user = $_SESSION['session_user'] ?? "";
        return view('comments.reply_comment', ['post_id' => Helpers::security_checks($post_id),
            'parent_id' => Helpers::security_checks($parent_id),
            'session_user' => Helpers::security_checks($session_user)]);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * set validation based on rules set on fields
     * if the user is not already in the database, then add it
     * otherwise get the user id and add the comment
     */
    public static function store()
    {
        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'user_name' => 'required|min:4|alpha',
            'message' => 'required|words:5'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        session_start();

        $post_id = Helpers::security_checks(trim(request('post_id')));
        $user_name = Helpers::security_checks(trim(request('user_name')));
        $message = Helpers::security_checks(trim(request('message')));
        $parentId = Helpers::security_checks(trim(request('parent_id')));
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
        $sql = "insert into Comments (message, date, userId, postId, parentCommentID) values (?, ?, ?, ?, ?)";


        DB::insert($sql, array($message, $now, $user_id, $post_id, $parentId));

        return redirect('/post_details/' . $post_id);
    }

    /**
     * @param int $postId
     * @param int $parentCommentID
     * @return array
     * get the sub comments or replies for a comment
     */
    public static function sub_comments(int $postId, int $parentCommentID): array
    {
        $sql = "select c.id as cid, c.parentCommentID, c.postId, u.id as uid, c.message, c.date, u.name from Comments as c, Users as u " .
            "where c.userId = u.id and " .
            "(c.parentCommentID = ?) and (c.postId = ?) ";
        $sub_comments =
            DB::select($sql,
                array(Helpers::security_checks($parentCommentID), Helpers::security_checks($postId))
            );
        return $sub_comments;
    }

    /**
     * @param int $postId
     * @return array
     * get the parent comment , which does not have any parent comments
     */
    public static function parent_comments(int $postId): array
    {
        $sql = "select c.id as cid, c.parentCommentID, c.postId, u.id as uid, c.message, c.date, u.name from Comments as c, Users as u " .
            "where c.userId = u.id and " .
            "(c.parentCommentID IS NULL) and (c.postId = ?) ";
        $comments =
            DB::select($sql,
                array(Helpers::security_checks($postId))
            );
        return $comments;
    }
}
