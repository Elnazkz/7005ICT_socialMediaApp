<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use UtilClass\Like;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class LikeController
{

    /**
     * @param int $post_id
     * @return int
     * get the number of likes for a specific post
     */
    public static function count(int $post_id): int
    {
        $post_id = Helpers::security_checks($post_id);
        $sql = "select count(*) as count from Likes where postId = ?";
        $like = DB::select($sql, array($post_id));
        return $like[0]->count;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * set validation based on rules set for fields
     * get the user data, if the user is not set, add it to the database otherwise add the like to database for the post
     * also check if the user has liked the post or not, if he has liked it before the show message otherwise add it to database
     */
    public static function like_it()
    {
        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'user_name' => 'required|alpha'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        session_start();

        $post_id = Helpers::security_checks(trim(request('post_id')));
        $user_name = Helpers::security_checks(trim(request('user_name')));
        $_SESSION['session_user'] = $user_name;

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::insert($sql, array($user_name));
            $user_id = DB::getPdo()->lastInsertId();
        } else {
            $user_id = $user[0]->id;
        }

        $sql = "select count(*) as count from Likes where postId = ? and userId = ?";
        $unique = DB::select($sql, array($post_id, $user_id));

        if ($unique[0]->count > 0) {
            $res['user_name'] = 'This user can not resubmit another like.';
            return back()->withInput()->withErrors($res);
        }

        $sql = "insert into Likes (postId, userId) values (?, ?)";
        DB::insert($sql, array($post_id, $user_id));

        return redirect('/post_details/' . $post_id);
    }

    /**
     * @param int $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * helper function
     * check if user has liked the post
     * if yes, show message, if not then show like page
     */
    public static function check_like(int $post_id)
    {
        session_start();
        $session_user = $_SESSION['session_user'] ?? "";

        $sql = "select * from Posts where id = ?";
        $post = DB::select($sql, array($post_id));
        return view('Likes.like_post', ['post' => $post,
            'session_user' => Helpers::security_checks($session_user)]);
    }
}
