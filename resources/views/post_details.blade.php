@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')

    <div class="top-div">
        <h2>Post Details</h2><span>Post Id = {{ $post_id }}</span>
        <div class="post-list">
            <div class="post-box">
                <div class="post-box-title">
                    <h2 class="post-title">Post Title 1</h2>
                    <input type="button" value="Reply"/>
                </div>
                <p class="post-date">Posted on: 2023/08/29</p>
                <p class="post-author">Author: Author 1</p>
                <p class="post-content">some text as the post message 1</p>
            </div>
            <div class="comment-list">
                <section class="comment-box accordion">
                    <input type="checkbox" name="collapse1" id="handle1" checked="checked">
                    <h2 class="handle comment-title"><label for="handle1"> Comment1 on post 1</label></h2>
                    <input type="button" value="Reply"/>
                    <div class="content">
                        <p>Commented on: 2023/08/29</p>
                        <p>Author: Author 1</p>
                        <p>some text as the post message 1</p>
                    </div>

                    <section class="comment-box accordion">
                        <input type="checkbox" name="collapse4" id="handle4">
                        <h2 class="handle comment-title"><label for="handle4"> sub Comment1 for comment 1</label></h2>
                        <input type="button" value="Reply"/>
                        <div class="content">
                            <p>Commented on: 2023/08/29</p>
                            <p>Author: Author 10</p>
                            <p>some text as the post sub comment 1</p>
                        </div>
                    </section>

                </section>
                <section class="comment-box accordion">
                    <input type="checkbox" name="collapse2" id="handle2">
                    <h2 class="handle comment-title"><label for="handle2"> Comment2 on post 1</label></h2>
                    <input type="button" value="Reply"/>
                    <div class="content">
                        <p>Commented on: 2023/08/29</p>
                        <p>Author: Author 2</p>
                        <p>some text as the post message 2</p>
                    </div>
                </section>
                <section class="comment-box accordion">
                    <input type="checkbox" name="collapse3" id="handle3">
                    <h2 class="handle comment-title"><label for="handle3">Comment3 on post 1</label></h2>
                    <input type="button" value="Reply"/>
                    <div class="content">
                        <p>Commented on: 2023/08/29</p>
                        <p>Author: Author 3</p>
                        <p>some text as the post message 3</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
