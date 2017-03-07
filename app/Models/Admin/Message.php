<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'admin_message';

    public $timestamps = false;

    public function getSendAtAttribute($date)
    {
        return Carbon::parse(date("Y-m-d H:i:s",$date))->diffForHumans();
    }
}
