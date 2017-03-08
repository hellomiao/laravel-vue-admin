<?php

namespace App\Listeners;


use App\Events\AdminMessage;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;


class AdminMessageListener
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
     * @param  AdminMessage $event
     * @return void
     */
    public function handle(AdminMessage $event)
    {
        $model = $event->model;
        $model->from_uid =auth('admin')->user()->id;
        $model->to_uid = $event->to_uid;
        $model->content = $event->content;
        $model->created_at = time();
        $model->save();

    }
}
