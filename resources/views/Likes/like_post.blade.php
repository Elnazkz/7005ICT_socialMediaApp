@extends('layouts/master')

@section('title')
    Like Post
@endsection

@section('bodyTitle')

@endsection

@section('body')
    <form action="{{ url('/likes/like_it/') }}" method="post">
        @csrf

        <input id="post_id" name="post_id" type="hidden" value="{{ $post[0]->id }}">

        <div class="page-desc1">
            <h2>Like Post</h2>
            <input class="button push-left-btn" type="submit" value="Like">
            <a class="button" href="{{ url('/post_details/' . $post[0]->id) }}">Cancel</a>
        </div>
        <hr class="hr-page">

        <div class="data-list">
            <div class="card-box">
                <div class="post-desc1">
                    <h2>{{ $post[0]->title }}</h2>
                </div>

                <div><label class="post-author" for="user_name">User Name</label></div>
                <div style=""><input class="like-user-name" type="text" id="user_name" name="user_name"
                                     value="{{ $session_user != "" ? $session_user : old('user_name') }}"></div>
                @error('user_name')
                <div class="is-invalid">{{$message}}</div>
                @enderror
            </div>
            <br>
        </div>
    </form>
@endsection

