
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import util from './util.js';
import store from './vuex/store.js';
import routes from './admin-routes.js';

require('./bootstrap');

import VueRouter from 'vue-router';
import App from './App.vue';
import VueResource from 'vue-resource';

require('admin-lte');
require('jstree');


Vue.use(VueRouter);
Vue.use(VueResource);
Vue.use(util);


window.swal = require('sweetalert2');

window.toastr=require('toastr');
window.toastr.options = {
    positionClass: "toast-bottom-right",
    showDuration: "300",
    hideDuration: "1000",
    timeOut: "5000",
    extendedTimeOut: "1000",
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut"
};

Vue.component(
    'vTable',
    require('./components/admin/Table.vue')
);


// 3. 创建 router 实例，然后传 `routes` 配置
// 你还可以传别的配置参数, 不过先这么简单着吧。
const router = new VueRouter({
    mode: 'history',
    base: __dirname,
    linkActiveClass: 'active',
    routes: routes
});

router.beforeEach((to, from, next) => {

    if (!window.User) {
        return next('/admin/login')
    }
    var url = '/admin/checkAcl', path =to.path;
    Vue.http({url:url,method:'GET',params:{path:path}})
        .then(response => {
            var responseJson = response.data;

            if(!responseJson.status){
                return next({ path: '/admin/error' });
            }

        }, response => {
            return next({ path: '/admin/login' });
        });
    //to.callHttp("POST",url,{path:path}, function (json) {
    //
    //
    //});
    return next();
})

// 4. 创建和挂载根实例。
// 记得要通过 router 配置参数注入路由，
// 从而让整个应用都有路由功能
const app = new Vue(Vue.util.extend({ router,store},App)).$mount('#app');
