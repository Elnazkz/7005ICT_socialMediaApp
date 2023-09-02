@extends('layouts/master')

@section('title')
    Create Post
@endsection

@section('html_css')
    <link rel="stylesheet" href="{{ asset('css/home_html.css') }}">
@endsection

@section('body')
    <div>
        <h2>Create a Post</h2>

        <form action="{{ url('create_post') }}" method="post">
            @csrf
            <div style="margin-bottom: 10px;">
                <label for="user_name">User Name:</label><br>
                <input type="text" id="user_name" name="user_name" class="@error('user_name') is-invalid @enderror" value="{{ old('user_name') }}">
                @error('user_name')
                <div>{{$message}}</div>
                @enderror
            </div>
            <div style="margin-bottom: 10px;">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" class="@error('title') is-invalid @enderror" value="{{ old('title') }}">
                @error('title')
                <div>{{$message}}</div>
                @enderror
            </div>
            <div style="margin-bottom: 10px;">
            Message:<br>
            <textarea name="message" rows="4" cols="50" class="@error('message') is-invalid @enderror">{{ old('message') }}</textarea>
            @error('message')
            <div>{{$message}}</div>
            @enderror
            </div>
            <br><br>
            <div style="margin-bottom: 10px;">
            <button type="submit">Submit</button>
            </div>
        </form>
    </div>
    </div>
@endsection
