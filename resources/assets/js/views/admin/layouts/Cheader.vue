<template>
    <section class="content-header">
        <h1>{{title}}</h1>

    </section>
</template>
<script>
    export default{
        props:['title'],
        created () {
            var matched = this.$route.matched;
//            for(var item in matched){
//                var _name = matched[item].name;
//                if(name==_name){
//
//                }
//
//            }
        }
    }
</script>