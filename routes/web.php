<?php

use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use \App\Http\Controllers\MyUserController;

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
Route::get('/', [PostController::class, 'index']);

Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/create_post', [PostController::class, 'store']);

Route::get('/posts/{user_id}', [MyUserController::class, 'show']);

Route::get('/post_details/{post_id}', [PostController::class, 'show']);

Route::get('/edit_post/{post_id}', function ($post_id) {
    return view('posts.edit_post', ['post_id' => $post_id]);
});

Route::get('/del_post/{post_id}', function ($post_id) {
    return view('posts.del_post', ['post_id' => $post_id]);
});

Route::get('/comments/create/{post_id}', [CommentController::class, 'create']);
Route::post('/create_comment', [CommentController::class, 'store']);


Route::get('/edit_comment/{comment_id}', function ($comment_id) {
    return view('posts.edit_comment', ['comment_id' => $comment_id]);
});

Route::get('/users', [MyUserController::class, 'index']);

Route::get('/about', function () {
    return view('about');
});

