@extends('layouts/master')

@section('title')
    Home
@endsection

@section('body')
    <div class="page-desc1">
        <h2>All Posts</h2>
        <a class="button" href="{{ url('posts/showCreate') }}">Create</a>
    </div>
    <hr class="hr-page">

    <div class="data-list">
        {{--    loop through the posts list and set each post's values in its place in html--}}

        @if (!empty($posts) && isset($posts))
            @forelse($posts as $postId => $postCommentCountArray)
                <div class="card-box">
                    {{--           $post is the key value pair, value is an array of object post in pos 0 and number of its comments in pos 1--}}
                    <div>
                        <h2 class="post-title"><a
                                href="{{ url('/post_details/' . $postCommentCountArray[0]->id) }}">{{ $postCommentCountArray[0]->title }}</a>
                        </h2>
                        <p class="post-data">Comments : {{ $postCommentCountArray[1]  }}</p>
                    </div>

                    <br>
                    <p class="post-data">Posted at: {{ $postCommentCountArray[0]->date }}</p>
                    <p class="post-data">Author: {{ $postCommentCountArray[0]->name }}</p>
                </div>
            @empty
                {{--        is list empty, then show this--}}
                <h2>No post defined yet !</h2>
            @endforelse
        @else
            <h2>No post defined yet !</h2>
        @endif
    </div>
@endsection
