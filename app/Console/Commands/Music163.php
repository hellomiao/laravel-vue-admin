<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
Use QL\QueryList;

class Music163 extends Command
{

    private $uri='http://music.163.com';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'music {action}';

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
        $hj = QueryList::Query($this->uri.'/discover/playlist',array("title"=>array('.dec a.tit','text')));
        print_r($hj->data);
    }
}
