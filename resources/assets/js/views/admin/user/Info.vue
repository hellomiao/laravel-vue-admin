<template>
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$route.name}}</h3>
                </div>
                <div class="box-body">
                    <div class="form-group">
                        <label>帐号</label>
                        <span>{{user.username}}</span>
                    </div>
                    <div class="form-group">
                        <label>角色</label>
                        <span>{{user.rolesStr}}</span>
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" class="form-control" v-model="user.password" placeholder="输入密码">
                    </div>
                    <div class="form-group">
                        <label>姓名</label>
                        <input type="text" class="form-control" v-model="user.name" name="name" placeholder="输入姓名">
                    </div>
                    <div class="form-group">
                        <label>手机号</label>
                        <input type="number" class="form-control" v-model="user.phone" name="phone" placeholder="输入手机号">
                    </div>


                    <image-upload :picture="user.picture" label="上传头像" v-on:pic="getPicture"></image-upload>

                </div>
                <div class="box-footer">
                    <button type="submit" class="btn btn-default" @click="$router.back()">返回</button>
                    <button type="submit" class="btn btn-info pull-right" @click="update">更新</button>
                </div>
            </div>
        </div></div>
</template>
<script>
    import vSelect from 'vue-select';
    import ImageUpload  from '../../../components/admin/ImageUpload.vue';
    export default  {
        components: {vSelect, 'image-upload': ImageUpload},
        data () {
            return {
                user: {
                    username: '',
                    password: '',
                    name: '',
                    phone: '',
                    rolesStr: '',
                    picture: ''
                },
                roles:null,
                roleOptions:[],

            }
        },

        created () {
            this.init();

        },
        methods:{
            init:function(){
                var url = '/admin/user/info',that=this;
                this.callHttp("POST",url,{}, function (json) {
                    that.user = json;

                });
            },
            update:function(){
                var url = '/admin/user/'+window.User.id,
                        id =this.$route.params.id,that=this,user=this.user,roleArr=[];
                for(var i in this.roles){
                    roleArr.push(this.roles[i].value)

                }
                user.roles=roleArr;
                this.callHttp("PUT",url,user,function(json){
                    if(json.status) {
                        toastr.success('更新后台用户成功!')
                        that.$router.back();
                    }
                });
            },
            getPicture(value){
                this.user.picture = value;
            }

        }
    }
</script>