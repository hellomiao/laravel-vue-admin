/**
 * Created by yangchunrun on 17/3/12.
 */

window.$ = window.jQuery = require('jquery');
import util from './web-util.js';
import Articles  from './components/Articles.vue';
window.Vue = require('vue');
import VueResource from 'vue-resource';
Vue.use(VueResource);
Vue.use(util);

new Vue({
    el: '#page',
    components: {Articles},
}).$mount('#page');