@extends('layouts/master')

@section('title')
    User Posts
@endsection

@section('body')
    <div>
        <h2 class="inline-elem">Posts created by {{ $name }}</h2>
        <div>
            @foreach($posts as $post)
                <div class="post-box">
                    <div>
                        <h2><a href="{{ url('/post_details/' . $post->pid) }}">{{ $post->title }}</a></h2>
                    </div>
                    <p>Posted on: {{ $post->date }}</p>
                    <p>{{ $post->message }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
