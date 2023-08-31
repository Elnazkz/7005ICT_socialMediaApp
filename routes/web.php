<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/posts', function () {
    return view('posts');
});

Route::get('/posts/{user_id}', function ($user_id) {
    return view('user_posts', ['user_id' => $user_id]);
});

Route::get('/post_details/{post_id}', function ($post_id) {
    return view('post_details', ['post_id' => $post_id]);
});

Route::get('/edit_post/{post_id}', function ($post_id) {
    return view('edit_post', ['post_id' => $post_id]);
});

Route::get('/del_post/{post_id}', function ($post_id) {
    return view('del_post', ['post_id' => $post_id]);
});

Route::get('/edit_comment/{comment_id}', function ($comment_id) {
    return view('edit_comment', ['comment_id' => $comment_id]);
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/user/{user_id}', function () {
    return view('user');
});

Route::get('/about', function () {
    return view('about');
});

