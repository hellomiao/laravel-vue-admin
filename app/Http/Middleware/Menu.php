<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/20
 * Time: 下午5:38
 */

namespace App\Http\Middleware;

use App\Models\Admin\Admin;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Closure;
use Auth, Cache;

class Menu
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
        $request->attributes->set('adminMenuData', $this->getMenu());
        return $next($request);
    }

    /**
     * 获取左边菜单栏
     * @return array
     */
    private function getMenu()
    {

        $path_arr = explode('/', \URL::getRequest()->path());
        if (isset($path_arr[1])) {
            $urlPath = $path_arr[0] . '.' . $path_arr[1] . '.index';
        } else {
            $urlPath = $path_arr[0] . '.index';
        }
//        Cache::store('file')->forget('menus');
        $data = Cache::store('file')->get('menus', function () {
            $data = [];
            $uid = Auth::guard('admin')->user()->id;
            $user = Admin::find($uid);
            $level0 = Permission::where('parent_id', '0')->orderBy('order_num','asc')->get();
            foreach ($level0 as $key => $val) {
                $level1 = Permission::where('parent_id', $val->id)->where('is_show', 1)->orderBy('order_num','asc')->get()->toArray();
                foreach ($level1 as $k => $v) {
                    $level1[$k]['url'] = '/' . str_replace('.', '/', $v['name']);
                    if (!$user->hasPermission($v['name'])&&$uid!=1) {

                        unset($level1[$k]);
                    }
                }
                $data[$val->name] = $val->toarray();
                $data[$val->name]['children'] = $level1;
            }
            return $data;
        });
//        dd($data);
        return $data;
    }
}