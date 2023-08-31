@extends('layouts/master')

@section('title')
    Edit Post
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')
    <div class="top-div">
        <h2>Edit Post</h2><span>Post Id = {{ $post_id }}</span>

        <form>
            <div class="post-box">
                <label for="post_title">Post Title</label><br>
                <input type="text" id="post_title" name="post_title" value="post title 1"><br><br>
                <label for="post_message">Post Message</label><br>
                <input type="text" id="post_message" name="post_message" value="some text as the post message 1"><br><br>
                <input type="submit" value="Apply">
                <input type="submit" value="Cancel">
            </div>
        </form>

    </div>
@endsection
