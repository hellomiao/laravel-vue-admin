@extends('layouts.app')

@section('content')






    <div class="top-feature">
        <h1 class="fes-title">推荐</h1>
        <div class="feature-content">
            @foreach($hot as $key=>$val)
            <li class="feature-1"><a href="http://www.akina.pw/themeakina" target="_blank"><div class="feature-title"><span class="foverlay">{{$val->title}}</span></div><img src="{{$val->picture}}"></a></li>
            @endforeach
        </div>
    </div>


    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <h1 class="main-title">文章</h1>

            @foreach($list as $key=>$val)

                <article class="post post-list">
                    <div class="post-entry">
                        <div class="feature">
                            <a href="http://www.akina.pw/archives/363"><div class="overlay"><i class="iconfont"></i></div><img width="150" height="150" src="{{$val->picture}}" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
                        </div>
                        <h1 class="entry-title"><a href="{{URL::route('articles.detail',['id'=>$val->id])}}">{{$val->title}}</a></h1>
                        <div class="p-time">
                            <i class="iconfont">&#xe604;</i> {{$val->created_at}}	  </div>
                        <p>{{$val->info}}</p>



                        <footer class="entry-footer">
                            <div class="post-more">
                                <a href="http://www.akina.pw/archives/363"><i class="iconfont"></i></a>
                            </div>
                            <div class="info-meta">
                                <div class="comnum">
                                    <span><i class="iconfont">&#xe610</i> <a href="http://www.akina.pw/archives/363#comments">35 条评论</a></span>
                                </div>
                                <div class="views">
                                    <span><i class="iconfont">&#xe614;</i> 13,452 热度</span>
                                </div>
                            </div>
                        </footer><!-- .entry-footer -->
                    </div>
                    <hr>
                </article>

            @endforeach

            <nav class="navigator">
                <a href="http://www.akina.pw/page/2" ><i class="iconfont">&#xe60f;</i></a>	</nav>



        </main><!-- #main -->

        <div id="pagination"><a href="http://www.akina.pw/page/2" >加载更多</a></div>

    </div><!-- #primary -->


    </div><!-- #content -->





    </body>
    </html>

@endsection
