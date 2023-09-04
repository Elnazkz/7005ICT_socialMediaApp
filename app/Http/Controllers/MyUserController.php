<?php

namespace App\Http\Controllers;

use App\Models\MyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MyUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::select('select * from users');
        return view ('Users.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(int $user_id)
    {
        $sql = "select p.id as pid, p.title, p.message, p.date, u.id as uid, u.Name from Posts as p " .
            "left join Users as u on u.id = p.userId " .
            "where p.userId = ?";
        $posts = DB::select($sql, array($user_id));
        return view("Users/user_posts", ['name' => $posts[0]->name, 'posts' => $posts]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MyUser $myUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MyUser $myUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MyUser $myUser)
    {
        //
    }

    public static function count_user_posts(int $user_id) : int {
        $sql = "select count(*) as cnt from (select * from Posts where userId = ?)";
        $cnt = DB::select($sql, array($user_id));
        return $cnt[0]->cnt;
    }
}
