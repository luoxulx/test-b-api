<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="Free Coding">
    <meta name="description" content="Strive to be an American, 我就是喜欢🇺🇸，随你怎么喷">

    <link href="{{ asset('favicon.ico') }}" rel='shortcut icon' type='image/x-icon'>
    <link rel="stylesheet" href="{{ mix('/css/default.css') }}">
    <link href="https://cdn.bootcss.com/font-awesome/5.8.1/css/all.min.css" rel="stylesheet">
    <title>@yield('metaTitle', 'Frankenstein 14k - Personal')</title>
</head>
<body data-spy="scroll" data-target=".navbar" class="has-loading-screen">
    <div id="front">
        @yield('main')
    </div>
<script src="{{ mix('/js/default.js') }}" type="text/javascript"></script>
<script>
  (function(){if(document.getElementsByClassName("ts-full-screen").length){document.getElementsByClassName("ts-full-screen")[0].style.height=window.innerHeight+"px"}})();
</script>
</body>
</html>
