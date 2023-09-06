@extends('layouts/master')

@section('title')
    Reply
@endsection


@section('body')
    <form action="{{ url('create_comment') }}" method="post">
        <input id="post_id" name="post_id" type="hidden" value="{{ $post_id }}">

        <div class="top-div">
            <div class="page-desc1">
                <h2>Reply</h2>
                <div>
                    <input class="button push-left-btn" type="submit" value="Submit">
                    <a class="button" href="{{ url('post_details/' . $post_id) }}">Cancel</a>
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

            <div class="post-list">
                <div class="post-box">
                    <div><label class="post-author" for="user_name">User Name</label></div>
                    <div><input class="post-author" type="text" id="user_name" name="user_name"
                                value="{{ old('user_name') }}"></div>
                    @error('user_name')
                    <div>{{$message}}</div>
                    @enderror

                    <div>
                        <div><label class="post-message" for="post_message">Comment Message</label></div>
                        <textarea class="post-message" id="post_message" name="message">{{ old('message') }}</textarea>
                        @error('message')
                        <div>{{$message}}</div>
                        @enderror
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </form>
@endsection
