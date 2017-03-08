<?php
Route::get('/login', 'LoginController@showLoginForm');
Route::post('/login', 'LoginController@login');
Route::get('/logout', 'LoginController@logout');
Route::group(['middleware' => ['auth:admin','menu']], function () {
    Route::get('/', ['uses' => 'IndexController@index']);
    //权限检查
    Route::get('/checkAcl', ['as' => 'admin.check.acl', 'uses' => 'IndexController@checkAcl']);
    //获取菜单
    Route::get('/menu', ['as' => 'admin.menu', 'uses' => 'IndexController@menu']);

    Route::post('user/info', ['uses' => 'UserController@info']);
    Route::post('user/set', ['uses' => 'UserController@set']);
    Route::post('/msg', ['uses' => 'IndexController@msg']);


});
Route::group(['middleware' => ['auth:admin', 'menu','authAdmin']], function () {
    if(!Request::ajax()) {
        Route::get('{path?}', ['uses' => 'IndexController@index'])->where('path', '[\/\w\.-]*');
    }

    //权限管理路由
    Route::get('permission/{cid}/create', ['as' => 'admin.permission.create', 'uses' => 'PermissionController@create']);
    Route::get('permission/manage', ['as' => 'admin.permission.manage', 'uses' => 'PermissionController@index']);
  //  Route::get('permission/{cid?}', ['as' => 'admin.permission.index', 'uses' => 'PermissionController@index']);
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
    Route::resource('user', 'UserController', ['names' => ['store' => 'admin.user.create','update' => 'admin.user.edit']]);
});

