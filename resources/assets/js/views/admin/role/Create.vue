<template>

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$route.name}}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>角色名称</label>
                        <input type="text" class="form-control" v-model="role.name" name="name" placeholder="输入角色名称">
                    </div>

                    <div class="form-group">
                        <label>角色概述</label>
                        <textarea class="form-control" name="description" v-model="role.description" rows="3" placeholder="输入角色概述"></textarea>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-default" @click="$router.back();">返回</button>
                    <button type="submit" class="btn btn-info pull-right" @click="add">添加</button>
                </div>

            </div></div>
        </div>
</template>
<script>
    export default{

        data () {
            return{
                role:{
                    name:'',
                    description:''
                }
            }
        },
        methods: {
            add(){
                var url = '/admin/role';
                var that = this;
                this.callHttp("POST", url, this.role, function (json) {
                    if (json.status) {
                        toastr.success('添加后台角色成功!')
                        that.$router.back();
                    }
                });

            }
        }

    }
</script>