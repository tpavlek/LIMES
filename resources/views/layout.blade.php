<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield("title", '')</title>

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css" />
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js" integrity="sha384-8iPTk2s/jMVj81dnzb/iFR2sdA7u06vHJyyLlAd4snFpCl/SnyUjRrbdJsw1pGIl" crossorigin="anonymous"></script>
</head>
<body>
<div id="app" class="h-full w-full bg-greengrey-lighter font-sans">
    @yield('content')
</div>


<script src="/js/app.js"></script>
</body>
</html>
