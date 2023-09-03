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
                    <span><input type="button" value="Reply"/></span>
                    <span>
                        <a href="/edit_post/"{{ $post->id }}<button>Edit</button></a>
                    </span>
                </div>
                <p>Posted on: {{ $post->date }}</p>
                <p>Author: {{ $user->name }}</p>
                <p>{{ $post->message }}</p>
            </div>


            @if(count($comments) != 0)
                @foreach($comments as $comment)

                    <div class="comment-box">
                        <details>
                            <summary role="button" aria-expanded="false" tabindex="0">
                                <span>{{ $comment->message }}</span>
                                <p>Commented on: {{ $comment->date }}</p>
                                <p>Author: {{  }}</p>

                                <input type="button" value="Reply"/>
                                <span><a href="/edit_comment/"{{$comment->id}}><button>Edit</button></a></span>
                            </summary>

                            <div class="comment-box">
                                <details>
                                    <summary role="button" aria-expanded="false" tabindex="0">
                                        <span>some text as the post message 2</span>
                                        <p>Commented on: 2023/08/29</p>
                                        <p>Author: Author 2</p>

                                        <input type="button" value="Reply"/>
                                        <span><a href="/edit_comment/"{{$comment->id}}><button>Edit</button></a></span>
                                    </summary>
                                </details>
                            </div>

                        </details>
                    </div>

                @endforeach
            @endif

        </div>
    </div>
@endsection
