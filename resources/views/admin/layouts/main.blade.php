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
    <link href="/css/admin/admin.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};

    </script>
</head>
<body class="skin-red sidebar-mini">
<div class="wrapper" id="app">
    @include('admin.layouts.header')
    @include('admin.layouts.sidebar')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('pageHeader')
                <small>@yield('pageDesc')</small>
            </h1>

                {!!Breadcrumbs::render(Route::currentRouteName()) !!}


        </section>

        <!-- Main content -->
        <section class="content">
            <router-view></router-view>
            @yield('content')
                    <!-- Your Page Content Here -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<script src="/js/admin/admin.js"></script>
</body>
</html>