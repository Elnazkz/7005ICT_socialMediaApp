<?php


use App\utils\CommentController;
use App\utils\LikeController;
use App\utils\MyUserController;
use App\utils\PostController;
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


Route::get('/likes/check_like/{post}', [LikeController::class, 'check_like']);
Route::post('/likes/like_it', [LikeController::class, 'like_it']);

Route::get('/posts/showCreate', [PostController::class, 'show_create']);
Route::post('/create_post', [PostController::class, 'store']);
Route::get('/post_details/{post_id}', [PostController::class, 'show']);
Route::get('/edit_post/{post_id}', [PostController::class, 'show_edit']);
Route::post('/post_edit', [PostController::class, 'update']);
Route::get('/del_post/{post_id}', [PostController::class, 'confirm_del']);
Route::get('/post_del/{post_id}', [PostController::class, 'destroy']);
Route::get('/', [PostController::class, 'show_all']);


Route::get('/comments/showCreate/{post_id}', [CommentController::class, 'show_create']);
Route::get('/comments/reply/{post_id}/{parent_id}', [CommentController::class, 'reply']);
Route::post('/create_comment', [CommentController::class, 'store']);

Route::get('/users', [MyUserController::class, 'show_all']);
Route::get('/posts/{user_id}', [MyUserController::class, 'show']);

Route::get('/about', function () {
    return view('about');
});

