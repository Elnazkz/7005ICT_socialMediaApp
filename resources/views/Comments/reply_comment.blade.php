@extends('layouts/master')

@section('title')
    Reply
@endsection

@section('body')
    <form action="{{ url('create_comment') }}" method="post">
        @csrf

        {{--    to set the id for the post which the comment is written for--}}
        <input id="post_id" name="post_id" type="hidden" value="{{ $post_id }}">
        <input id="parent_id" name="parent_id" type="hidden" value="{{ $parent_id }}">

        <div class="page-desc1">
            <h2>Reply</h2>
            <input class="button push-left-btn" type="submit" value="Submit">
            <a class="button" href="{{ url('post_details/' . $post_id) }}">Cancel</a>
        </div>
        <hr class="hr-page">

        <div class="data-list">
            <div class="card-box">
                <div><label class="post-author" for="user_name">User Name</label></div>
                <div><input class="post-title" type="text" id="user_name" name="user_name"
                            value="{{ $session_user != "" ? $session_user : old('name') }}"></div>
                @error('user_name')
                <div class="is-invalid">{{$message}}</div>
                @enderror

                <div>
                    <div><label class="post-message" for="post_message">Comment Message</label></div>
                    <textarea class="post-message" id="post_message" name="message">{{ old('message') }}</textarea>
                    @error('message')
                    <div class="is-invalid">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <br>
        </div>
    </form>
@endsection
