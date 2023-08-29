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
        <div class="post-list">
            <div class="post-box">
                <p class="post-content">post title</p>
                <p class="post-content">some text as the post message 1</p>
            </div>
        </div>
    </div>
@endsection
