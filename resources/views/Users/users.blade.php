@extends('layouts/master')

@section('title')
    Users
@endsection


@section('body')
    <div>
        <h2>Users</h2>

        <div class="post-list">
            @foreach($users as $user)
                <div class="post-box">
                    <span><h2 class="post-title"><a href="{{ url('posts/' . $user->id) }}">{{ $user->name }}</a></h2></span>
                    <span>No of Posts: {{ \App\Http\Controllers\MyUserController::count_user_posts($user->id) }}</span>
                </div>
            @endforeach
        </div>
    </div>
@endsection
