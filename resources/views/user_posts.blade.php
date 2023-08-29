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
            <div class="post-box">
                @if($user_id == '3000')
                    <h2 class="post-title"><a href="{{ url('/post_details/110') }}">Post Title 1</a></h2>
                @elseif($user_id == '3010')
                    <h2 class="post-title"><a href="{{ url('/post_details/120') }}">Post Title 2</a></h2>
                @else
                @endif
            </div>
        </div>
    </div>
@endsection
