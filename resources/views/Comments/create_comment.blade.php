@extends('layouts/master')

@section('title')
Create Comment
@endsection


@section('body')
<div>
    <h2>Create a Post</h2>

    <form action="{{ url('create_comment') }}" method="post">
        @csrf

        <input id="post_id" name="post_id" type="hidden" value="{{ $post_id }}"

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div style="margin-bottom: 10px;">
            <label for="user_name">User Name:</label><br>
            <input type="text" id="user_name" name="user_name" class="@error('user_name') is-invalid @enderror" value="{{ old('user_name') }}">
            @error('user_name')
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
