<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('l.main_title') }}</title>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{env('GTAG_CONFIG')}}"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', '{{env('GTAG_CONFIG')}}');
    </script>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/all.min.css">
    <link rel="stylesheet" href="/css/jquery.jscrollpane.css">
    <link rel="stylesheet" href="/css/slick.css">
    <link rel="stylesheet" href="/css/jquery.modal.min.css">
    <link rel="stylesheet" href="/css/jquery-ui.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/result.css">
    <link rel="stylesheet" href="/css/media.css">
    <link rel="apple-touch-icon" sizes="180x180" href="/img/icon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/img/icon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/img/icon/favicon-16x16.png">
    <link rel="manifest" href="/img/icon/z11.webmanifest">
    <script src="/js/jquery.js"></script>
    <script src="/js/raphael.js"></script>
    <script src="/js/popup.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/1.7.3/socket.io.min.js"></script>
</head>
<body>
<div class="past-popup-back"></div>
<style type="text/css">#hellopreloader>p{display:none;}#hellopreloader_preload{display: block;position: fixed;z-index: 99999;top: 0;left: 0;width: 100%;height: 100%;min-width: 1000px;background: #2D2D32 url(/img/tail-spin.svg) center center no-repeat;background-size:41px;}</style>
<div id="hellopreloader"><div id="hellopreloader_preload"></div></div>

    @yield('header')
    @yield('content')
    @yield('footer')

    @yield('scripts')
</body>
</html>
