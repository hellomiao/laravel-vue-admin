<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Message extends Model
{
    protected $table = 'admin_message';

    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Admin::class, 'from_uid','id')->select(['id','username','picture']);
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse(date("Y-m-d H:i:s",$date))->diffForHumans();
    }
}
