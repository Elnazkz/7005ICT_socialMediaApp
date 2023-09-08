@extends('layouts/master')

@section('title')
    Edit Post
@endsection

@section('bodyTitle')

@endsection


@section('body')
    <form action="{{ url('post_edit') }}" method="post">
        @csrf

        <input type="hidden" name="pid" value="{{ $post->pid }}">
        <input type="hidden" name="uid" value="{{ $post->uid }}">
        <input type="hidden" name="name" value="{{ $post->name }}">

        <div class="page-desc1">
            <h2>Edit Post Details</h2>
            <input class="button push-left-btn" type="submit" value="Apply">
            <a class="button" href="{{ url('/post_details/' . $post->pid) }}">Cancel</a>
        </div>
        <hr class="hr-page">

        <div class="data-list">

            <div class="card-box">
                <div><label class="post-title" for="post_title">Post Title</label></div>
                <div><input class="post-title" type="text" id="post_title" name="title" value="{{ $post->title }}">
                </div>
                @error('title')
                <div class="is-invalid">{{$message}}</div>
                @enderror
                <br>

                <div><label class="post-message" for="post_message">Post Message</label></div>
                <div>
                    <textarea class="post-message" id="post_message" name="message">{{ $post->message }}</textarea>
                    @error('message')
                    <div class="is-invalid">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <br>
        </div>
    </form>
@endsection
