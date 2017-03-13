 <template>
     <div :id="id" style="height:400px">

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
             id: {
                 type: String,
                 default: 'editor'
             },
             html: {
                 type: String,
                 default: null
             }

         },
         watch:{
             html(){
                 if(this.html!=null){
                     this.editor.$txt.html(this.html)
                 }
             }
         },
         mounted(){
             var editor = new wangEditor(this.id),self=this;
             editor.config.uploadImgUrl = '/admin/upImg';

             editor.config.uploadParams = {
                 _token:  Laravel.csrfToken
             };

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