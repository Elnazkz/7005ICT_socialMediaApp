@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('body')
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
            <div class="show-like">
                <div>
                    <p class="post-date">Posted on: {{ $post->date }}</p>
                    <p class="post-author">Author: {{ $user->name }}</p>
                </div>
                <div class="push-left-like">
                    @php($cnt = \App\utils\LikeController::count($post->id))
                    @if ($cnt == 0)
                        <a href="{{ url('/likes/check_like/' . $post->id) }}">
                            <img src="{{ url('images/not_liked.png') }}">
                        </a>
                    @else
                        <p class="push-left-like">{{ $cnt }}</p>
                        <a href="{{ url('likes/check_like/' . $post->id) }}">
                            <img src="{{ url('images/liked.png') }}">
                        </a>
                    @endif
                </div>
            </div>
            <div class="post-message1"><p class="post-message1">{!! nl2br($post->message) !!}</p></div>
        </div>

        {{-- will loop through the parent comments which are the comments for the post, not a reply to a comment--}}
        @foreach($parentComments as $parentComment)
            {{--                this will get the subcomments for this comment--}}
            @php($sc = \App\utils\CommentController::sub_comments($parentComment->postId, $parentComment->cid))

            @if (count($sc))
                <details class="comment-box">
                    <summary>
                        <span>{{ $parentComment->message}}</span>,
                        <span>{{ $parentComment->date }}</span>,
                        <span>{{ $parentComment->name }}</span>
                        <a class="button" style="margin-left: 10px;"
                           href="{{ url('comments/reply') }}/{{ $post->id }}/{{ $parentComment->cid }}">Reply</a>
                    </summary>

                    {{--                if the subcomments are not empty then will add the subcomment to the page--}}
                    @if (count($sc))
                        @include('Comments\sub_comment_list', ['sub_comments' => $sc])
                    @endif
                </details>
            @else
                <div class="comment-box">
                    <span>{{ $parentComment->message}}</span>,
                    <span>{{ $parentComment->date }}</span>,
                    <span>{{ $parentComment->name }}</span>
                    <a class="button" style="margin-left: 10px;"
                       href="{{ url('comments/reply') }}/{{ $post->id }}/{{ $parentComment->cid }}">Reply</a>
                </div>
            @endif
        @endforeach
    </div>
@endsection
