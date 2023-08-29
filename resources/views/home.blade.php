@extends('layouts/master')

@section('title')
    Home
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')
    <div>
        <h2>Home</h2>
        <div class="post-list">
            <div class="post-box">
                <h2 class="post-title"><a href="{{ url('/post_details/110') }}">Post Title 1</a></h2>
                <p class="post-author">Author 1</p>
            </div>
            <div class="post-box">
                <h2 class="post-title"><a href="{{ url('/post_details/120') }}">Post Title 2</a></h2>
                <p class="post-author">Author 2</p>
            </div>
            <!-- Add more post-box elements as needed -->
        </div>
    </div>
@endsection
