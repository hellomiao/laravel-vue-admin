<template>
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar" style="height: auto;">

            <!-- /.search form -->
            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu">
                <li class="header">栏目导航</li>
                <!-- Optionally, you can add icons to the links -->

                <li><a href="/admin"><i class="fa fa-dashboard"></i> <span>控制面板</span></a></li>
                <li v-for="menu in menus" class="treeview">
                    <a href="#"><i class="fa" v-bind:class="menu.icon"></i> <span>{{menu.display_name}}</span> <i
                            class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">

                        <li @click="actived($event)"   v-for="item in menu.children">
                            <router-link :to="item.url">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i
                                    class="fa fa-circle-o"></i>{{item.display_name}}
                            </router-link>
                        </li>

                    </ul>
                </li>

            </ul>
        </section>
        <!-- /.sidebar -->
    </aside>
</template>

<script>
    import { mapActions } from 'vuex';
    export default {
        data () {
            return {
                menus: {},
            }
        },

        methods: {
            actived:function(evt){
                $(".treeview-menu li").removeClass('active');
                $(evt.target).parent("li").addClass('active');
            }
        },
        created () {
            var url = '/admin/menu';
            this.$http.get(url).then(function (response) {
                this.menus = response.data;
            });

        },
        mounted(){

        }
    }
</script>