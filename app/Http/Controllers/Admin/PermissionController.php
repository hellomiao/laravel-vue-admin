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
use App\Http\Requests\PermissionCreateRequest;
use App\Http\Requests\PermissionUpdateRequest;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use Cache, Event;

class PermissionController extends Controller
{
    protected $fields = [
        'name' => '',
        'display_name' => '',
        'parent_id' => 0,
        'icon' => '',
        'is_show' => '',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $level = 0)
    {
        $data = [];
        $permission = new Permission();
        $data['tree'] = $permission->getTreeData();
        $data['select'] = $permission->getSelectList();
        return response()->json($data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($cid)
    {
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field, $default);
        }
        $data['cid'] = $cid;
        return view('admin.permission.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PremissionCreateRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionCreateRequest $request)
    {
        $permission = new Permission();
        foreach (array_keys($this->fields) as $field) {
            $permission->$field = $request->get($field, $this->fields[$field]);
        }
        $permission->save();
        Event::fire(new AdminLogger('create', "添加了后台权限[$permission->name]"));
        $res['status'] = true;
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $permission = Permission::find($id);
        $data = $permission->toarray();
        if ($permission->parent_id != 0) {
            $parent = Permission::find($permission->parent_id);
            $data['parent'] = ['label' => $parent->display_name, 'value' => $permission->parent_id];
        }
        unset($permission);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionUpdateRequest $request, $id)
    {
        $permission = Permission::find($id);
        foreach (array_keys($this->fields) as $field) {
            $permission->$field = $request->get($field, $this->fields[$field]);
        }
        $permission->save();
        Event::fire(new AdminLogger('update', "编辑了后台权限[$permission->name]"));
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
        $child = Permission::where('parent_id', $id)->first();
        if ($child) {
            $res['status'] = false;
            $res['msg'] = '请先将该权限的子权限删除后再做删除操作!';
        }
        $permission = Permission::find($id);
        foreach ($permission->roles as $v) {
            $permission->roles()->detach($v->id);
        }
        $permission->delete();
        Event::fire(new AdminLogger('create', "添加了后台权限[$permission->name]"));
        $res['status'] = true;
        return response()->json($res);
    }
}