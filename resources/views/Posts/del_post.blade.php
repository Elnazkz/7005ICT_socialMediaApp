@extends('layouts.master')

@section('title')
    Del Post
@endsection

@section('body')
    <div class="page-desc1">
        <h2>Delete Post</h2>
        <a class="button push-left-btn" href="{{ url('/post_del/' . $post->id) }}">Delete</a>
        <a class="button" href="{{ url('/post_details/' . $post->id) }}">Cancel</a>
    </div>
    <hr class="hr-page">
    @yield('body')

    <div class="data-list">
        <div class="card-box">
            <br>
            <h2>Deleting post "{{ $post->title }}", author {{ $post->name }}.</h2>
            <br>
            <h3 class="alert-message">Deleting a post, will also delete its COMMENTS and LIKES.</h3>
            <h3 class="alert-message">Are you sure?</h3>
            <br>
        </div>
    </div>
@endsection
