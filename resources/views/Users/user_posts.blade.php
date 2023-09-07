@extends('layouts/master')

@section('title')
    User Posts
@endsection

@section('body')
    <div class="page-desc1">
        <h2>Posts created by {{ $name }}</h2>
    </div>
    <hr class="hr-page">

    <div class="post-list">
        @forelse($posts as $post)
            <div class="post-box">
                <div>
                    <h2><a href="{{ url('/post_details/' . $post->pid) }}">{{ $post->title }}</a></h2>
                </div>
                <p>Posted on: {{ $post->date }}</p>
                <p>{{ $post->message }}</p>
            </div>
        @empty
            <p>No posts added by {{ $name }} yet!</p>
        @endforelse
    </div>
@endsection
