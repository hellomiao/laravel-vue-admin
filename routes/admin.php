<?php
Route::get('/login', 'LoginController@showLoginForm');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::group(['middleware' => ['auth:admin', 'menu']], function () {
    Route::get('/', ['uses' => 'IndexController@index']);
    //权限检查
    Route::get('/checkAcl', ['as' => 'admin.check.acl', 'uses' => 'IndexController@checkAcl']);
    //获取菜单
    Route::get('/menu', ['as' => 'admin.menu', 'uses' => 'IndexController@menu']);
    Route::post('/upImg', ['as' => 'admin.upImg', 'uses' => 'IndexController@upImg']);

    Route::post('user/info', ['uses' => 'UserController@info']);
    Route::post('user/set', ['uses' => 'UserController@set']);
    Route::post('/msg', ['uses' => 'IndexController@msg']);
    Route::post('goods/edit', ['as' => 'admin.goods.edit', 'uses' => 'GoodsController@edit']);


});
Route::group(['middleware' => ['auth:admin', 'menu', 'authAdmin']], function () {
    if (!Request::ajax()) {
        Route::get('{path?}', ['uses' => 'IndexController@index'])->where('path', '[\/\w\.-]*');
    }

    //权限管理路由
    Route::post('permission/index', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']); //查询
    Route::resource('permission', 'PermissionController', ['names' => ['update' => 'admin.permission.edit', 'store' => 'admin.permission.create']]);
    //角色管理路由
    Route::post('role/edit', ['as' => 'admin.role.edit', 'uses' => 'RoleController@edit']);
    Route::post('role/setAcl', ['as' => 'admin.role.acl', 'uses' => 'RoleController@setAcl']);
    Route::post('role/getAcl', ['as' => 'admin.role.acl', 'uses' => 'RoleController@getAcl']);
    Route::post('role/index', ['as' => 'admin.role.index', 'uses' => 'RoleController@index']);
    Route::resource('role', 'RoleController', ['names' => ['update' => 'admin.role.edit', 'store' => 'admin.role.create']]);
    //用户管理路由
    Route::post('user/role', ['as' => 'admin.user.index', 'uses' => 'UserController@role']);
    Route::post('user/edit', ['as' => 'admin.user.info', 'uses' => 'UserController@edit']);  //用户管理
    Route::post('user/index', ['as' => 'admin.user.index', 'uses' => 'UserController@index']);
    Route::post('user/logger', ['as' => 'admin.user.logger', 'uses' => 'UserController@logger']);
    Route::post('user/send', ['as' => 'admin.user.send', 'uses' => 'UserController@send']);
    Route::resource('user', 'UserController', ['names' => ['store' => 'admin.user.create', 'update' => 'admin.user.edit']]);
    //商品管理路由
    Route::post('goods/edit', ['as' => 'admin.goods.edit', 'uses' => 'GoodsController@edit']);
    Route::post('goods/tag', ['as' => 'admin.goods.tag', 'uses' => 'GoodsController@tag']);
    Route::post('goods/tagRun', ['as' => 'admin.goods.tag', 'uses' => 'GoodsController@tagRun']);
    Route::post('goods/tagInfo', ['as' => 'admin.goods.tag', 'uses' => 'GoodsController@tagInfo']);
    Route::post('goods/index', ['as' => 'admin.goods.index', 'uses' => 'GoodsController@index']);
    Route::resource('goods', 'GoodsController', ['names' => ['update' => 'admin.goods.edit', 'store' => 'admin.goods.create']]);

    //分类路由管理
    Route::post('category/index', ['as' => 'admin.category.index', 'uses' => 'CategoryController@index']); //查询
    Route::resource('category', 'CategoryController', ['names' => ['update' => 'admin.category.edit', 'store' => 'admin.category.create']]);

    //内容路由管理
    Route::post('articles/edit', ['as' => 'admin.articles.edit', 'uses' => 'ArticlesController@edit']);
    Route::post('articles/isHot', ['as' => 'admin.articles.isHot', 'uses' => 'ArticlesController@isHot']);
    Route::post('articles/category', ['as' => 'admin.articles.create', 'uses' => 'ArticlesController@category']);
    Route::post('articles/index', ['as' => 'admin.articles.index', 'uses' => 'ArticlesController@index']);
    Route::resource('articles', 'ArticlesController', ['names' => ['update' => 'admin.articles.edit', 'store' => 'admin.articles.create']]);
});

