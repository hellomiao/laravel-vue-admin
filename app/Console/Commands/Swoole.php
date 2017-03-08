<?php

namespace App\Console\Commands;

use App\Handlers\SwooleHandler;
use Illuminate\Console\Command;


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
    protected $description = '后台消息推送socket';

    protected $ws;

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
        $this->ws = new \swoole_websocket_server("0.0.0.0", 9501);
        $this->ws->set(['worker_num' => 8]);
        switch ($action) {
            case 'start':
                $handler = new SwooleHandler();
                $this->ws->on('Open', [$handler, 'onOpen']);
                $this->ws->on('Message', [$handler, 'onMessage']);
                $this->ws->on('Close', [$handler, 'onClose']);
                $this->ws->start();;
                break;
            case 'reload':
                $this->ws->reload();;
                break;
            case 'stop':
                $this->ws->stop();;
                break;
        }

    }
}
