<!DOCTYPE html>
<html lang="zh-CN">
<head>

    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title itemprop="name">Akina | Born for design</title>

    <meta name="keywords" content="akina博客,Akina,akina主题,fuzzz主题" />
    <meta name="description" content="Born for design" />

    <!-- Styles -->
    <link href="/css/web.css" rel="stylesheet">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>

<body class="home blog custom-background hfeed">

<!-- 移动端导航 -->
<div id="mo-nav">
    <ul id="menu-home" class="menu"><li><a href="{{URL::route('home')}}">首页</a></li>
        <li><a href="http://www.akina.pw/archives">归档</a></li>
        <li><a href="http://www.akina.pw/links">邻居</a></li>
        <li><a href="http://www.akina.pw/about">关于我</a></li>
        <li><a href="#">作品</a>
            <ul class="sub-menu">
                <li><a href="http://www.akina.pw/archives/category/theme">主题</a></li>
                <li><a href="http://www.akina.pw/archives/category/myworks">My Works</a></li>
                <li><a href="http://www.akina.pw/archives/category/%e6%91%84%e5%bd%b1">摄影</a></li>
            </ul>
        </li>
        <li><a href="http://www.akina.pw/themeakina">Akina theme</a></li>
    </ul>		</div>

<div class="openNav">
    <div class="iconflat">
        <div class="icon"></div>
    </div>
    <div class="site-branding">
        <!-- 如果设置logo则显示，反之显示博客名 -->
        <div class="site-title"><a href="{{URL::route('home')}}" ><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akina3.png"></a></div>

        <!-- logo end -->
    </div><!-- .site-branding -->
</div>


<div id="page" class="site wrapper">

    <header class="site-header" role="banner">
        <div class="site-top">
            <div class="site-branding">
                <!-- 如果设置logo则显示，反之显示博客名 -->
                <div class="site-title"><a href="{{URL::route('home')}}" >蜗牛笔记</a></div>

                <!-- logo end -->

            </div><!-- .site-branding -->

            <div class="searchbox">
                <i class="iconfont js-toggle-search iconsearch">&#xe603;</i>
            </div>

            <div class="lower">
                <nav>
                    <ul id="menu-home-1" class="menu"><li><a href="http://www.akina.pw/home">首页</a></li>
                        <li><a href="http://www.akina.pw/archives">归档</a></li>
                        <li><a href="http://www.akina.pw/links">邻居</a></li>
                        <li><a href="http://www.akina.pw/about">关于我</a></li>
                        <li><a href="http://www.akina.pw/themeakina">Akina theme</a></li>
                    </ul>				<i class="iconfont show-nav">&#xe613;</i>
                </nav><!-- #site-navigation -->
            </div>

        </div>
    </header><!-- #masthead -->


    <div class="blank"></div>


    <div class="headertop">


        <div id="content" class="site-content">
        @yield('content')

        </div><!-- #content -->

        <footer id="colophon" class="site-footer" role="contentinfo">
            <div class="site-info">
                Copyright © 2017 by Akina . All rights reserved.			<span class="sep"> | </span>
                <!-- ！！！！！！！！！！！！请尊重作者，此主题免费，请不要修改版权，谢谢 -->
                Theme: Akina by <a href="http://www.akina.pw" rel="designer">Fuzzz</a>.			<div class="footertext">
                    <p>Carpe Diem and Do what I like</p>
                </div>
            </div><!-- .site-info -->
        </footer><!-- #colophon -->


        <a href="#" class="cd-top"></a>

        <!-- search start -->
        <form class="js-search search-form search-form--modal" method="get" action="http://www.akina.pw" role="search">
            <div class="search-form__inner">
                <div>
                    <p class="micro mb-">你想搜索什么...</p>
                    <i class="iconfont">&#xe603;</i>
                    <input class="text-input" type="search" name="s" placeholder="搜索...">
                </div>
            </div>
        </form>
        <!-- search end -->


                </div>


    <script src="/js/web.js"></script>
</body>
</html>
