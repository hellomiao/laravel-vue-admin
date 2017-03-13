<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/10
 * Time: 下午4:08
 */

namespace App\Models;


use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;

class Articles extends Model
{
    protected $table = 'articles';
    protected $appends = ['url'];

    public function category()
    {
        return $this->belongsTo(Category::class,'category_id', 'id');
    }

    public function getPictureAttribute($pic)
    {
        if ($pic) {
            return \Illuminate\Support\Facades\Storage::url($pic);
        } else {
            return \Illuminate\Support\Facades\Storage::url('nopic.png');
        }
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::parse($date)->diffForHumans();
    }

    public function getUrlAttribute()
    {
        return URL::route('articles.detail',['id'=>$this->id]);

    }
}