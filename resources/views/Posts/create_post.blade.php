@extends('layouts/master')

@section('title')
    Create Post
@endsection


@section('body')
    <form action="{{ url('create_post') }}" method="post">
        <div class="top-div">
            <div class="page-desc1">
                <h2>Create a Post</h2>
                <div style="margin-bottom: 10px;">
                    <input class="button push-left-btn" type="submit" value="Create">
                    <a class="button" href="{{ url('/')}}">Cancel</a>
                </div>
            </div>
            <hr class="hr-page">

            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                $name_val = "";
                if (isset($_SESSION['session_user'])) {
                    $suser = $_SESSION['session_user'];
                    $name_val = $suser != "" ? $input_val = $suser : $input_val = old('user_name');
                }
            @endphp

            <div class="post-list">
                <div class="post-box">
                    <div><label class="post-author" for="user_name">User Name</label></div>
                    <div><input class="post-author" type="text" id="user_name" name="user_name" value="{{ $name_val }}">
                        @error('user_name')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <div><label class="post-title" for="title">Title:</label></div>
                        <div><input class="post-title" type="text" id="title" name="title" value="{{ old('title') }}">
                        </div>
                        @error('title')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                    <div>
                        <div><label class="post-message" for="post_message">Post Message</label></div>
                        <textarea class="post-message" id="post_message" name="message">{{ old('message') }}</textarea>
                        @error('message')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </form>
@endsection
