<template>
    <textarea :id="id"></textarea>
</template>
<script>
    require('../../../tag-editor/css/jquery.tag-editor.css');
    require('../../../tag-editor/js/jquery.caret.min.js');
    require('../../../tag-editor/js/jquery.tag-editor.min.js');
    export default{
        props: {
            id: {
                type: String,
                default: 'tags'
            },
            tags: {
                type: String,
                default: ''
            }

        },
        watch:{
            tags(){
                if(this.tags!=null) {
                    var self = this;
                    var tagsArr = this.tags.split(",");
                    for(var item in tagsArr) {
                        $("#" + this.id).tagEditor('addTag', tagsArr[item]);
                    }
                }
            }
        },
        mounted(){
            var self =this;
            $("#"+this.id).tagEditor({
                onChange: function (field, editor, tags) {
                    self.$emit('tags', tags.length ? tags.join(',') : '');

                }
            });

        }

    }
</script>