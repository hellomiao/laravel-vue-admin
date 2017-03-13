@extends('layouts.app')

@section('content')







    <div id="primary" class="content-area">

        <articles url="{{URL::current()}}" title="文章|{{$category->name}}"></articles>

    </div><!-- #primary -->


    </div><!-- #content -->





    </body>
    </html>

@endsection
