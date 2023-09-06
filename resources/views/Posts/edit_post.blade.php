@extends('layouts/master')

@section('title')
    Edit Post
@endsection

@section('bodyTitle')
    Edit Post Details
@endsection


@section('body')
    <form action="{{ url('post_edit') }}" method="post">
        <input type="hidden" name="pid" value="{{ $post->pid }}" >
        <input type="hidden" name="uid" value="{{ $post->uid }}" >
        <input type="hidden" name="name" value="{{ $post->name }}">

        <div class="post-list">
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

            <div class="post-box">
                <div><label class="post-title" for="post_title">Post Title</label></div>
                <div><input class="post-title" type="text" id="post_title" name="title" value="{{ $post->title }}"></div>
                @error('title')
                <div class="">{{$message}}</div>
                @enderror
                <br>

                <div><label class="post-message" for="post_message">Post Message</label></div>
                <div>
                    <textarea class="post-message" id="post_message" name="message">{{ $post->message }}</textarea>
                    @error('message')
                    <div class="alert alert-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <br>
            <input class="button push-left-btn" type="submit" value="Apply">
            <a class="button" href="{{ url('/post_details/' . $post->pid) }}">Cancel</a>
        </div>
    </form>
@endsection
