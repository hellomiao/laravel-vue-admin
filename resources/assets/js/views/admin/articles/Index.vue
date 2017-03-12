<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <router-link :to="{path:'create'}" class="btn btn-success btn-md">
                        <i class="fa fa-plus-circle"></i> 添加文章
                    </router-link>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="keyword" v-model="params.keyword" class="form-control pull-right"
                                   placeholder="请输入角色名">

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
                    <template slot="title" scope="item">
                        <img :src="item.item.picture" width="20px" height="20px" class="img-circle"/>
                        {{item.item.title}}
                    </template>
                    <template slot="actions" scope="item">
                        <div class="btn-group">
                            <router-link :to="{ path: 'setacl/'+item.item.id}" class="btn bg-purple btn-xs">设置权限</router-link>
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
                    title: {label: '标题'},
                    created_at: {label: '添加时间'},
                    actions: {label: '操作'}
                },
                ajax_url: "/admin/articles/index",
                params: {keyword: ''},
                total: 0,
                currentPage: 1,
                perPage: 15,
                del: {url:'/admin/articles',title:'确定要删除角色吗?',successText:'删除后台角色成功!'},
            }
        },
        watch: {},
        created () {

        },
        methods: {


        }
    }
</script>