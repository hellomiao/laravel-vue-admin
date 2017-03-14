<template>
    <div>
        <main id="main" class="site-main" v-scroll="getMore">
            <h1 class="main-title">{{title}}</h1>


            <article class="post post-list" v-for="item in alist">
                <div class="post-entry">
                    <div class="feature">
                        <a :href="item.url">
                            <div class="overlay"><i class="iconfont">&#xe61e;</i></div>
                            <img width="150" height="150" :src="item.picture"
                                 class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt=""></a>
                    </div>
                    <h1 class="entry-title"><a :href="item.url">{{item.title}}</a></h1>
                    <div class="p-time">
                        <i class="iconfont">&#xe604;</i> {{item.created_at}}
                    </div>
                    <p>{{item.info}}</p>


                    <footer class="entry-footer">
                        <div class="post-more">
                            <a :href="item.url"><i class="iconfont">&#xe61c;</i></a>
                        </div>
                        <div class="info-meta">
                            <div class="comnum">
                    <span><i class="iconfont">&#xe610;</i> <a href="">35
                        条评论</a></span>
                            </div>
                            <div class="views">
                                <span><i class="iconfont">&#xe614;</i> {{item.view_num}} 点击</span>
                            </div>
                        </div>
                    </footer><!-- .entry-footer -->
                </div>
                <hr>
            </article>


        </main><!-- #main -->

        <div id="pagination"><a href="#" @click.prevent="getMore" v-show="switchShow">加载更多</a>

            <p class="loading" v-show="switchShow">加载中...</p>
        </div>

    </div>
</template>
<script>
    export default{
        data() {
            return {
                nowPage: 1,
                switchShow: false,
                alist: []
            };
        },
        props: {
            url: {
                type: String,
                default: ''
            },
            title: {
                type: String,
                default: '文章'
            }

        },
        methods: {
            moreFn: function (itemIndex) {
                // console.log(this.nowPage)
                this.callHttp("GET", this.url, {page: itemIndex}, function (json) {
                    this.categoryOptions = json;

                    var list = json;

                    if (list.length == 0) {
                        this.switchShow = false;
                    } else {
                        this.switchShow = true;
                    }
                    this.alist = this.alist.concat(list);

                });


            },
            getMore: function () {
                if (this.switchShow) {
                    this.nowPage++;
                    this.moreFn(this.nowPage);
                }

            }
        },
        directives: {// 自定义指令
            scroll: {
                bind: function (el, binding) {
                    window.addEventListener('scroll', function () {
                        if (document.body.scrollTop + window.innerHeight >= el.clientHeight) {
                            var fnc = binding.value;
                            fnc();
                        }
                    })
                }
            }
        },
        created() {
            this.moreFn(this.nowPage);
        }
    };
</script>