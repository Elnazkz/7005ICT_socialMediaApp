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
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        //
    }

    public static function count(int $post_id) {
        $sql = "select count(*) as postCount from (select * from Likes where postId = ?)";
        $like = DB::select($sql, array($post_id));
        return $like[0]->postCount;
    }

    public static function like_it() {
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

        $post_id = request('post_id');
        $user_name = trim(request('user_name'));
        $_SESSION['session_user'] = $user_name;

        // check the user table for the username, if not exist then create the user
        $user = DB::select("select * from Users where name = ?", array($user_name));

        if ($user == null) {
            $sql = "insert into Users (name) VALUES (?)";
            DB::select($sql, array($user_name));
            $user = DB::select("select * from Users where name = ?", array($user_name));
        }
        $user_id = $user[0]->id;

        // TODO - select which one to use from,
        // TODO - either the following duplicate prevention
        // TODO - or the try/catch commented section below.
        // TODO - both have been tested and work as expected.
        //
        $sql = "select count(*) as count from (select * from Likes where postId = " .
           $post_id . " and userId = " . $user_id . ")";
        $unique = DB::select($sql);

        if ($unique[0]->count > 0) {
            $res['user_name'] = 'This user can not resubmit another like.';
            return back()->withInput()->withErrors($res);
        }

//        try {
//            $sql = "insert into Likes (postId, userId) values (?, ?)";
//            DB::insert($sql, array($post_id, $user_id));
//        } catch (QueryException $e){
//            $errorCode = $e->errorInfo[1];
//            if($errorCode == 19){
//                $res['user_name'] = 'This user can not resubmit another like.';
//                return back()->withInput()->withErrors($res);
//            } else {
//                throw $e;
//            }
//        }
        $sql = "insert into Likes (postId, userId) values (?, ?)";
        DB::insert($sql, array($post_id, $user_id));

        return redirect('/post_details/' . $post_id);
    }

    public static function check_like(int $post_id) {
        session_start();

        $session_user = $_SESSION['session_user'] ?? "";

        $sql = "select * from Posts where id = $post_id";
        $post = DB::select($sql);
        return view('Likes.like_post', ['post' => $post, 'session_user' => $session_user]);
    }
}
