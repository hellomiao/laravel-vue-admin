<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <router-link :to="{path:'create'}" v-if="can('admin.user.create')" class="btn btn-success btn-md">
                        <i class="fa fa-plus-circle"></i> 添加用户
                    </router-link>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="keyword" v-model="params.keyword" class="form-control pull-right"
                                   placeholder="请输入要帐号或者姓名">

                            <div class="input-group-btn">
                                <button type="submit" class="btn btn-default" @click="$refs.table.loadList()"><i
                                        class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>

                <vTable ref="table"
                        stripped
                        hover
                        :ajax_url="ajax_url"
                        :params="params"
                        :items="items"
                        :fields="fields"
                        :current-page="currentPage"
                        :per-page="perPage"
                        :del="del"
                >
                    <template slot="isOnLine" scope="item">
                        <i :class="['fa','fa-circle',item.item.isOnLine==1?'text-success':'text-danger']"></i>
                    </template>
                    <template slot="username" scope="item">
                        <img :src="item.item.picture" width="20px" height="20px" class="img-circle"/>
                        {{item.item.username}}
                    </template>
                    <template slot="actions" scope="item">
                        <div class="btn-group">
                            <a href="#" @click.prevent="view(item.item.id)" class="btn btn-success btn-xs">查看</a>
                            <a href="#" @click.prevent="msgBox(item.item)" class="btn btn-info
                             btn-xs">消息</a>
                            <router-link :to="{ path: 'update/'+item.item.id}" class="btn bg-orange btn-xs">编辑
                            </router-link>
                            <a href="#" @click.prevent="$refs.table.onDel(item.item.id)" class="btn btn-danger btn-xs">删除</a>
                        </div>
                    </template>

                </vTable>


            </div>
        </div>

        <div id="user_view_box" style="display: none">

            <!-- Widget: user widget style 1 -->
            <div class="box box-widget widget-user-2">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header bg-yellow">
                    <div class="widget-user-image">
                        <img class="img-circle" :src="user.picture" alt="User Avatar">
                    </div>
                    <!-- /.widget-user-image -->
                    <h3 class="widget-user-username">{{user.username}}</h3>
                    <h5 class="widget-user-desc">{{user.name}}</h5>
                </div>
                <div class="box-footer no-padding">
                    <ul class="nav nav-stacked">
                        <li><a href="#">手机号<span class="pull-right badge bg-blue">{{user.phone}}</span></a></li>
                        <li><a href="#">角色<span class="pull-right badge bg-aqua">{{user.rolesStr}}</span></a></li>

                    </ul>

                </div>
            </div>
            <!-- /.widget-user -->

        </div>





    </div>

</template>
<script>
    export default {

        data () {
            return {
                items: [],
                fields: {
                    id: {label: 'ID', sortable: true},
                    username: {label: '用户名'},
                    name: {label: '姓名'},
                    isOnLine: {label: '在线'},
                    created_at: {label: '添加时间', sortable: true},
                    actions: {label: '操作'}
                },
                user: {
                    username: '',
                    password: '',
                    name: '',
                    phone: '',
                    rolesStr: '未分配',
                    picture: ''
                },
                text:'',
                ajax_url: "/admin/user/index",
                params: {keyword: ''},
                total: 0,
                currentPage: 1,
                perPage: 15,
                del: {url: '/admin/user', title: '确定要删除用户吗?', successText: '删除后台用户成功!'},
            }
        },
        watch: {},
        created () {

        },
        methods: {

            view: function (id) {

                var url = '/admin/user/edit';
                this.callHttp("POST", url, {id: id}, function (json) {
                    this.user = json;
                    setTimeout(function () {
                                swal({
                                    title: "",
                                    html: $("#user_view_box").html(),
                                    customClass: 'user_view_box'
                                });
                            }
                            , 100)

                });

            },
            msgBox: function (item) {

                var that = this;
                var websocket = this.$store.state.websocket;
                setTimeout(function () {
                    $(that.$refs.msg_text).attr('id','msgText'+item.id)
                    swal({
                                title: "To:" + item.username,
                                input: 'textarea',
                                showCancelButton: true,
                                closeOnConfirm: false,
                                showLoaderOnConfirm: true,
                                confirmButtonText: '发送',
                                cancelButtonText: '取消'

                            }).then(function (text) {

                               var uid = item.id;
                                var url = '/admin/user/send';
                                that.callHttp("POST", url, {uid:uid,text:text}, function (json) {

                                    if(json.status){
                                        websocket.send(item.id);
                                        swal({
                                            title: "成功",
                                            text: "发送成功",
                                            timer: 2000,
                                            showConfirmButton: false
                                        });
                                    }

                                });
                            });


                }, 100)


            }
        }
    }
</script>

<style>
    .user_view_box {
        width: 312px;
    }

    .nav-stacked > li > a {
        text-align: left;
    }
</style>