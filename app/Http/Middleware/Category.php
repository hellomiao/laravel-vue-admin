<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/20
 * Time: 下午5:38
 */

namespace App\Http\Middleware;


use Closure;
use Auth, Cache;

class Category
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $request->attributes->set('CategoryData', $this->getCate());
        return $next($request);
    }

    /**
     * 获取一级分类
     * @return array
     */
    private function getCate()
    {

        $list = \App\Models\Category::query()->where('parent_id', 0)->take(5)->get();

        $data = [];

        foreach ($list as $key => $val) {

            $data[$val->id] = $val->name;

        }

        return $data;

    }
}