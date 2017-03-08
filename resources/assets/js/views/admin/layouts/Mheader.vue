<template>

    <header class="main-header">

        <!-- Logo -->
        <a href="" class="logo">
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
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" @click="loadMsgList" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">{{msgNum}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">你有 {{msgNum}} 条未读消息</li>
                            <li>
                                    <ul class="menu">
                                        <li v-for="item in msgList"><!-- start message -->
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img :src="item.users.picture"  class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                     {{item.users.username}}
                                                    <small><i class="fa fa-clock-o"></i> {{item.created_at}}</small>
                                                </h4>
                                                <p>{{item.content}}</p>
                                            </a>
                                        </li>

                                    </ul>

                            </li>
                            <li class="footer"><a href="#">查看所有</a></li>
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
                        <a href="/admin/logout"  class="">退出
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
                msgNum:window.MsgNum,
                msgList:{}
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
                $(".messages-menu").addClass('open');
                that.loadMsgList();

            };


        },

        methods: {
                ...mapActions([
                    'websocket'
                ]),
                loadMsgList(){
                    var url = '/admin/msg';
                    this.callHttp("POST", url, {}, function (json) {

                        this.msgList = json;


                    });

                }

        }
    }
</script>