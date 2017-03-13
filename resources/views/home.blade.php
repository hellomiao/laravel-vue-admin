@extends('layouts.app')

@section('content')






    <div class="top-feature">
        <h1 class="fes-title">推荐</h1>
        <div class="feature-content">
            @foreach($hot as $key=>$val)
                <li class="feature-1"><a href="{{$val->url}}" target="_blank">
                        <div class="feature-title"><span class="foverlay">{{$val->title}}</span></div>
                        <img src="{{$val->picture}}"></a></li>
            @endforeach
        </div>
    </div>


    <div id="primary" class="content-area">


        <articles url="/"></articles>


    </div><!-- #primary -->


    </div><!-- #content -->





    </body>
    </html>

@endsection
