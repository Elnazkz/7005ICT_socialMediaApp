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
    <p>Social Media</p>
</div>
<nav class="skew-menu">
    <ul>
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('users') }}">Users</a></li>
        <li><a href="{{ url('about') }}">About</a></li>
    </ul>
</nav>

<div>
    <div class="page-desc1">
        <h2>@yield('bodyTitle')</h2>
        @yield('bodyTitleExtra')
    </div>
    <hr class="hr-page">
    @yield('body')
</div>

<div id="footer">

</div>
</body>
</html>
