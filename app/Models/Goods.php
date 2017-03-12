<?php
namespace  App\Models;
use Illuminate\Database\Eloquent\Model;

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/9
 * Time: 上午10:22
 */

class Goods extends Model
{
    public function thirds()
    {
        return $this->hasMany(GoodsThird::class, 'goods_id', 'id');
    }

}