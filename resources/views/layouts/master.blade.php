<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset=utf8>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('html_css')
</head>
<body>
<div id="main_title">
    <p>IdeaZone Hub</p>
</div>
<nav class="skew-menu">
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('users') }}">Users</a></li>
        <li><a href="{{ url('about') }}">About</a></li>
    </ul>
</nav>

<br>
@yield('body')

@section('footer')
    @include('footer')
@show

{{--https://stackoverflow.com/questions/42689580/exclude-certain-part-using-layout-of-laravel--}}
{{--not showing footer in specific pages in my case About--}}

</body>
</html>
