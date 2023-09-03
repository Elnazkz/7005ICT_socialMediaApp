@extends('layouts.master')

@section('title')
    Del Post
@endsection

@section('body')
    <div class="top-div">
        <h2>Delete Post</h2><span>Post Id = {{ $post_id }}</span>
        <div class="post-list">
            <div class="post-box">
                <p class="post-content">post title</p>
                <p class="post-content">some text as the post message 1</p>
                <input type="submit" value="Ok">
                <input type="submit" value="Cancel">
            </div>
        </div>
    </div>
@endsection
