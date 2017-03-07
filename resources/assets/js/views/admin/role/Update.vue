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
                    <button type="submit" class="btn btn-default" @click="$router.back()">返回</button>
                    <button type="submit" class="btn btn-info pull-right" @click="update">更新</button>
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
        created () {
            this.init();
        },
        methods:{
            init:function(){
                var url = '/admin/role/edit', id =this.$route.params.id,that=this;
                this.callHttp("POST",url,{id:id}, function (json) {
                    that.role = json;

                });
            },
            update:function(){
                var url = '/admin/role/'+this.$route.params.id, id =this.$route.params.id,that=this,role=this.role;
                this.callHttp("PUT",url,role,function(json){
                    if(json.status) {
                        toastr.success('更新后台用户成功!')
                        that.$router.back();
                    }
                });
            }

        }

    }
</script>