<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/21
 * Time: 上午11:47
 */

namespace App\Http\Controllers\Admin;

use App\Events\AdminLogger;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Role;
use Log;
use Auth;
use Illuminate\Support\Facades\Event;

class RoleController extends Controller
{
    protected $fields = [
        'name' => '',
        'description' => '',
        'permissions' => [],
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
            $query = Role::query();
            if ($keyword) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
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
     * @param RoleCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleCreateRequest $request)
    {
        // dd($request->get('permission'));
        $role = new Role();
        foreach (array_keys($this->fields) as $field) {
            $role->$field = $request->get($field);
        }
        unset($role->permissions);
        // dd($request->get('permission'));
        $role->save();
        if (is_array($request->get('permissions'))) {
            $role->permissions()->sync($request->get('permissions', []));
        }
        Event::fire(new AdminLogger('create', "添加了后台角色[{$role->name}]"));
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
        $role = Role::find($id)->toArray();
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, $id)
    {
        $role = Role::find((int)$id);
        foreach (array_keys($this->fields) as $field) {
            $role->$field = $request->get($field);
        }
        unset($role->permissions);
        $role->save();
        Event::fire(new AdminLogger('update', "编辑了后台角色[{$role->name}]"));
        $res['status'] = true;
        return response()->json($res);
    }

    public function getAcl(Request $request)
    {
        $id = $request->get('id');
        $data = [];
        $role = Role::find($id);
        $data['tree'] = $role->getTreeData();
        return response()->json($data);

    }
    /*
  * 设置权限
  */
    public function setAcl(Request $request){
        $id = $request->get('id');
        $role = Role::find($id);
        $role->permissions()->sync($request->get('permissions',[]));
        Event::fire(new AdminLogger('acl', "设置了后台权限[{$role->name}]"));
        $res['status'] = true;
        return response()->json($res);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find((int)$id);
        $role->delete();
        Event::fire(new AdminLogger('delete', "删除了后台角色[{$role->name}]"));
        $res['status'] = true;
        return response()->json($res);

    }

}

