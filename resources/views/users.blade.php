@extends('layouts/master')

@section('title')
    Users
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')
    <div>
        <h2>Users</h2>

        <div class="post-list">
            <div class="post-box">
                <span><h2 class="post-title"><a href="{{ url('/posts/3000') }}">user 1</a></h2></span>
                <span>No of Posts: 2</span>
            </div>
            <div class="post-box">
                <span><h2 class="post-title"><a href="{{ url('/posts/3010') }}">user 2</a></h2></span>
                <span>No of Posts: 1</span>
            </div>
            <!-- Add more post-box elements as needed -->
        </div>
    </div>
@endsection
