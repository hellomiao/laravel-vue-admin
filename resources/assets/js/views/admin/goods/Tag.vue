<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="#" class="btn btn-success btn-md" @click.prevent="run">运行
                    </a>

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
                        <router-link :to="{ path: 'update/'+item.item.id}" class="btn btn-success btn-xs">
                            {{item.item.tag}}
                        </router-link>
                    </template>
                    <template slot="actions" scope="item">
                        <div class="btn-group">
                            <a href="#" @click.prevent="view(item.item.id)" class="btn btn-success btn-xs">查看</a>
                        </div>
                    </template>

                </vTable>


            </div>
        </div>


        <div id="goods_view_box" style="display: none">

            <!-- Widget: user widget style 1 -->
            <div class="box box-widget">
                <!-- Add the bg color to the header using any of the bg-* classes -->

                <table class="table table-striped table-bordered" style="font-size: 14px">
                    <tbody>

                    <tr>
                        <th>名称</th>
                        <td>{{goods.name}}</td>

                    </tr>
                    <tr>
                        <td>价格</td>
                        <td>{{goods.price}}</td>

                    </tr>
                    <tr>
                        <td>出售量</td>
                        <td>{{goods.sales}}</td>

                    </tr>
                    <tr>
                        <td>收藏量</td>
                        <td>{{goods.fav_num}}</td>

                    </tr>
                    <tr>
                        <td>属性</td>
                        <td>{{goods.props}}</td>

                    </tr>
                    <tr>
                        <td>所在地</td>
                        <td>{{goods.location}}</td>

                    </tr>
                    <tr>
                        <td>店铺名称</td>
                        <td>{{goods.shop_title}}</td>

                    </tr>
                    </tbody></table>

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
                    name: {label: '名称'},
                    price: {label: '价格', sortable: true},
                    sales: {label: '出售量', sortable: true},
                    fav_num: {label: '收藏量', sortable: true},
                    actions: {label: '操作'}
                },
                goods: {
                    name: '',
                    price: '',
                    sales: '',
                    fav_num: '',
                    props: '',
                    location: '',
                    shop_title: '',
                    item_id: ''

                },
                tag: '',
                ajax_url: "/admin/goods/tag",
                params: {keyword: '', id: this.$route.params.id},
                total: 0,
                currentPage: 1,
                perPage: 15,
                del: {url: '/admin/role', title: '确定要删除角色吗?', successText: '删除后台角色成功!'},
            }
        },
        watch: {},
        created () {

            this.getTag();

        },
        methods: {
            view: function (id) {
                var url = '/admin/goods/tagInfo';
                this.callHttp("POST", url, {id: id}, function (json) {
                    this.goods = json;
                    setTimeout(function () {
                                swal({
                                    title: "",
                                    html: $("#goods_view_box").html(),

                                });
                            }
                            , 100)

                });

            },
            getTag: function () {
                var url = '/admin/goods/edit', id = this.$route.params.id;
                this.callHttp("POST", url, {id: id}, function (json) {
                    this.tag = json.tag;


                });
            },
            run: function () {
                var url = '/admin/goods/tagRun', id = this.$route.params.id;
                toastr.info('添加到队列!');
                this.callHttp("POST", url, {id: id, tag: this.tag}, function (json) {
                    if (json.status) {
                        toastr.success('抓取商品成功!');
                        this.$emit('reload');

                    }
                });
            }


        }
    }
</script>