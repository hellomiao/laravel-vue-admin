<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/23
 * Time: 下午10:48
 */

namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Logger extends Model
{
    protected $table = 'admin_logger';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Admin::class, 'user_id','id')->select(['id','username']);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse(date("Y-m-d H:i:s",$date))->diffForHumans();
    }

}