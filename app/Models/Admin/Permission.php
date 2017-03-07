<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/20
 * Time: 下午8:03
 */

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;
class Permission extends Model
{
    protected $table='admin_permissions';
    public function roles()
    {
        return $this->belongsToMany(Role::class,'admin_permission_role','permission_id','role_id');
    }

    //给jstree提供json数据
    public function getTreeData()
    {
        $data = array();
        $list=$this->query()
            ->orderBy('order_num','ASC')->get()->toArray();
        foreach ($list as $k => $v)
        {
            if ($v['parent_id'] == 0)
            {
                $data[$k]['id']     = $v['id'];
                $data[$k]['parent'] = '#';
                $data[$k]['text']   = $v['display_name'];
                $data[$k]['state']  = array('opened' => true);
            }
            else
            {
                $data[$k]['id']     = $v['id'];
                $data[$k]['parent'] = $v['parent_id'];
                $data[$k]['text']   = $v['display_name'];
            }
        }

        return $data;
    }


    public function getSelectList($id = 0, $lev = 0)
    {
        $list = $this->query()->where('parent_id', $id)
            ->orderBy('order_num', 'ASC')->get()->toArray();
        static $arr = [['label'=>'根','value'=>0]];
        $tag = '';
        foreach ($list as $k => $v) {
            $tag = str_repeat("—", $lev);
            $v['display_name'] = $tag . $v['display_name'];
            $arr[]= ['label'=>$v['display_name'],'value'=>$v['id']];
            $this->getSelectList($v['id'], $lev + 1);
        }

        return $arr;
    }
}