<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta property="token_one" content="@yield('email')">
        <meta property="token_two" content="@yield('token')">
        <meta property="token_three" content="@yield('user_id')">
        <title>Laravel</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css"/>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="app">
            <div id="innerApp">
                @yield('content')
            </div>
        </div>
        <script src="/js/app.js"></script>
    </body>
</html>