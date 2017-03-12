<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/11
 * Time: 上午11:16
 */

namespace App\Http\Controllers\Admin;


use App\Models\Admin\Admin;
use App\Models\Admin\Message;
use App\Models\Admin\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;


class IndexController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {

        $permissionsArr = [];
        $uid = Auth::guard('admin')->user()->id;
        $user = Admin::find($uid);
        $permissions = Permission::all();
        foreach ($permissions as $key => $val) {
            if ($user->hasPermission($val->name)) {

                array_push($permissionsArr, $val->name);
            }
        }
        $msgNum = Message::query()->where('to_uid', $uid)->count();
        return view('admin.index', ['permissions' => json_encode($permissionsArr), 'msgNum' => $msgNum]);

    }

    /*
     * 请求权限检查
     */

    public function checkAcl()
    {
        $res = [];
        $check = true;
        $path = Request::get('path');
        $routeName = implode('.', explode('/', substr($path, 1)));
        $permission = Permission::where('name', $routeName)->first();
        if ($permission) {
            $check = \Gate::check($routeName);
        }
        $res['status'] = $check;
        return response()->json($res);
    }

    /*
     * 获取侧边菜单
     */
    public function menu()
    {
        $adminMenuData = Request::get('adminMenuData');
        return response()->json($adminMenuData);
    }

    /*
     * 获取10条消息
     */
    public function msg()
    {
        $uid = auth('admin')->user()->id;

        $list = Message::query()->with('users')->where('to_uid', $uid)->where('is_read', 0)
            ->orderBy('created_at', 'desc')->take(10)->get();

        return response()->json($list);
    }


    public function upImg()
    {
        $file = Request::file('wangEditorH5File');
        $allowed_extensions = ["png", "jpg", "gif"];
        if ($file->getClientOriginalExtension() && !in_array($file->getClientOriginalExtension(), $allowed_extensions)) {
            return 'error|You may only upload png, jpg or gif.';
        }
        $destinationPath = 'files/images/';
        $extension = $file->getClientOriginalExtension();
        $fileName = date('ymdHis') . microtime(true) . rand(10, 99) . '.' . $extension;
        $file->move($destinationPath, $fileName);
        return asset($destinationPath . $fileName);
    }

}