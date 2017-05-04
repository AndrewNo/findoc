<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('fonts//font-awesome-4.7.0/css/font-awesome.min.css') }}">
    <title>Document</title>
    @yield('links')
</head>
<body>
<header>
    <div class="wrapper">
        <ul class="nav">
            <li @if(\Illuminate\Support\Facades\Request::is('/')) class="active" @endif><a href="/" >Home</a></li>
            <li @if(\Illuminate\Support\Facades\Request::is('accounts')) class="active" @endif><a
                        href="/accounts">Accounts</a></li>
            <li @if(\Illuminate\Support\Facades\Request::is('incomes')) class="active" @endif><a
                        href="/incomes">Income</a></li>
            <li @if(\Illuminate\Support\Facades\Request::is('outcomes')) class="active" @endif><a href="/outcomes">Outcome</a></li>
            <li @if(\Illuminate\Support\Facades\Request::is('transfers')) class="active" @endif><a href="/transfers">Transfers</a></li>
        </ul>
    </div>
</header>
<div class="wrapper">
    @yield('content')
</div>
</body>
</html>