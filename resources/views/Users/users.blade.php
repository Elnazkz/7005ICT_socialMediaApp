@extends('layouts/master')

@section('title')
    Users
@endsection

@section('body')
    <div class="page-desc1">
        <h2>Users</h2>
    </div>
    <hr class="hr-page">

    <div class="data-list">
        @forelse($users as $user)
            <div class="card-box">
                <span><h2 class="post-title"><a href="{{ url('posts/' . $user->id) }}">{{ $user->name }}</a></h2></span>
                <br>
                <span>No of Posts: {{ \App\utils\MyUserController::count_user_posts($user->id) }}</span>
            </div>
        @empty
            <h2>No users added yet!</h2>
        @endforelse
    </div>
@endsection
