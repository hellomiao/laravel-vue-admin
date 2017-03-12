<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/10
 * Time: 下午4:07
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
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
                $data[$k]['text']   = $v['name'];
                $data[$k]['state']  = array('opened' => true);
            }
            else
            {
                $data[$k]['id']     = $v['id'];
                $data[$k]['parent'] = $v['parent_id'];
                $data[$k]['text']   = $v['name'];
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
            $v['name'] = $tag . $v['name'];
            $arr[]= ['label'=>$v['name'],'value'=>$v['id']];
            $this->getSelectList($v['id'], $lev + 1);
        }

        return $arr;
    }
}