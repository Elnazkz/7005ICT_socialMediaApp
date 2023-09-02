<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

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

Route::get('/posts/create', [PostController::class, 'create']);

Route::post('/create_post', [PostController::class, 'store']);

Route::get('/posts/{user_id}', function ($user_id) {
    return view('posts.user_posts', ['user_id' => $user_id]);
});

Route::get('/post_details/{post_id}', function ($post_id) {
    return view('posts.post_details', ['post_id' => $post_id]);
});

Route::get('/edit_post/{post_id}', function ($post_id) {
    return view('posts.edit_post', ['post_id' => $post_id]);
});

Route::get('/del_post/{post_id}', function ($post_id) {
    return view('posts.del_post', ['post_id' => $post_id]);
});

Route::get('/edit_comment/{comment_id}', function ($comment_id) {
    return view('posts.edit_comment', ['comment_id' => $comment_id]);
});

Route::get('/users', function () {
    return view('users');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/', [PostController::class, 'index']);
