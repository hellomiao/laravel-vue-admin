<?php

namespace App\Console\Commands;

use App\Models\GoodsThird;
use Illuminate\Console\Command;
use GuzzleHttp\Client;
use GuzzleHttp\Pool;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;
use QL\QueryList;
use vakata\database\Exception;

class Taobao extends Command
{
    private $totalPageCount;
    private $counter = 1;
    private $concurrency = 8;  // 同时并发抓取

    private $apiUrl = 'https://s.m.taobao.com/search?tab=all&sst=1&n=20&buying=buyitnow&m=api4h5&abtest=28&wlsort=28&sort=_sale';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taobao:get {goods_id} {tag}';

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


        $client = new Client();

        $content = file_get_contents($this->apiUrl);

        $content = json_decode($content, true);

        $this->totalPageCount = $content['totalPage'];

        $requests = function ($total) use ($client) {
            $q = $this->argument('tag');
            $q=urlencode($q);
            for ($i = 1; $i <= $this->totalPageCount; $i++) {
                $uri = $this->apiUrl .'&q='.$q. "&page=" . $i;
                yield function () use ($client, $uri) {
                    return $client->getAsync($uri);
                };
            }

        };

        $pool = new Pool($client, $requests($this->totalPageCount), [
            'concurrency' => $this->concurrency,
            'fulfilled' => function ($response, $index) {

                $res = json_decode($response->getBody()->getContents(), true);


                $list = $res['listItem'];

                DB::transaction(function () use ($list) {

                    $goods_id = $this->argument('goods_id');


                    foreach ($list as $key => $val) {

                        $isB2c = $val['isB2c'];
                        $item_id = $val['item_id'];

                        $durl = 'http://hws.m.taobao.com/cache/wdetail/5.0/?id=' . $item_id;

                        $this->info("链接:{$durl}\n");

                        $client = new Client();
                        $res = $client->request('GET', $durl, [
                        ]);

                        $detail = json_decode($res->getBody()->getContents(), true);


                        $favCount = 0;
                        $sku = '';

                        if (isset($detail['data']['skuModel']['skuProps'])) {

                            $skuArr = $detail['data']['skuModel']['skuProps'][0]['values'];


                            foreach ($skuArr as $kk => $vv) {
                                $sku .= $vv['name'] . ',';
                            }

                            $sku = substr($sku, 0, -1);

                        }

                        $favCount = $detail['data']['itemInfoModel']['favcount'];
                        $location = $detail['data']['itemInfoModel']['location'];
                        $shop_title = $detail['data']['seller']['shopTitle'];

                        $goodsThird = new GoodsThird();
                        $goodsThird->goods_id = $goods_id;
                        $goodsThird->name = $val['title'];
                        $goodsThird->price = $val['price'];
                        $goodsThird->sales = $val['sold'];
                        $goodsThird->fav_num = $favCount;
                        $goodsThird->props = $sku;
                        $goodsThird->location = $location;
                        $goodsThird->shop_title = $shop_title;
                        $goodsThird->item_id = $item_id;
                        $goodsThird->save();


                        $this->info("商品:{$val['title']} 价格:{$val['price']} 出售:{$val['sold']} 收藏:{$favCount} 属性:{$sku}");

                    }

                });

                $this->stop();
            },
            'rejected' => function ($reason, $index) {
                $this->error("rejected");
                $this->error("rejected reason: " . $reason);
                $this->stop();

            },
        ]);

        // 开始发送请求
        $promise = $pool->promise();
        $promise->wait();
    }


    public function stop()
    {
        if ($this->counter < $this->totalPageCount) {
            $this->counter++;
            return;
        }
        $this->info("请求结束！");
    }


}
