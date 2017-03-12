<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/9
 * Time: 上午10:28
 */

namespace App\Http\Controllers\Admin;

use App\Events\AdminLogger;
use App\Jobs\TaobaoGoods;
use App\Models\Goods;
use App\Models\GoodsThird;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Event;


class GoodsController extends Controller
{
    protected $fields = [
        'name' => '',
        'price' => '',
        'tag' => '',
        'picture' => '',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $start = $request->get('start');
            $sort = $request->get('sort');
            $keyword = $request->get('keyword');
            $perPage = $request->get('perPage');
            $query = Goods::query();
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\GoodsCreateRequest $request)
    {

        $res = [];
        $goods = new Goods();
        foreach (array_keys($this->fields) as $field) {
            $goods->$field = $request->get($field);
        }
        $goods->picture = upBase64Img($request->get('picture'), 'goods');
        $goods->save();

        Event::fire(new AdminLogger('create', "添加了商品[{$goods->name}]"));
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
        $goods = Goods::find($id);
        $data = $goods->toArray();
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


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\GoodsUpdateRequest $request, $id)
    {
        $goods = Goods::find($id);
        foreach (array_keys($this->fields) as $field) {
            $goods->$field = $request->get($field);
        }
        $goods->picture = upBase64Img($request->get('picture'), 'goods');
        $goods->save();
        Event::fire(new AdminLogger('update', "编辑了商品[{$goods->name}]"));
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
        $goods = Goods::find((int)$id);
        $goods->delete();
        GoodsThird::query()->where('goods_id',$id)->delete();
        Event::fire(new AdminLogger('delete', "删除了商品[{$goods->name}]"));
        $res['status'] = true;
        return response()->json($res);
    }


    public function tag(Request $request)
    {
        if ($request->ajax()) {
            $id =$request->get('id');
            $data = array();
            $start = $request->get('start');
            $sort = $request->get('sort');
            $keyword = $request->get('keyword');
            $perPage = $request->get('perPage');
            $query = GoodsThird::query()->where('goods_id',$id);
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

    public function tagInfo(Request $request)
    {
        $id = $request->get('id');
        $goods = GoodsThird::find($id);
        $data = $goods->toArray();
        return response()->json($data);

    }


    public function tagRun(Request $request)
    {

        $id =$request->get('id');
        GoodsThird::query()->where('goods_id',$id)->delete();
        $tag =$request->get('tag');
        $this->dispatch(new TaobaoGoods($id,$tag))->delay(Carbon::now()->addMinutes(1));;
        $res['status']=true;
        return response()->json($res);
    }


}