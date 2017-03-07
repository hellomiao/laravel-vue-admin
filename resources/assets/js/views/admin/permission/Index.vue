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
                        <input type="text" v-model="permission.display_name" class="form-control"
                               name="AdminAcl[name]"
                               maxlength="100">

                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-adminacl-icon">
                        <label class="control-label">图标</label>
                        <input type="text" v-model="permission.icon" class="form-control"
                               maxlength="50">

                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-adminacl-module">
                        <label class="control-label">权限别名</label>
                        <input type="text" v-model="permission.name" class="form-control"
                               maxlength="50">

                        <div class="help-block"></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">排序</label>
                        <input type="text" v-model="permission.order_num" class="form-control">

                        <div class="help-block"></div>
                    </div>
                    <div class="form-group field-adminacl-is_show">

                        <label><input type="checkbox" v-model="permission.is_show" value="0">
                            左侧是否显示</label>

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
                    <h3 class="box-title">权限树</h3>
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
                permission: {
                    id: null,
                    display_name: '',
                    icon: '',
                    name: '',
                    parent_id: 0,
                    order_num: 0,
                    is_show: 0
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
                var url = '/admin/permission/index', that = this;
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
                                    "label": "添加子权限",
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
                var url = '/admin/permission/' + id + '/edit', that = this, $refs = this.$refs;
                this.callHttp("GET", url, {}, function (json) {
                    that.permission = json;
                    that.parentSelect = json.parent;
                    $($refs.add_btn).hide();
                    $($refs.edit_btn).show();
                });
            },
            add: function () {
                var $permission = this.permission;
                var url = '/admin/permission', that = this;
                $permission.parent_id = this.parentSelect.value;
                $permission.is_show = $permission.is_show ? 1 : 0;
                this.callHttp("POST", url, $permission, function (json) {
                    if (json.status) {
                        toastr.success('添加后台权限成功!')
                        that.permission = {};
                        that.parentSelect = null;
                        that.loadList();
                    }
                });
            },
            edit: function () {
                var $permission = this.permission;
                var url = '/admin/permission/' + $permission.id, that = this;
                $permission.parent_id = this.parentSelect?this.parentSelect.value:0;
                $permission.is_show = $permission.is_show ? 1 : 0;
                this.callHttp("PUT", url, $permission, function (json) {
                    if (json.status) {
                        toastr.success('更新后台权限成功!')
                        that.permission = {};
                        that.parentSelect = null;
                        that.loadList();
                    }
                });
            },
            del: function (id) {

                var url = '/admin/permission/' + id, that = this;
                this.callHttp("DELETE", url, {}, function (json) {
                    if (json.status) {
                        toastr.success('删除后台权限成功!')
                        $.jstree.reference(that.treeDom).delete_node(id);
                    } else {
                        toastr.error(json.msg, '出错啦!');
                    }

                });
            }
        }
    }
</script>