/**
 * Created by yangchunrun on 17/2/22.
 */
import Main from './views/admin/layouts/Main.vue'
import Parent from './views/admin/layouts/Parent.vue'

export default [
    {
        path: '/admin',
        component: Main,
        children: [
            {
                path: 'permission',
                component: Parent,
                name: '权限管理',
                children: [
                    {
                        path: 'index',
                        name: '权限列表',
                        component: require('./views/admin/permission/Index.vue')
                    }

                ]
            },
            {
                path: 'role',
                component: Parent,
                name: '角色管理',
                children: [
                    {
                        path: 'index',
                        name: '角色列表',
                        component: require('./views/admin/role/Index.vue')
                    },
                    {
                        path: 'create',
                        name: '添加角色',
                        component: require('./views/admin/role/Create.vue')
                    },
                    {
                        path: 'update/:id',
                        name: '编辑角色',
                        component: require('./views/admin/role/Update.vue')
                    },
                    {
                        path: 'setacl/:id',
                        name: '设置权限',
                        component: require('./views/admin/role/Acl.vue')
                    }
                ]
            },
            {
                path: 'user',
                component: Parent,
                name: '用户管理',
                children: [
                    {
                        path: 'index',
                        name: '用户列表',
                        component: require('./views/admin/user/Index.vue')
                    },
                    {
                        path: 'create',
                        name: '添加用户',
                        component: require('./views/admin/user/Create.vue')
                    },
                    {
                        path: 'update/:id',
                        name: '编辑用户',
                        component: require('./views/admin/user/Update.vue')
                    },
                    {
                        path: 'info',
                        name: '修改资料',
                        component: require('./views/admin/user/Info.vue')
                    },
                    {
                        path: 'logger',
                        name: '操作日志',
                        component: require('./views/admin/user/Logger.vue')
                    }

                ]
            },

            {
                path: 'error',
                component: require('./views/admin/Error.vue')
            },
            {
                path: '*',
                redirect: '/admin'
            }
        ]
    }
]


