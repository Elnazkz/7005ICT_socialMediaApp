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

Route::get('/home', function () {
    return view('home');
});

Route::get('/post_details/{post_id}', function ($post_id) {
    return view('post_details', ['post_id' => $post_id]);
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

