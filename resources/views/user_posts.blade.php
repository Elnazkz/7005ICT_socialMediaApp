@extends('layouts/master')

@section('title')
    User Posts
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')
    <div class="top_div">
        <h2>User Posts</h2>
        <p>User Id: {{ $user_id }}</p>

        <div class="post-list">
            @if($user_id == '3000')
                <div class="post-box">
                    <h2 class="post-title"><a href="{{ url('/post_details/110') }}">Post Title 1</a></h2>
                    <span>No of Comments: 2</span>
                </div>
                <div class="post-box">
                    <h2 class="post-title"><a href="{{ url('/post_details/130') }}">Post Title 3</a></h2>
                    <span>No of Comments: 1</span>
                </div>
            @elseif($user_id == '3010')
                <div class="post-box">
                    <h2 class="post-title"><a href="{{ url('/post_details/120') }}">Post Title 2</a></h2>
                    <span>No of Comments: 1</span>
                </div>
            @else
            @endif
        </div>
    </div>
@endsection
