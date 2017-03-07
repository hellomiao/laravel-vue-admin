<?php

use Illuminate\Database\Seeder;

class AdminPermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


//        \App\Models\Admin\Permission::truncate();
        \DB::select(
            <<<SQL
                INSERT INTO `admin_permissions` (`id`, `name`, `display_name`, `description`,  `icon`, `parent_id`,`is_show`,`order_num`,`created_at`, `updated_at`)
VALUES
	(1, 'admin.permission', '权限管理', '','fa-users',0,1,0,'2016-05-21 10:06:50', '2016-06-22 13:49:09'),
	(2, 'admin.permission.index', '权限列表', '', '',1,1,0,'2016-05-21 10:08:04', '2016-05-21 10:08:04'),
	(3, 'admin.permission.create', '权限添加', '', '',2,0,0,'2016-05-21 10:08:18', '2016-05-21 10:08:18'),
	(4, 'admin.permission.edit', '权限修改', '',  '',2,0,0,'2016-05-21 10:08:35', '2016-05-21 10:08:35'),
	(5, 'admin.permission.destroy ', '权限删除', '','',2,0,0,'2016-05-21 10:09:57', '2016-05-21 10:09:57'),
	(6, 'admin.role.index', '角色列表', '', '',1,1,0,'2016-05-23 10:36:40', '2016-05-23 10:36:40'),
	(7, 'admin.role.create', '角色添加', '', '',6,0,0,'2016-05-23 10:37:07', '2016-05-23 10:37:07'),
	(8, 'admin.role.edit', '角色修改', '', '',6,0,0,'2016-05-23 10:37:22', '2016-05-23 10:37:22'),
	(9, 'admin.role.destroy', '角色删除', '','',6,0,0,'2016-05-23 10:37:48', '2016-05-23 10:37:48'),
	(10, 'admin.user.index', '用户管理', '', '',1,1,0,'2016-05-23 10:38:52', '2016-05-23 10:38:52'),
	(11, 'admin.user.create', '用户添加', '',  '',10,0,0,'2016-05-23 10:39:21', '2016-06-22 13:49:29'),
	(12, 'admin.user.edit', '用户编辑', '', '',10,0,0,'2016-05-23 10:39:52', '2016-05-23 10:39:52'),
	(13, 'admin.user.destroy', '用户删除', '', '',10,0,0,'2016-05-23 10:40:36', '2016-05-23 10:40:36');
SQL
        );
        
    }
}