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
                    <span>No of comments: 2</span>
                    <span><input type="button" value="Reply"/></span>
                </div>
                <p>Posted on: 2023/08/29</p>
                <p>Author: Author 1</p>
                <p>some text as the post message 1</p>
            </div>

            <div class="comment-box">
                <details>
                    <summary role="button" aria-expanded="false" tabindex="0">
                        <span>No of Comments: 2</span>
                        <input type="button" value="Reply"/>
                    </summary>
                    <p>Commented on: 2023/08/29</p>
                    <p>Author: Author 2</p>
                    <p>some text as the post message 2</p>

                    <div class="comment-box">
                        <details>
                            <summary role="button" aria-expanded="false" tabindex="0">
                                <span>No of Comments: 2</span>
                                <input type="button" value="Reply"/>
                            </summary>
                            <p>Commented on: 2023/08/29</p>
                            <p>Author: Author 2</p>
                            <p>some text as the post message 2</p>

                            <div class="comment-box">
                                <details>
                                    <summary role="button" aria-expanded="false" tabindex="0">
                                        <span>No of Comments: 0</span>
                                        <input type="button" value="Reply"/>
                                    </summary>
                                    <p>Commented on: 2023/08/29</p>
                                    <p>Author: Author 2</p>
                                    <p>some text as the post message 2</p>
                                </details>
                            </div>

                            <div class="comment-box">
                                <details>
                                    <summary role="button" aria-expanded="false" tabindex="0">
                                        <span>No of Comments: 0</span>
                                        <input type="button" value="Reply"/>
                                    </summary>
                                    <p>Commented on: 2023/08/29</p>
                                    <p>Author: Author 2</p>
                                    <p>some text as the post message 2</p>
                                </details>
                            </div>

                        </details>
                    </div>

                    <div class="comment-box">
                        <details>
                            <summary role="button" aria-expanded="false" tabindex="0">
                                <span>No of Comments: 0</span>
                                <input type="button" value="Reply"/>
                            </summary>
                            <p>Commented on: 2023/08/29</p>
                            <p>Author: Author 2</p>
                            <p>some text as the post message 2</p>
                        </details>
                    </div>

                </details>
            </div>

            <div class="comment-box">
                <details>
                    <summary role="button" aria-expanded="false" tabindex="0" >
                        <span>No of Comments: 0</span>
                        <input type="button" value="Reply">
                    </summary>
                    <p>Commented on: 2023/08/29</p>
                    <p>Author: Author 2</p>
                    <p>some text as the post message 2</p>
                </details>
            </div>

        </div>
    </div>
@endsection
