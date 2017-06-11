/**
 * Created by yangchunrun on 17/3/12.
 */


/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import util from './util.js';
import store from './vuex/store.js';
import routes from './web-routes.js';

require('./bootstrap');

import VueRouter from 'vue-router';
import App from './App.vue';
import VueResource from 'vue-resource';
import VueProgressBar from 'vue-progressbar';



Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(util);

Vue.use(VueProgressBar, {
    color: '#00a65a',
    failedColor: 'red',
    height: '2px'
})

const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    routes: routes
});




// 4. 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue(Vue.util.extend({ router,store},App)).$mount('#app');
