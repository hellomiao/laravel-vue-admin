<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/20
 * Time: 下午8:04
 */

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'admin_roles';

    //
    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'admin_permission_role', 'role_id', 'permission_id');
    }

    public function users()
    {
        return $this->belongsToMany(AdminUser::class, 'admin_role_user', 'role_id', 'user_id');
    }

    //给角色添加权限
    public function givePermissionTo($permission)
    {
        return $this->permissions()->save($permission);
    }

    //角色权限整体添加与修改
    public function givePermissionsTo(array $permissionId)
    {
        $this->permissions()->detach();
        $permissions = Permission::whereIn('id', $permissionId)->get();
        foreach ($permissions as $v) {
            $this->givePermissionTo($v);
        }
        return true;
    }

    //给jstree提供json数据
    public function getTreeData()
    {
        $data = array();
        $permission = new Permission();
        $list = $permission->query()
            ->orderBy('order_num', 'ASC')->get()->toArray();
        foreach ($list as $k => $v) {
            if ($v['parent_id'] == 0) {
                $data[$k]['id'] = $v['id'];
                $data[$k]['parent'] = '#';
                $data[$k]['text'] = $v['display_name'];
                $data[$k]['state'] = array('opened' => true);
            } else {
                $data[$k]['id'] = $v['id'];
                $data[$k]['parent'] = $v['parent_id'];
                $data[$k]['text'] = $v['display_name'];
            }
            $isExists = $this->permissions->contains("id", $v['id']);
            if ($isExists) {
                $data[$k]['state'] = array('opened' => true, 'selected' => true);
            }
        }

        return $data;
    }
}