@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('body')

    <div>
        <h2 class="inline-elem">Post Details</h2>
        <div>
            <div class="post-box">
                <div>
                    <span><h2>{{ $post->title }}</h2></span>



                    <span>
                        <a class="button" href="{{ url('comments/create') }}/{{ $post->id }}">Create</a>
                    </span>
                    <span>
                        <a class="button" href="{{ url('edit_post/') }}/{{ $post->id }}">Edit</a>
                    </span>
                </div>
                <p>Posted on: {{ $post->date }}</p>
                <p>Author: {{ $user->name }}</p>
                <p>{{ $post->message }}</p>
            </div>

            @foreach($parentComments as $parentComment)
                <ul>
                    <div class="comment-box">
                        <li>
                            <span>{{ $parentComment->message}}</span>,
                            <span>{{ $parentComment->date }}</span>,
                            <span>{{ $parentComment->name }}</span>
                        </li>
                    </div>
                    @php
                        $sc = App\Http\Controllers\CommentController::sub_comments($parentComment->postId, $parentComment->cid);
                    @endphp
                    @if (count($sc))
                        @include('Comments\sub_comment_list', ['sub_comments' => $sc])
                    @endif
                </ul>
            @endforeach
        </div>
    </div>
@endsection
