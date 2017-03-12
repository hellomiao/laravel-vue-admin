<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/2/21
 * Time: 上午11:47
 */
namespace App\Http\Controllers\Admin;

use App\Events\AdminLogger;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use Cache, Event;

class CategoryController extends Controller
{
    protected $fields = [
        'name' => '',
        'parent_id' => 0,
        'order_num' => 0,
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $category = new Category();
        $data['tree'] = $category->getTreeData();
        $data['select'] = $category->getSelectList();
        return response()->json($data);

    }



    public function store(Requests\CategoryCreateRequest $request)
    {
        $category = new Category();
        foreach (array_keys($this->fields) as $field) {
            $category->$field = $request->get($field, $this->fields[$field]);
        }
        $category->save();
        Event::fire(new AdminLogger('create', "添加了分类[$category->name]"));
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
        $category = Category::find($id);
        $data = $category->toarray();
        if ($category->parent_id != 0) {
            $parent = Category::find($category->parent_id);
            $data['parent'] = ['label' => $parent->display_name, 'value' => $category->parent_id];
        }
        unset($category);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PermissionUpdateRequest|Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\CategoryUpdateRequest $request, $id)
    {
        $category = Category::find($id);
        foreach (array_keys($this->fields) as $field) {
            $category->$field = $request->get($field, $this->fields[$field]);
        }
        $category->save();
        Event::fire(new AdminLogger('update', "编辑了分类[$category->name]"));
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
        $child = Category::where('parent_id', $id)->first();
        if ($child) {
            $res['status'] = false;
            $res['msg'] = '请先将该分类的子分类删除后再做删除操作!';
        }
        $category = Category::find($id);
        $category->delete();
        Event::fire(new AdminLogger('delete', "删除了分类[$category->name]"));
        $res['status'] = true;
        return response()->json($res);
    }
}