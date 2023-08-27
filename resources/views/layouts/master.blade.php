<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf8>
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Include your other CSS and JavaScript files here -->
</head>
<body>
<nav class="navigation">
    <ul>
        <li>
            <img src="{{URL::asset('/images/user.png')}}" style="margin-bottom: 20px; margin-top: 20px" width="200" height="200" alt="user_image">
        </li>
        <li><a href="/home">Home</a></li>
        <li><a href="/users">Users</a></li>
        <li><a href="/posts">Posts</a></li>
        <li><a href="/create-post">Create a post</a></li>
    </ul>
</nav>

@yield('body')

</body>
</html>
