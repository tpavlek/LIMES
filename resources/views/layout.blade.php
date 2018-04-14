<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="socrata-token" content="{{ env("SOCRATA_API_KEY") }}">

    <title>@yield("title", '')</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
<div id="app" class="h-full w-full bg-greengrey-lighter font-sans">
    <nav class="bg-green flex shadow">
        <div class="flex-grow p-4 text-white">
            <a class="h-full text-white no-underline" href="{{ URL::to('/') }}"><span class="far fa-lemon"></span></a>
        </div>

        @if(Auth::check())
            @if (Auth::user()->isAdmin())
                <div class="text-white p-4">
                    <a class="text-white no-underline" href="{{ URL::route('admin.index') }}"><span class="fas fa-unlock"></span></a>
                </div>
            @endif
            <div class="text-white p-4">
                <a class="text-white no-underline" href="{{ URL::route('profile') }}"><span class="fas fa-user"></span> Me</a>
            </div>
        @endif

        @if (Auth::check())
            <div class="text-white p-4">
                <a class="text-white no-underline " href="{{ URL::route('logout') }}"><span class="fas fa-sign-out-alt"></span></a>
            </div>
        @else
            <div class="text-white p-4">
                <a class="text-white no-underline " href="{{ URL::route('account_connect') }}"><span class="fas fa-sign-in-alt"></span></a>
            </div>
        @endif
    </nav>
    @yield('content')
</div>


<script src="/js/app.js"></script>
</body>
</html>
