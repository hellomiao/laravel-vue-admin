<template>

    <header class="main-header">

        <!-- Logo -->
        <a href="index2.html" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini">{{name}}</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg">{{name}}</span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <!-- Notifications: style can be found in dropdown.less -->
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{msgNum}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 10 notifications</li>
                            <li>
                                <!-- inner menu: contains the actual data -->
                                <div class="slimScrollDiv"
                                     style="position: relative; overflow: hidden; width: auto; height: 200px;">
                                    <ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here
                                                that may not fit into the
                                                page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                    <div class="slimScrollBar"
                                         style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;"></div>
                                    <div class="slimScrollRail"
                                         style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
                                </div>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account: style can be found in dropdown.less -->
                    <li class="dropdown user user-menu">
                        <router-link to="/admin/user/info"  data-toggle="dropdown">
                            <!--<img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">-->
                            <img :src="user.picture" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{user.username}}</span>

                        </router-link>

                    </li>
                    <li>
                        <a href="/admin/logout" @click.prevent="test"  class="">退出
                        </a>
                    </li>
                    <!-- Control Sidebar Toggle Button -->
                    <li>
                        <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                    </li>
                </ul>
            </div>

        </nav>
    </header>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        data () {
            return {
                user:window.User,
                name:window.Name,
                msgNum:0
            }
        },
        created(){
            this.websocket();
            var websocket = this.$store.state.websocket,that=this;

            websocket.onopen = function (evt) {

            };

            //onmessage 监听服务器数据推送
            websocket.onmessage = function (evt) {
                that.msgNum= evt.data;
                $(".notifications-menu").addClass('open');

            };


        },

        methods: {
                ...mapActions([
                    'websocket'
                ]),

            test(){
                var websocket = this.$store.state.websocket,that=this;
                var msg = {uid:9,text:45}
                websocket.send(JSON.stringify(msg));

            }

        }
    }
</script>