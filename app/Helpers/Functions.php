<?php

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/6
 * Time: 上午11:54
 */

function upBase64Img($base64_image_content, $path = 'images')
{

    if (preg_match('/^(data:\s*image\/(\w+);base64,)/', $base64_image_content, $result)) {
        $type = $result[2];
        $name = date('YmdHis') . microtime(true) . rand(100, 999) . '.' . $type;
        $new_file = $path . '/' . $name;
        $res = \Illuminate\Support\Facades\Storage::disk('local')->put($new_file, base64_decode(str_replace($result[1], '', $base64_image_content)));
        //return \Illuminate\Support\Facades\Storage::url($new_file);
        return $new_file;
    }

}


function adminMsg($toUid, $msg, $title = '')
{
    $rs=\Illuminate\Support\Facades\Event::fire(new \App\Events\AdminMessage($toUid, $msg));

}
