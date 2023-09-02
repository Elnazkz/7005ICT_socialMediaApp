@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')

    <div>
        <h2 class="inline-elem">Post Details</h2>
        <span class="prepend-20px">Post Id = {{ $post_id }}</span>
        <div>
            <div class="post-box">
                <div>
                    <span><h2>Post Title 1</h2></span>
                    <span><input type="button" value="Reply"/></span>
                    <span><a href="/edit_post/110"><button>Edit</button></a></span>
                </div>
                <p>Posted on: 2023/08/29</p>
                <p>Author: Author 1</p>
                <p>some text as the post message 1</p>
            </div>

            <div class="comment-box">
                <details>
                    <summary role="button" aria-expanded="false" tabindex="0">
                        <span>some text as the post message 2 (1 reply)</span>
                        <p>Commented on: 2023/08/29</p>
                        <p>Author: Author 2</p>

                        <input type="button" value="Reply"/>
                        <span><a href="/edit_comment/3000"><button>Edit</button></a></span>
                    </summary>

                    <div class="comment-box">
                        <details>
                            <summary role="button" aria-expanded="false" tabindex="0">
                                <span>some text as the post message 2</span>
                                <p>Commented on: 2023/08/29</p>
                                <p>Author: Author 2</p>

                                <input type="button" value="Reply"/>
                                <span><a href="/edit_comment/3010"><button>Edit</button></a></span>
                            </summary>
                        </details>
                    </div>

                </details>
            </div>

            <div class="comment-box">
                <details>
                    <summary role="button" aria-expanded="false" tabindex="0" >
                        <span>some text as the post message 2</span>
                        <p>Commented on: 2023/08/29</p>
                        <p>Author: Author 2</p>

                        <input type="button" value="Reply">
                        <span><a href="/edit_comment/3020"><button>Edit</button></a></span>
                    </summary>

                </details>
            </div>

        </div>
    </div>
@endsection
