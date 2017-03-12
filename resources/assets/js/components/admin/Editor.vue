 <template>
     <div id="editor" style="height:400px">

     </div>
 </template>
 <script>
     require('wangeditor/dist/js/wangEditor.js');
     require('wangeditor/dist/css/wangEditor.css');
     export default{
         data(){
             return{
                 editor:'',
             }
         },
         props: {
             content: {
                 type: String,
                 default: null
             }

         },
         watch:{
             content(){
                 if(this.content!=null){
                     this.editor.$txt.html(this.content)
                 }
             }
         },
         mounted(){
             var editor = new wangEditor('editor'),self=this;
             editor.config.uploadImgUrl = '/admin/upImg';

             editor.config.uploadParams = {
                 _token:  Laravel.csrfToken
             };

             // 普通的自定义菜单
             editor.onchange = function () {
                 // onchange 事件中更新数据
                 var content = editor.$txt.html();
                 self.$emit('content',content);
             };
             editor.create();
             this.editor =editor;
         }
     }
 </script>