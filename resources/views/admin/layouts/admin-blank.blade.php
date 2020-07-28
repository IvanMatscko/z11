<!doctype html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Z11 Admin Panel</title>

    <!-- Scripts -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app-dark.css" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="app">
        @yield('admin-header')
        @yield('admin-content')
        @yield('admin-footer')
    </div>
</body>
</html>
