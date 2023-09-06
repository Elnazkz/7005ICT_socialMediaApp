@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('body')
    <div>
        <div class="page-desc1">
            <h2>Post Details</h2>
            <a class="button push-left-btn" href="{{ url('edit_post/' . $post->id) }}">Edit</a>
            <a class="button" href="{{ url('del_post/' . $post->id) }}">Delete</a>
        </div>
        <hr class="hr-page">

        <div class="post-list">
            <div class="post-box">
                <div class="post-desc1">
                    <h2>{{ $post->title }}</h2>
                    <a class="button" href="{{ url('comments/create') }}/{{ $post->id }}">Reply</a>
                </div>
                <p class="post-date">Posted on: {{ $post->date }}</p>
                <p class="post-author">Author: {{ $user->name }}</p>
                <p class="post-message">{{ $post->message }}</p>
            </div>

            @foreach($parentComments as $parentComment)
                <details class="comment-box">
                    <summary>
                        <span>{{ $parentComment->date }}</span>
                    </summary>
                    <ul>
                        <div class="comment-box">
                            <li>
                                <span>{{ $parentComment->message}}</span>,
                                <span>{{ $parentComment->name }}</span>
                            </li>
                        </div>
                        @php($sc = App\Http\Controllers\CommentController::sub_comments($parentComment->postId, $parentComment->cid))
                        @if (count($sc))
                            @include('Comments\sub_comment_list', ['sub_comments' => $sc])
                        @endif
                    </ul>
                </details>
            @endforeach
        </div>
    </div>
@endsection
