<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">

        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">栏目导航</li>
            <!-- Optionally, you can add icons to the links -->

            <li><a href="/admin"><i class="fa fa-dashboard"></i> <span>控制面板</span></a></li>
            <?php $adminMenuData=Request::get('adminMenuData');;?>
            @foreach($adminMenuData as $val)
                <li class="treeview">
                    <a href="#"><i class="fa {{$val['icon'] }}"></i> <span>{{$val['display_name']}}</span> <i
                                class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        @foreach($val['children'] as $v)
                            <li><router-link to="{{URL::route($v['name'])}}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-circle-o"></i>{{$v['display_name']}}</router-link></li>
                        @endforeach
                    </ul>
                </li>
        @endforeach

    </section>
    <!-- /.sidebar -->
</aside>