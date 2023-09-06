@extends('layouts.master')

@section('title')
    Del Post
@endsection

@section('body')
    <div class="top-div">
        <div class="page-desc1">
            <h2>Delete Post</h2>
            <a class="button push-left-btn" href="{{ url('/post_del/' . $post->id) }}">Delete</a>
            <a class="button" href="{{ url('/post_details/' . $post->id) }}">Cancel</a>
        </div>
        <hr class="hr-page">

        <div class="post-list">
            <div class="post-box">
                <p>Deleting post "{{ $post->title }}", author {{ $post->name }}.</p>
                <br>
                <h3 class="alert-message">Deleting a post, will also delete its comments.</h3>
                <h3 class="alert-message">Are you sure?</h3>
            </div>
        </div>
    </div>
@endsection
