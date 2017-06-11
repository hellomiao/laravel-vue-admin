/**
 * Created by yangchunrun on 17/2/22.
 */
import Main from './views/web/layouts/Main.vue'
import Parent from './views/web/layouts/Parent.vue'

export default [
    {
        path: '/',
        component: Main,
        name: '权限列表',
        component: require('./views/web/Login.vue'),

    },
    {
        path: '/login',
        component: Main,
        name: '权限列表',
        component: require('./views/web/Login.vue'),
    }
]


