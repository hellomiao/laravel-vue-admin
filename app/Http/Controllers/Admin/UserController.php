<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/21
 * Time: 上午11:46
 */

namespace App\Http\Controllers\Admin;

use App\Events\AdminLogger;
use App\Models\Admin\Logger;
use App\Models\Admin\Role;
use App\Models\Admin\Admin as User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    protected $fields = [
        'username' => '',
        'name' => '',
        'phone' => '',
        'roles' => [],
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $start = $request->get('start');
            $sort = $request->get('sort');
            $keyword = $request->get('keyword');
            $perPage = $request->get('perPage');
            $query = User::query();
            if ($keyword) {
                $query->where('username', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('name', 'LIKE', '%' . $keyword . '%');
            }
            $data['total'] = $query->count();
            $query->skip($start)->take($perPage);

            if ($sort[0]) {
                $query->orderBy($sort[0], $sort[1]);
            }
            $data['data'] = $query->get();

            return response()->json($data);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\AdminCreateRequest $request)
    {

        $res = [];
        $user = new User();
        foreach (array_keys($this->fields) as $field) {
            $user->$field = $request->get($field);
        }

        $user->password = bcrypt($request->get('password'));
        unset($user->roles);
        $user->save();
        $roles = $request->get('roles');
        if (!empty($roles)) {
            $user->giveRoleTo($roles);
        }
        Event::fire(new AdminLogger('create', "添加了后台用户[{$user->username}]"));
        $res['status'] = true;
        return response()->json($res);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $user = User::find($id);
        $roles = [];
        $roleStr = [];
        if ($user->roles) {
            foreach ($user->roles as $v) {
                $roles[] = ['label' => $v->name, 'value' => $v->id];
                $roleStr[] = $v->name;
            }

        }
        $data = $user->toArray();
        $data['roles'] = $roles;
        $data['rolesStr'] = $id == 1 ? '管理员' : (!empty($roleStr) ? implode(',', $roleStr) : '未分配');
        return response()->json($data);

    }

    public function info()
    {
        $id = Auth::guard('admin')->user()->id;
        $user = User::find($id);
        $roles = [];
        $roleStr = [];
        if ($user->roles) {
            foreach ($user->roles as $v) {
                $roleStr[] = $v->name;
            }
        }
        $data = $user->toArray();
        $data['rolesStr'] = $id == 1 ? '管理员' : (!empty($roleStr) ? implode(',', $roleStr) : '未分配');
        return response()->json($data);

    }

    public function set(Requests\AdminUpdateRequest $request)
    {
        $id = Auth::guard('admin')->user()->id;
        $user = User::find($id);
        foreach (array_keys($this->fields) as $field) {
            $user->$field = $request->get($field);
        }
        unset($user->roles);
        if ($request->get('password') != '') {
            $user->password = bcrypt($request->get('password'));
        }
        $user->picture = upBase64Img($request->get('picture'), 'admin/avatar');
        $user->save();
        $roles = $request->get('roles');
        if (!empty($roles)) {
            $user->giveRoleTo($roles);
        }
        Event::fire(new AdminLogger('update', "用户[{$user->username}]更新了设置"));
        $res['status'] = true;
        return response()->json($res);

//        return redirect('/admin/user')->withSuccess('添加成功！');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\AdminUpdateRequest $request, $id)
    {
        $user = User::find($id);
        foreach (array_keys($this->fields) as $field) {
            $user->$field = $request->get($field);
        }
        unset($user->roles);
        if ($request->get('password') != '') {
            $user->password = bcrypt($request->get('password'));
        }
        $user->picture = upBase64Img($request->get('picture'), 'admin/avatar');
        $user->save();
        $roles = $request->get('roles');
        if (isset($roles)) {
            $user->giveRoleTo($roles);
        }
        Event::fire(new AdminLogger('update', "编辑了后台用户[{$user->username}]"));
        $res['status'] = true;
        return response()->json($res);

//        return redirect('/admin/user')->withSuccess('添加成功！');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find((int)$id);
        $user->delete();
        Event::fire(new AdminLogger('delete', "删除了后台用户[{$user->username}]"));
        $res['status'] = true;
        return response()->json($res);
    }

    /*
     * 获取角色列表
     */
    public function role()
    {

        return response()->json(Role::all()->toArray());

    }

    public function logger(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $start = $request->get('start');
            $sort = $request->get('sort');
            $keyword = $request->get('keyword');
            $perPage = $request->get('perPage');
            $query = Logger::query()->with('users');
            if ($keyword) {
                $query->where('catalog', 'LIKE', '%' . $keyword . '%')
                    ->orWhere('intro', 'LIKE', '%' . $keyword . '%');
            }
            $data['total'] = $query->count();
            $query->skip($start)->take($perPage);

            if ($sort[0]) {
                $query->orderBy($sort[0], $sort[1]);
            }
            $data['data'] = $query->get();
            return response()->json($data);
        }
    }


    public function send(Request $request)
    {

        $uid = $request->get('uid');
        $msg = $request->get('text');
        adminMsg($uid, $msg);
        $res['status'] = true;
        return response()->json($res);

    }
}
