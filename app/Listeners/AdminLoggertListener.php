<?php

namespace App\Listeners;

use App\Events\AdminLogger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class AdminLoggertListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->user_id = auth('admin')->user()->id;

    }

    /**
     * Handle the event.
     *
     * @param  AdminLogger  $event
     * @return void
     */
    public function handle(AdminLogger $event)
    {
        $model = $event->model;
        $model->user_id = auth('admin')->user()->id;
        $model->catalog = $event->catalog;
        $model->url = url()->current();
        $model->intro = $event->intro;
        $model->ip = request()->ip();
        $model->created_at = time();
        $model->save();

    }
}
