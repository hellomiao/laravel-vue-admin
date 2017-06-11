<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')|{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/web.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


        window.Name='{!! config('app.name', 'Laravel') !!}';




    </script>
</head>
<body class="sidebar-mini skin-purple-light">
<div id="app"></div>
<script src="/js/web.js"></script>
</body>
</html>