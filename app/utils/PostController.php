<?php

namespace App\utils;

use App\Helpers\Helpers;
use Illuminate\Support\Facades\DB;

class PostController
{
    /**
     * show all posts and the data needed (author name, comments count) for the first page
     * also sort according to date created, showing the most recent on top
     **/
    public static function show_all()
    {
        $posts = DB::select(
            'select p.id, p.title, p.date, u.name ' .
            'from posts as p, users as u ' .
            'where p.userId = u.id');

        //sort posts in chronical order descending, showing the most recent on top
        $posts = collect($posts)->sortByDesc('date');

        $newPosts = [];

        foreach ($posts as $post) {
            $sql = 'select count(*) as count from comments where postId = ?';
            $commentCount = DB::select($sql, array($post->id));
            $newPosts[$post->id] = array($post, $commentCount[0]->count);
        }

        return view('home', ['posts' => $newPosts]);
    }


    /**
     * show create post page, also send user name set in session
     */
    public static function show_create()
    {
        session_start();
        $session_user = $_SESSION['session_user'] ?? "";
        return view('posts.create_post', ['session_user' => Helpers::security_checks($session_user)]);
    }

    /**
     * make and check the validation based on the rules given
     * if there are errors, reload the page and show the errors messages
     * get the values set for the fields, get the user from database
     * if user is not in the database, add it otherwise add the post to the database
     */
    public static function store()
    {
        // The validation rules are set here and checked on the post variables
        $res = Helpers::make_validation([
            'name' => 'required|alpha',
            'title' => 'required|min:3',
            'message' => 'required|words:5'
        ]);

        // if the validations requirements aren't met, it will go back
        // otherwise it will create a new post
        if (count($res) !== 0) {
            return back()->withInput()->withErrors($res);
        }

        session_start();

        $title = Helpers::security_checks(request('title'));
        $message = Helpers::security_checks(request('message'));
        $user_name = Helpers::security_checks(trim(request('name')));
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
     * @param int $postId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get the post from database , get the author's data from database
     * get the comments for the post from database
     * show the post details
     */
    public static function show(int $postId)
    {
        $postId = Helpers::security_checks($postId);
        $sql = "select * from posts where id = ?";
        $posts = DB::select($sql, array($postId));
        $post = $posts[0];

        $sql = "select * from Users where id = ?";
        $authors = DB::select($sql, array($post->userId));
        $author = $authors[0];

        $comments = CommentController::parent_comments($postId);

        return view("posts.post_details", ['post' => $post, 'user' => $author, 'parentComments' => $comments]);
    }

    /**
     * @param int $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get the data needed to edit the post
     * show the edit post page
     */
    public static function show_edit(int $post_id)
    {
        $sql = "select p.id as pid, p.title, p.message, u.id as uid, u.name from Posts as p, Users as u " .
            "where p.userId = u.id and " .
            "p.id = ?";
        $post = DB::select($sql, array(Helpers::security_checks($post_id)));
        return view("posts.edit_post", ['post' => $post[0]]);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * set the validation fields based on rules set for the fields
     * if there are errors, reload the page and show the errors
     * get the current date and time and update the post details
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
        $title = Helpers::security_checks(request('title'));
        $message = Helpers::security_checks(request('message'));
        $id = Helpers::security_checks(trim(request('pid')));
        DB::update($sql, array($title, $message, $now, $id));
        return redirect('post_details/' . $id);
    }


    /**
     * @param int $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * delete the post, its likes and comments from database then go back to home page
     */
    public static function destroy(int $post_id)
    {
        $post_id = Helpers::security_checks($post_id);
        $sql = "delete from Comments where postId = ?";
        DB::delete($sql, array($post_id));
        $sql = "delete from Likes where postId = ?";
        DB::delete($sql, array($post_id));
        $sql = "delete from Posts where id = ?";
        DB::delete($sql, array($post_id));

        return redirect('/');
    }

    /**
     * @param int $post_id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     * get the data for the post to show on the confirmation page
     * show delete confirmation page
     */
    public static function confirm_del(int $post_id)
    {
        $sql = "select p.id, p.title, p.message, u.name from Posts as p , Users as u " .
            "where p.userId = u.id and " .
            "p.id = ?";
        $post = DB::select($sql, array(Helpers::security_checks($post_id)));
        return view('posts.del_post', ['post' => $post[0]]);
    }
}
