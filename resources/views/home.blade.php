@extends('layouts.app')

@section('content')

        <!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title itemprop="name">Akina | Born for design</title>

    <meta name="keywords" content="akina博客,Akina,akina主题,fuzzz主题" />
    <meta name="description" content="Born for design" />

    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel='stylesheet' id='akina-style-css'  href='http://www.akina.pw/wp-content/themes/akina/style.css?ver=4.7.1' type='text/css' media='all' />
    <link rel='https://api.w.org/' href='http://www.akina.pw/wp-json/' />
    <style type="text/css">
        .site-top ul {
            opacity: 1 !important;
        }
        .site-top .show-nav {
            display:none !important;
        }














        #centerbg {
            background-image: url(http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2017/01/hello2017-1.jpg)
        }

        .post-more i , .author-profile i , .sub-text , .we-info a , span.sitename , #pagination a:hover{ color: #FFBE5B }
        .feature i , .feature-title span , .download , ::-webkit-scrollbar-thumb , .navigator i:hover , .links ul li:before , .ar-time i , span.ar-circle , .object , #progress{ background: #FFBE5B }
        .download , .navigator i:hover , .link-title , .links ul li:hover ,#pagination a:hover { border-color: #FFBE5B }
        .entry-content a:hover , .site-info a:hover , .comment h4 a:hover , .site-top ul li a:hover , .entry-title a:hover , #archives-temp h3 , span.page-numbers.current , .sorry li a:hover , .site-title a:hover{ color: #FFBE5B }



    </style>
    <style type="text/css" id="custom-background-css">
        body.custom-background { background-image: url("http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/bodybg.jpg"); background-position: left top; background-size: auto; background-repeat: repeat; background-attachment: scroll; }
    </style>
    <link rel="icon" href="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akinafa.jpg" sizes="32x32" />
    <link rel="icon" href="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akinafa.jpg" sizes="192x192" />
    <link rel="apple-touch-icon-precomposed" href="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akinafa.jpg" />
    <meta name="msapplication-TileImage" content="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akinafa.jpg" />

</head>

<body class="home blog custom-background hfeed">
<!-- preloader -->
<div id="preloader">
    <div id="preloader-inner"></div>
</div>
<!-- 顶部加载条 -->
<div id="progress">
</div>
<!-- 移动端导航 -->
<div id="mo-nav">
    <ul id="menu-home" class="menu"><li><a href="http://www.akina.pw/home">首页</a></li>
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
        <div class="site-title"><a href="http://www.akina.pw" ><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akina3.png"></a></div>

        <!-- logo end -->
    </div><!-- .site-branding -->
</div>

<div id="page" class="site wrapper">

    <header class="site-header" role="banner">
        <div class="site-top">
            <div class="site-branding">
                <!-- 如果设置logo则显示，反之显示博客名 -->
                <div class="site-title"><a href="http://www.akina.pw" ><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akina3.png"></a></div>

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
                        <li><a href="#">作品</a>
                            <ul class="sub-menu">
                                <li><a href="http://www.akina.pw/archives/category/theme">主题</a></li>
                                <li><a href="http://www.akina.pw/archives/category/myworks">My Works</a></li>
                                <li><a href="http://www.akina.pw/archives/category/%e6%91%84%e5%bd%b1">摄影</a></li>
                            </ul>
                        </li>
                        <li><a href="http://www.akina.pw/themeakina">Akina theme</a></li>
                    </ul>				<i class="iconfont show-nav">&#xe613;</i>
                </nav><!-- #site-navigation -->
            </div>

        </div>
    </header><!-- #masthead -->


    <div class="blank"></div>


    <div class="headertop">
        <!-- #imgbox -->
        <div id="centerbg">
            <div class="slant-left"></div>
            <div class="slant-right"></div>
            <div class="focusinfo">
                <div class="header-tou"><a href="http://www.akina.pw" ><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/akinadeaava.jpg"></a></div>

                <div class="header-info">
                    <p>以此为傲 ，以此谋生， 以此热爱且不忘初衷</p>
                </div>

                <div class="top-social">

                    <li><a href="http://weibo.com/fuzzz" target="_blank" class="social-sina" title="sina"><img src="http://www.akina.pw/wp-content/themes/akina/images/sina.png"/></a></li>

                    <li class="qq"><a href=""><img src="http://www.akina.pw/wp-content/themes/akina/images/qq.png"/></a>
                        <div class="qqInner">
                            444233806			</div>
                    </li>



                    <li><a href="http://space.bilibili.com/15650984/#!/index" target="_blank" class="social-bili" title="bili"><img src="http://www.akina.pw/wp-content/themes/akina/images/bilibili.png"/></a></li>



                </div>
            </div>

        </div>















        <!-- #imgbox -->
    </div>

    <div id="content" class="site-content">



        <div class="notice">
            <i class="iconfont">&#xe607;</i> :
            <div class="notice-content">
                我22号已经回家啦！不会回复大家了~ 预祝大家新年快乐！ 来年期待新主题！		</div>
        </div>

        <div class="top-feature">
            <h1 class="fes-title">聚焦</h1>
            <div class="feature-content">
                <li class="feature-1"><a href="http://www.akina.pw/themeakina" target="_blank"><div class="feature-title"><span class="foverlay">Akina主题下载</span></div><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/05/screenshot.jpg"></a></li>
                <li class="feature-2"><a href="http://www.akina.pw/10/" target="_blank"><div class="feature-title"><span class="foverlay">Akina使用说明及反馈</span></div><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/05/advice.jpg"></a></li>
                <li class="feature-3"><a href="#" target="_blank"><div class="feature-title"><span class="foverlay">MY WOEKS</span></div><img src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/07/myworks.jpg"></a></li>
            </div>
        </div>


        <div id="primary" class="content-area">
            <main id="main" class="site-main" role="main">
                <h1 class="main-title">近况</h1>

                <article class="post post-list withoutimg" itemscope="" itemtype="http://schema.org/BlogPosting">
                    <div class="polist-con">
                        <h1 class="entry-title"><a href="http://www.akina.pw/archives/373">Akina的那些事</a></h1>
                        <div class="p-time">
                            <i class="iconfont hotpost">&#xe618;</i>
                            <i class="iconfont">&#xe604;</i> 2016-12-18	  </div>
                        <p>2015年年底
                            我误打误撞认识了wordpress
                            经过从小白到自己写主题
                            一个人自学  一个人摸索
                            时隔数月  我很高兴
                            认识了你们  来到Akina的成员和朋友们
                            &nbsp;
                            也...</p>
                    </div>


                    <footer class="entry-footer">
                        <div class="post-more">
                            <a href="http://www.akina.pw/archives/373"><i class="iconfont">&#xe61c;</i></a>
                        </div>
                        <div class="info-meta">
                            <div class="comnum">
                                <span><i class="iconfont">&#xe610;</i> <a href="http://www.akina.pw/archives/373#comments">54 条评论</a></span>
                            </div>
                            <div class="views">
                                <span><i class="iconfont">&#xe614;</i> 5,991 热度</span>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->

                    <hr>
                </article><!-- #post-## -->


                <article class="post post-list withoutimg" itemscope="" itemtype="http://schema.org/BlogPosting">
                    <div class="polist-con">
                        <h1 class="entry-title"><a href="http://www.akina.pw/archives/371">出售一个自用衡天香港VPS，有意者QQ联系我</a></h1>
                        <div class="p-time">
                            <i class="iconfont hotpost">&#xe618;</i>
                            <i class="iconfont">&#xe604;</i> 2016-11-29	  </div>
                        <p>最近买了三年的腾讯云，准备把网站正规化，域名都备案了，于是想把前几天买的香港VPS给卖了，
                            香港VPS参数
                            1g内存 1cpu  20g硬盘   每月300g流量  用了不到一...</p>
                    </div>


                    <footer class="entry-footer">
                        <div class="post-more">
                            <a href="http://www.akina.pw/archives/371"><i class="iconfont">&#xe61c;</i></a>
                        </div>
                        <div class="info-meta">
                            <div class="comnum">
                                <span><i class="iconfont">&#xe610;</i> <a href="http://www.akina.pw/archives/371#comments">19 条评论</a></span>
                            </div>
                            <div class="views">
                                <span><i class="iconfont">&#xe614;</i> 3,500 热度</span>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->

                    <hr>
                </article><!-- #post-## -->


                <article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
                    <div class="post-entry">
                        <div class="feature">
                            <a href="http://www.akina.pw/archives/363"><div class="overlay"><i class="iconfont">&#xe61e;</i></div><img width="150" height="150" src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/08/loginbg3-150x150.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /></a>
                        </div>
                        <h1 class="entry-title"><a href="http://www.akina.pw/archives/363">关于AKINA主题的更新以及各种分支</a></h1>
                        <div class="p-time">
                            <i class="iconfont hotpost">&#xe618;</i>
                            <i class="iconfont">&#xe604;</i> 2016-11-07	  </div>
                        <p>AKINA诞生也有好几个月了，然后就没有再更新了，不是我不想更新，其实真的是抽不出空
                            工作也忙，每当回到家，我都不想写代码了，只想躺着睡觉，所以请大家体...</p>



                        <footer class="entry-footer">
                            <div class="post-more">
                                <a href="http://www.akina.pw/archives/363"><i class="iconfont">&#xe61c;</i></a>
                            </div>
                            <div class="info-meta">
                                <div class="comnum">
                                    <span><i class="iconfont">&#xe610;</i> <a href="http://www.akina.pw/archives/363#comments">35 条评论</a></span>
                                </div>
                                <div class="views">
                                    <span><i class="iconfont">&#xe614;</i> 13,442 热度</span>
                                </div>
                            </div>
                        </footer><!-- .entry-footer -->
                    </div>
                    <hr>
                </article><!-- #post-## -->


                <article class="post post-list" itemscope="" itemtype="http://schema.org/BlogPosting">
                    <div class="post-entry">
                        <div class="feature">
                            <a href="http://www.akina.pw/archives/22"><div class="overlay"><i class="iconfont">&#xe61e;</i></div><img width="150" height="150" src="http://7xwpo4.com1.z0.glb.clouddn.com/wp-content/uploads/2016/05/screenshot-150x150.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" /></a>
                        </div>
                        <h1 class="entry-title"><a href="http://www.akina.pw/archives/22">Akina主题-Born for design</a></h1>
                        <div class="p-time">
                            <i class="iconfont hotpost">&#xe618;</i>
                            <i class="iconfont">&#xe604;</i> 2016-07-23	  </div>
                        <p>&nbsp;

                            说在前边
                            这个主题断断续续写了有两个月了，因为平时也很忙，只能抽时间来弄，加之我很懒，所以进度就变得无比之慢，最近我觉得得赶快把他给弄出来，...</p>



                        <footer class="entry-footer">
                            <div class="post-more">
                                <a href="http://www.akina.pw/archives/22"><i class="iconfont">&#xe61c;</i></a>
                            </div>
                            <div class="info-meta">
                                <div class="comnum">
                                    <span><i class="iconfont">&#xe610;</i> <a href="http://www.akina.pw/archives/22#comments">105 条评论</a></span>
                                </div>
                                <div class="views">
                                    <span><i class="iconfont">&#xe614;</i> 22,064 热度</span>
                                </div>
                            </div>
                        </footer><!-- .entry-footer -->
                    </div>
                    <hr>
                </article><!-- #post-## -->


                <nav class="navigator">
                    <a href="http://www.akina.pw/page/2" ><i class="iconfont">&#xe60f;</i></a>	</nav>



            </main><!-- #main -->

            <div id="pagination"><a href="http://www.akina.pw/page/2" >加载更多</a></div>

        </div><!-- #primary -->


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
</div><!-- #page -->

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

</body>
</html>

@endsection
