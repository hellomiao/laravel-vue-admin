@extends('layouts.app')

@section('content')

    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">


            <article id="post-363" class="post-363 post type-post status-publish format-standard has-post-thumbnail hentry category-wordpress category-theme tag-akina tag-wordpress">
                <header class="entry-header">
                    <h1 class="entry-title">{{$articles->title}}</h1>
                    <hr>
                </header><!-- .entry-header -->

                <div class="entry-content">
                    {!! $articles->content !!}

                <footer class="post-footer">
                    <div class="post-tags">
                        <i class="iconfont">&#xe613;</i>
                        @foreach($articles->tags as $key=>$val)
                        <a href="http://www.akina.pw/archives/tag/akina" rel="tag">{{$val}}</a>
                        @endforeach
                    </div>

                    <div class="post-like">
                        <a href="javascript:;" data-action="ding" data-id="363" class="specsZan ">
                            <i class="iconfont">&#xe612;</i> <span class="count">
					10</span>
                        </a>
                    </div>

                    <div class="post-share">
                        <!-- JiaThis Button BEGIN -->
                        <div class="jiathis_style_32x32">
                            <a class="jiathis_button_qzone"></a>
                            <a class="jiathis_button_tsina"></a>
                            <a class="jiathis_button_tqq"></a>
                            <a class="jiathis_button_weixin"></a>
                            <a class="jiathis_button_renren"></a>
                            <a href="http://www.jiathis.com/share" class="jiathis jiathis_txt jtico jtico_jiathis" target="_blank"></a>
                        </div>
                        <script type="text/javascript" src="http://v3.jiathis.com/code_mini/jia.js" charset="utf-8"></script>
                        <!-- JiaThis Button END -->
                        <!-- UJian Button BEGIN -->
                        <div class="ujian-hook"></div>
                        <script type="text/javascript" src="http://v1.ujian.cc/code/ujian.js"></script>
                        <!-- UJian Button END -->

                    </div>
                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->





        </main><!-- #main -->
    </div><!-- #primary -->


@endsection