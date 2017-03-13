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
                    </div>

                <footer class="post-footer">
                    <div class="post-tags">
                        <i class="iconfont">&#xe613;</i>
                        @foreach($articles->tags as $key=>$val)
                        <a href="" rel="tag">{{$val}}</a>
                        @endforeach
                    </div>

                    <div class="post-like">
                        <a href="javascript:;" data-action="ding" data-id="363" class="specsZan ">
                            <i class="iconfont">&#xe612;</i> <span class="count">
					10</span>
                        </a>
                    </div>


                </footer><!-- .entry-footer -->
            </article><!-- #post-## -->





        </main><!-- #main -->
    </div><!-- #primary -->


@endsection