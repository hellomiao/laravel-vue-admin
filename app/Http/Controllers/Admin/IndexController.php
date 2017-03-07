<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/11
 * Time: 上午11:16
 */

namespace App\Http\Controllers\Admin;


use App\Models\Admin\Admin;
use App\Models\Admin\Permission;
use Illuminate\Support\Facades\Auth;
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
        return view('admin.index',['permissions'=>json_encode($permissionsArr)]);

    }

    public function checkAcl()
    {
        $res = [];
        $check=true;
        $path = Request::get('path');
        $routeName = implode('.', explode('/', substr($path, 1)));
        $permission = Permission::where('name',$routeName)->first();
        if($permission) {
            $check = \Gate::check($routeName);
        }
        $res['status'] = $check;
        return response()->json($res);
    }



    public function menu()
    {
        $adminMenuData = Request::get('adminMenuData');
        return response()->json($adminMenuData);
    }

}