<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <router-link :to="{path:'create'}" class="btn btn-success btn-md">
                        <i class="fa fa-plus-circle"></i> 添加商品
                    </router-link>

                    <div class="box-tools">
                        <div class="input-group input-group-sm" style="width: 200px;">
                            <input type="text" name="keyword" v-model="params.keyword" class="form-control pull-right"
                                   placeholder="请输入商品名">

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
                    <template slot="tag" scope="item">
                        <router-link :to="{ path: 'tag/'+item.item.id}" class="btn btn-success btn-xs">{{item.item.tag}}</router-link>
                       </template>
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
                    name: {label: '名称'},
                    price: {label: '价格'},
                    tag: {label: '关键词'},
                    actions: {label: '操作'}
                },
                ajax_url: "/admin/goods/index",
                params: {keyword: ''},
                total: 0,
                currentPage: 1,
                perPage: 15,
                del: {url:'/admin/goods',title:'确定要删除角色吗?',successText:'删除后台角色成功!'},
            }
        },
        watch: {},
        created () {

        },
        methods: {


        }
    }
</script>