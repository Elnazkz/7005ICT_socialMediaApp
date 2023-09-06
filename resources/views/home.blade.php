@extends('layouts/master')

@section('title')
    All Posts
@endsection

@section('body')
    <div>
        <div class="page-desc1">
            <h2>All Posts</h2>
            <a class="button" href="{{ url('posts/create') }}">Create</a>
        </div>
        <hr class="hr-page">

        <div class="post-list">
            @if (!empty($posts) && isset($posts))
                @forelse($posts as $post)
                    <div class="post-box">
                        <h2 class="post-title"><a href="{{ url('/post_details/' . $post->id) }}">{{ $post->title }}</a></h2>
                        <p class="post-date">Posted at: {{ $post->date }}</p>
                        <p class="post-author">Author: {{ $post->name }}</p>
                    </div>
                @empty
                    <h2>No post defined yet !</h2>
                @endforelse
            @else
                <h2>No post defined yet !</h2>
            @endif
        </div>
    </div>
@endsection
