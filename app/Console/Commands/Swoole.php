<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class Swoole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'swoole {action}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $action = $this->argument('action');
        $ws = new \swoole_websocket_server("0.0.0.0", 9501);

//监听WebSocket连接打开事件
        $ws->on('open', function ($ws, $request) {
            $uid=$request->get['uid'];
            echo "client-{$request->fd} is opened\n";
            Redis::hSet('ADMIN_USERS',$uid,$request->fd);
            var_dump(Redis::hGet('ADMIN_USERS',9));
        });

//监听WebSocket消息事件
        $ws->on('message', function ($ws, $frame) {
//            if(stripos($frame->data,'User_') !== false){
//
//                $fd = Redis::get($frame->data);
//                if($fd != null){
//                    $fd = json_decode($fd,true);
//                }
//
//                //这里的$frame->fd是指当前的websocket连接id，swoole会通过此id发送给对应的接收方，可以理解为手机号码
//                $fd[$frame->fd] = $frame->fd;
//                $fd = json_encode($fd);
//                Redis::set($frame->data,$fd);
//            }

            $data=json_decode($frame->data,true);
            $fd=Redis::hGet('ADMIN_USERS',$data['uid']);
            echo "client-{$fd} is send\n";
            $ws->push($fd,$data['text']);

        });

//监听WebSocket连接关闭事件
        $ws->on('close', function ($ws, $fd) {
            echo "client-{$fd} is closed\n";
        });

        $ws->start();;
    }
}
