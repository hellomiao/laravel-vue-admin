<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title itemprop="name">@yield('title','蜗牛笔记')</title>
    <meta name="keywords" content="网易云热评,php"/>
    <meta name="description" content="heypigg"/>
    <link rel="shortcut icon" href="/favicon.ico" />

    <!-- Styles -->
    <link href="/css/web.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<?php
$categoryMenu = Request::get('CategoryData');

?>

<body class="home blog custom-background hfeed">

<!-- 移动端导航 -->
<div id="mo-nav">
    <ul id="menu-home" class="menu">
        <li><a href="{{URL::route('home')}}">首页</a></li>
        @foreach($categoryMenu as $k=>$v)
            <li><a href="{{URL::route('category',['category'=>$k])}}">{{$v}}</a></li>
        @endforeach
    </ul>
</div>

<div class="openNav">
    <div class="iconflat">
        <div class="icon"></div>
    </div>
    <div class="site-branding">
        <!-- 如果设置logo则显示，反之显示博客名 -->
        <div class="site-title"><a href="{{URL::route('home')}}"><img src="{{URL::asset('/images/logo.png')}}"></a>
        </div>

        <!-- logo end -->
    </div><!-- .site-branding -->
</div>


<div id="page" class="site wrapper">

    <header class="site-header" role="banner">
        <div class="site-top">
            <div class="site-branding">
                <!-- 如果设置logo则显示，反之显示博客名 -->
                <div class="site-title"><a href="{{URL::route('home')}}"><img src="{{URL::asset('/images/logo.png')}}"><span class="txt">蜗牛笔记</span></a></div>

                <!-- logo end -->

            </div><!-- .site-branding -->

            <div class="searchbox">
                <i class="iconfont js-toggle-search iconsearch">&#xe603;</i>
            </div>

            <div class="lower">
                <nav>
                    <ul id="menu-home-1" class="menu">
                        <li><a href="{{URL::route('home')}}">首页</a></li>
                        @foreach($categoryMenu as $k=>$v)
                            <li><a href="{{URL::route('category',['category'=>$k])}}">{{$v}}</a></li>
                        @endforeach

                    </ul>
                    <i class="iconfont show-nav">&#xe613;</i>
                </nav><!-- #site-navigation -->
            </div>

        </div>
    </header><!-- #masthead -->


    <div class="blank"></div>


    <div class="headertop">


        <div id="content" class="site-content">
            @yield('content')

        </div><!-- #content -->

        <footer class="site-footer" role="contentinfo">
            <div class="site-info">
                Copyright © 2017 by heypigg . All rights reserved.
                <div class="footertext">
                    <p>记录生活的每一天</p>
                </div>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->


    </div>

</div>
<script src="/js/web.js"></script>
</body>
</html>
