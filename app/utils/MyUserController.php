<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class MyUserController
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get all users from database and show them on the user page
     */
    public static function show_all()
    {
        $users = DB::select('select * from users');
        return view('Users.users', ['users' => $users]);
    }

    /**
     * @param int $user_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get the user data and his posts from the database
     * then show users' posts page
     */
    public static function show(int $user_id)
    {
        $user_id = Helpers::security_checks($user_id);
        $sql = "select p.id as pid, p.title, p.message, p.date, u.id as uid, u.Name from Posts as p, Users as u " .
            "where u.id = p.userId and " .
            "p.userId = ?";
        $posts = DB::select($sql, array($user_id));

        //if no posts added by the user then we have to set the posts array and name var to avoid errors
        //if posts array is empty , we will just get the name of the user
        if (count($posts) == 0) {
            $name = DB::select("select name from users where id = ?", array($user_id))[0]->name;
        } else {
            $name = $posts[0]->name;
        }

        return view("Users/user_posts", ['name' => $name, 'posts' => $posts]);
    }

    /**
     * @param int $user_id
     * @return int
     * helper function
     * get the number of posts that user has posted and return it
     */
    public static function count_user_posts(int $user_id): int
    {
        // give the count of all row in posts where userId is the one we want
        $sql = "select count(*) as cnt from Posts where userId = ?";
        $cnt = DB::select($sql, array($user_id));
        return $cnt[0]->cnt;
    }
}
