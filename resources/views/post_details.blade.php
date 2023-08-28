@extends('layouts/master')

@section('title')
    Post Details
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/post_details_html.css') }}">
@endsection

@section('body')
    <div>
        <h2>Post Details</h2>
        <p>Post Id = {{ $post_id }}</p>
    </div>
@endsection
