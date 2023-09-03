@extends('layouts/master')

@section('title')
    Edit Comment
@endsection


@section('body')
    <div class="top-div">
        <h2>Edit Comment</h2><span>Post Id = {{ $comment_id }}</span>

        <form>
            <div class="comment-box">
                <label for="comment_message">Comment Message</label><br>
                <textarea rows="5" cols="50" id="comment_message" name="comment_message">some text as the post message for test</textarea><br><br>
                <input type="submit" value="Apply">
                <input type="submit" value="Cancel">
            </div>
        </form>

    </div>
@endsection
