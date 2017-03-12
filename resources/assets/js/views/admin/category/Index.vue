<template>
    <div class="row">
        <div class="col-md-6">


            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">快速添加</h3>
                </div>


                <div class="box-body">

                    <div class="form-group">
                        <label>父级</label>
                        <v-select v-model="parentSelect" placeholder="请选择父级"
                                  :options="parentOptions"></v-select>
                    </div>
                    <div class="form-group field-adminacl-name required">
                        <label class="control-label">名称</label>
                        <input type="text" v-model="category.name" class="form-control"
                               name="AdminAcl[name]"
                               maxlength="100">

                        <div class="help-block"></div>
                    </div>


                    <div class="form-group">
                        <label class="control-label">排序</label>
                        <input type="text" v-model="category.order_num" class="form-control">

                        <div class="help-block"></div>
                    </div>



                    <div class="form-group">
                        <button ref="add_btn" @click="add" class="btn btn-success">添加 <i class="fa fa-plus"></i>
                        </button>
                        <button ref="edit_btn" style="display: none" @click="edit" class="btn btn-success">编辑</button>
                    </div>

                </div>


            </div>


        </div>


        <div class="col-md-6">
            <!-- Horizontal Form -->
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">分类树</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div id="treeAcl"></div>
            </div>
            <!-- /.box -->

        </div>


    </div>
</template>
<script>
    require('jstree/dist/themes/default/style.min.css');
    import vSelect from 'vue-select';
    export default {
        components: {vSelect},
        data () {
            return {
                category: {
                    id: null,
                    name: '',
                    parent_id: 0,
                    order_num: 0,
                },
                parentSelect: null,
                parentOptions: [],
                treeData: null,
                treeDom: "#treeAcl"
            }
        },
        watch: {
            treeData(){

                $.jstree.reference(this.treeDom).settings.core.data = this.treeData;
                $.jstree.reference(this.treeDom).refresh();
            }

        },

        mounted () {

            this.loadList();
//            this.$refs.select.select({label: "权限管理", value: 1});
        },
        methods: {
            loadList: function () {
                var url = '/admin/category/index', that = this;
                this.callHttp("POST", url, {}, function (json) {
                    this.treeData = json.tree;
                    this.initTree();
                    this.parentOptions = json.select;
                });
            },
            initTree: function () {
                var that = this, treeData = this.treeData;
                $(that.treeDom).jstree({
                    'core': {
                        'check_callback': true,
                        "themes": {
                            "theme": "default",
                        },
                        'data': treeData
                    },

                    "contextmenu": {
                        "items": function (node) {// Could be a function that should return an object like this one
                            return {
                                "create": {
                                    "separator_before": false,
                                    "separator_after": true,
                                    "label": "添加子分类",
                                    "action": function (obj) {
                                        that.addUI(node.id, node.text);
                                    }
                                },
                                "edit": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "label": "编辑",
                                    "action": function (obj) {
                                        that.editUI(node.id);
                                    }
                                },
                                "delete": {
                                    "separator_before": false,
                                    "separator_after": false,
                                    "label": "删除",
                                    "action": function (obj) {
                                        that.del(node.id);
                                    }
                                }
                            }
                        }
                    },
                    'plugins': ['themes', 'types', 'contextmenu']
                });


            },
            addUI: function (id, text) {
                var $refs = this.$refs;
                this.parentSelect = {label: text, value: id};
                this.permission = {};
                $($refs.add_btn).show();
                $($refs.edit_btn).hide()
            },
            editUI: function (id) {
                var url = '/admin/category/' + id + '/edit', $refs = this.$refs;
                this.callHttp("GET", url, {}, function (json) {
                    this.permission = json;
                    this.parentSelect = json.parent;
                    $($refs.add_btn).hide();
                    $($refs.edit_btn).show();
                });
            },
            add: function () {
                var $category = this.category;
                var url = '/admin/category';
                $category.parent_id = this.parentSelect.value;
                this.callHttp("POST", url, $category, function (json) {
                    if (json.status) {
                        toastr.success('添加分类成功!')
                        this.permission = {};
                        this.parentSelect = null;
                        this.loadList();
                    }
                });
            },
            edit: function () {
                var $category = this.category;
                var url = '/admin/category/' + $category.id;
                $category.parent_id = this.parentSelect?this.parentSelect.value:0;
                this.callHttp("PUT", url, $category, function (json) {
                    if (json.status) {
                        toastr.success('更新分类成功!')
                        this.permission = {};
                        this.parentSelect = null;
                        this.loadList();
                    }
                });
            },
            del: function (id) {

                var url = '/admin/category/' + id;
                this.callHttp("DELETE", url, {}, function (json) {
                    if (json.status) {
                        toastr.success('删除分类成功!')
                        $.jstree.reference(that.treeDom).delete_node(id);
                    } else {
                        toastr.error(json.msg, '出错啦!');
                    }

                });
            }
        }
    }
</script>