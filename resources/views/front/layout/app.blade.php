<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/fontawesome/css/all.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/default.css') }}">

    <title>Frankenstein - Personal Portfolio Template</title></head>
<body data-spy="scroll" data-target=".navbar" class="has-loading-screen">
    <div id="index">
        @yield('main')
    </div>
<script src="{{ mix('/js/default.js') }}" type="text/javascript"></script>
<script>
  (function(){if(document.getElementsByClassName("ts-full-screen").length){document.getElementsByClassName("ts-full-screen")[0].style.height=window.innerHeight+"px"}})();
</script>

</body>
</html>
