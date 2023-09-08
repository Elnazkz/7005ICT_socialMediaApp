@extends('layouts/master')

@section('title')
    Create Post
@endsection

@section('body')
    <form action="{{ url('create_post') }}" method="post">
        @csrf

        <div class="page-desc1">
            <h2>Create Post</h2>
            <input class="button push-left-btn" type="submit" value="Create">
            <a class="button" href="{{ url('/')}}">Cancel</a>
        </div>
        <hr class="hr-page">

        <div class="data-list">
            <div class="card-box">
                <div><label class="post-author" for="name">User Name</label></div>
                <div><input class="post-title" type="text" id="name" name="name"
                            value="{{ $session_user != "" ? $session_user : old('name')  }}">
                    @error('name')
                    <div class="is-invalid">{{$message}}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <div><label class="post-title" for="title">Title:</label></div>
                    <div><input class="post-title" type="text" id="title" name="title" value="{{ old('title') }}">
                    </div>
                    @error('title')
                    <div class="is-invalid">{{$message}}</div>
                    @enderror
                </div>
                <br>
                <div>
                    <div><label class="post-message" for="post_message">Post Message</label></div>
                    <textarea class="post-message" id="post_message" name="message">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="is-invalid">{{$message}}</div>
                    @enderror
                </div>
                <br><br>
            </div>
            <br>
        </div>
    </form>
@endsection
