<?php
namespace App\Handlers;

/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/7
 * Time: 上午10:42
 */
use App\Models\Admin\Message;
use Illuminate\Support\Facades\Redis;

class SwooleHandler
{
    public function onOpen($ws, $request)
    {
        $uid = $request->get['uid'];
        echo "client-{$request->fd} is opened\n";
        Redis::hSet('ADMIN_USERS', $uid, $request->fd);
        var_dump(Redis::hGet('ADMIN_USERS', 9));
    }

    public function onMessage($ws, $frame)
    {
        $uid=$frame->data;
        $fd = Redis::hGet('ADMIN_USERS', $uid);
        echo "client-{$fd} is send\n";
        $num=Message::query()->where('to_uid',$uid)->count();
        $ws->push($fd, $num);
    }

    public function onClose($ws, $fd)
    {
        echo "client-{$fd} is closed\n";
        $all = Redis::hGetAll('ADMIN_USERS');
        foreach ($all as $key => $val) {
            if ($fd == Redis::hGet('ADMIN_USERS', $key)) {
                Redis::hDel('ADMIN_USERS', $key);
                echo "del {$key}";
            }
        }
    }

}