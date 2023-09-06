<?php

namespace App\utils;

use Illuminate\Support\Facades\DB;

class MyUserController
{
    /**
     * Display a listing of the resource.
     */
    public static function index()
    {
        $users = DB::select('select * from users');
        return view ('Users.users', ['users' => $users]);
    }

    /**
     * Display the specified resource.
     */
    public static function show(int $user_id)
    {
        $sql = "select p.id as pid, p.title, p.message, p.date, u.id as uid, u.Name from Posts as p " .
            "left join Users as u on u.id = p.userId " .
            "where p.userId = ?";
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

    public static function count_user_posts(int $user_id) : int {
        // give the count of all row in posts where userId is the one we want
        $sql = "select count(*) as cnt from Posts where userId = ?";
        $cnt = DB::select($sql, array($user_id));
        return $cnt[0]->cnt;
    }
}
