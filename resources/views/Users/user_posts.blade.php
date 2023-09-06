@extends('layouts/master')

@section('title')
    User Posts
@endsection

@section('bodyTitle')
    Posts created by {{ $name }}
@endsection

@section('body')
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
