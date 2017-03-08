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
    <link href="/css/admin.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};


        window.Name='{!! config('app.name', 'Laravel') !!}';

        window.User = {!! auth('admin')->user() !!};

        window.Permissions = {!!$permissions!!};

        window.MsgNum = {!!$msgNum!!};

    </script>
</head>
<body class="skin-red sidebar-mini">
<div id="app"></div>
<script src="/js/admin/admin.js"></script>
</body>
</html>