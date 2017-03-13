<template>

    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{$route.name}}</h3>
                </div>
                <div class="box-body">

                    <div class="form-group">
                        <label>标题</label>
                        <input type="text" class="form-control" v-model="article.title" placeholder="输入标题">
                    </div>

                    <div class="form-group">
                        <label>分类</label>
                        <v-select v-model="category" :options="categoryOptions"></v-select>
                    </div>

                    <image-upload label="上传封面" v-on:pic="getPicture"></image-upload>

                    <div class="form-group">
                        <label>简介</label>
                        <textarea class="form-control" name="description" v-model="article.info" rows="3"
                                  placeholder="输入简介"></textarea>
                    </div>

                    <div class="form-group">
                        <label>标签</label>
                        <tag v-on:tags="getTags" id="tags"></tag>
                    </div>

                    <div class="form-group">
                        <label>内容</label>
                        <editor v-on:content="getContent" id="content"></editor>
                    </div>

                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-default" @click="$router.back();">返回</button>
                    <button type="submit" class="btn btn-info pull-right" @click="add">添加</button>
                </div>

            </div>
        </div>
    </div>
</template>
<script>
    import vSelect from 'vue-select';
    import ImageUpload  from '../../../components/admin/ImageUpload.vue';
    import Editor  from '../../../components/admin/Editor.vue';
    import TagEditor  from '../../../components/admin/TagEditor.vue';
    export default{
        components: {vSelect, 'image-upload': ImageUpload, Editor, 'tag': TagEditor},
        data () {
            return {
                article: {
                    category_id: '',
                    picture: '',
                    title: '',
                    tags: '',
                    info: '',
                    content: ""


                },
                category: null,
                categoryOptions: []
            }
        },
        created () {

            this.getCategory();
        },
        methods: {
            add(){
                console.log(this.article)
                var url = '/admin/articles';
                this.article.category_id = this.category.value;
                this.callHttp("POST", url, this.article, function (json) {
                    if (json.status) {
                        toastr.success('添加文章成功!')
                        this.$router.back();
                    }
                });

            },
            getCategory(){
                var url = '/admin/articles/category';
                this.callHttp("POST", url, {}, function (json) {
                    this.categoryOptions = json;
                });
            },
            getPicture(value){
                this.article.picture = value;
            },
            getContent(value){
                this.article.content = value;
            },
            getTags(value){
                this.article.tags = value;
            }
        }

    }
</script>