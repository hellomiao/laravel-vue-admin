## 简介

这是一个laravel5.4+vue2.0构建的后台管理系统,主题是AdminLte.主要功能包括权限树管理,角色管理,用户管理,操作日志等。[博客](https://www.woniubiji.com/)

###用户管理

 ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/users.png)
 
####消息发送

  > NOTE:需要安装php的swoole模块和redis服务。简单的websocket消息推送,在流程场景里有用。
  
  
 ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/msg1.png)
 
 ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/msg2.png)
 
###权限管理

  ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/acl.png)
  
###角色管理
  
   ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/role.png)
 
###操作日志

  ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/logger.png)
  
###新增博客

两天简单撸了个博客还没有评论功能,界面扒的别人的,设计天赋有限。
  
   ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/blog_admin.png)
   
   ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/blog_admin1.png)
   
   ![image](https://github.com/hellomiao/laravel-vue-admin/raw/master/screenshots/blog.png)
   
  
###前端vue权限方法,can('别名')
  
```
v-if="can('admin.user.create')"
```
 
 
###启动swoole websocket服务
  
```
php artisan swoole start
```

websocket连接储存在Store模块里
    
```
this.$store.state.websocket
```
     
###日志记录
  
采用laravel事件机制
  
```
Event::fire(new AdminLogger('delete', "删除了后台用户[{$user->username}]"));
```
