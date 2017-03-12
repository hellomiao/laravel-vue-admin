<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Artisan;

class TaobaoGoods implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $goods_id;
    protected $tag;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($goods_id, $tag)
    {
        $this->goods_id = $goods_id;
        $this->tag = $tag;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $exitCode = Artisan::call('taobao:get', [
            'goods_id' => $this->goods_id, 'tag' => $this->tag
        ]);
    }
}
