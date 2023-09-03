@extends('layouts/master')

@section('title')
    Home
@endsection

@section('body')
    <div>
        <h2>Home</h2>
        <a class="button" href="{{ url('posts/create') }}">Create</a>

        <div class="post-list">
            @if (!empty($posts) && isset($posts))
                @forelse($posts as $post)
                    <div class="post-box">
                        <h2 class="post-title"><a href="{{ url('/post_details/' . $post->id) }}">{{ $post->title }}</a></h2>
                        <p class="post-author">{{ $post->name }}</p>
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
