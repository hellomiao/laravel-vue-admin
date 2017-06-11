<template>
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{$route.name}}</h3>
                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="keyword" v-model="params.keyword" class="form-control pull-right"
                                   placeholder="请输入操作内容">

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
                    <template slot="actions" scope="item">
                        <div class="btn-group">
                            <router-link :to="{ path: 'update/'+item.item.id}" class="btn bg-orange btn-xs">编辑</router-link>
                            <a href="#"  @click.prevent="$refs.table.onDel(item.item.id)"  class="btn btn-danger btn-xs">删除</a>
                        </div>
                    </template>

                </vTable>


            </div>
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
                    username: {label: '用户名',need:'users'},
                    url: {label: 'url'},
                    intro: {label: '内容'},
                    created_at:{label:'操作时间', sortable: true}
                },
                ajax_url: "/admin/user/logger",
                params: {keyword: ''},
                currentPage: 1,
                perPage: 15,
                del: {url:'/admin/user',title:'确定要删除用户吗?',successText:'删除后台用户成功!'},
            }
        },
        watch: {},
        created () {

        },
        methods: {


        }
    }
</script>