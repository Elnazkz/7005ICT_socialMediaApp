@extends('layouts.master')

@section('title')
    Del Post
@endsection

@section('bodyTitle')
    Delete Post
@endsection

@section('bodyTitleExtra')
    <a class="button push-left-btn" href="{{ url('/post_del/' . $post->id) }}">Delete</a>
    <a class="button" href="{{ url('/post_details/' . $post->id) }}">Cancel</a>
@endsection

@section('body')
    <div class="post-list">
        <div class="post-box">
            <br>
            <h2>Deleting post "{{ $post->title }}", author {{ $post->name }}.</h2>
            <br>
            <h3 class="alert-message">Deleting a post, will also delete its comments.</h3>
            <h3 class="alert-message">Are you sure?</h3>
            <br>
        </div>
    </div>
@endsection
