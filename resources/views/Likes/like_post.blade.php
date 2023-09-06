@extends('layouts/master')

@section('title')
    Like Post
@endsection

@section('bodyTitle')
    Like Post
@endsection

@section('body')
    <form action="{{ url('/likes/like_it/') }}" method="post">
        @csrf
        {{--    to set the id for the post which the comment is written for--}}

        <input id="post_id" name="post_id" type="hidden" value="{{ $post[0]->id }}">

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
            if (isset($session_user)) {
                $name_val = $session_user != "" ? $input_val = $session_user : $input_val = old('user_name');
            }
        @endphp

        <div class="post-list">
            <div class="post-box">
                <div class="post-desc1">
                    <h2>{{ $post[0]->title }}</h2>
                    <button class="button" type="submit">Like</button>
                </div>

                <div><label class="post-author" for="user_name">User Name</label></div>
                <div style=""><input class="like-user-name" type="text" id="user_name" name="user_name"
                            value="{{ $name_val }}"></div>
                @error('user_name')
                <div>{{$message}}</div>
                @enderror
            </div>
            <br>
        </div>
    </form>
@endsection

