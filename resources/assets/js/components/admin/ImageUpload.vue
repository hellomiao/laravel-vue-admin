<template>
    <div class="form-group">
        <div class="widget-user-header">
            <div class="widget-user-image">
                <img class="img-circle" width="50px" height="50px" :src="imgSrc" :alt="label">
            </div>
        </div>
        <label for="exampleInputFile">{{label}}</label>
        <input type="file" @change="up($event)">



    </div>
</template>
<script>
    require('../../canvasResize.js');
    export default{
        data(){
            return {
                imgSrc: require("../../../images/nopic.png"),
                base64:''

            }
        },
        props: {

            label: {
                type: String,
                default: null
            },
            picture: {
                type: String,
                default: null
            }

        },
        watch:{
            picture(){
                if(this.picture!=null){
                    this.imgSrc=this.picture;
                }
            }
        },
        methods: {
            up(evt){
                var file = evt.target.files[0], that = this; //获取file对象
                //判断file的类型是不是图片类型。
                if (!/image\/\w+/.test(file.type)) {
                    toastr.error("文件必须为图片!", '出错啦!');
                    return false;
                }
                canvasResize(file, {
                    width: 800,
                    height: 0,
                    crop: false,
                    quality: 70,
                    //rotate: 90,
                    callback: function (data, width, height) {
                        that.imgSrc = data;
                        //var base64 = data.match(/^(data:\s*image\/\w+;base64,(.+))/);
                        that.$emit('pic',data);
                    }
                });
            }
        },

        created(){

            //this.imgSrc = this.picture;
        }

    }
</script>