<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="stylesheet" href="{{ mix('css/b.css') }}">

    <title>@yield('title', config('app.name'))</title>
</head>
<body>
<div id="b" class="container-fluid">
    @yield('main')
</div>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script type="text/javascript" src="{{ mix('js/b.js') }}"></script>
@include('front.layout.baidu')
</body>
</html>
