<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/10
 * Time: 下午4:19
 */

namespace App\Http\Controllers\Admin;


use App\Events\AdminLogger;
use App\Http\Requests\ArticlesCreateRequest;
use App\Http\Requests\ArticlesUpdateRequest;
use App\Models\Articles;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Event;

class ArticlesController extends Controller
{
    protected $fields = [
        'title' => '',
        'category_id' => '',
        'picture' => '',
        'tags' => '',
        'info' => '',
        'content' => '',
    ];

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = array();
            $start = $request->get('start');
            $sort = $request->get('sort');
            $keyword = $request->get('keyword');
            $perPage = $request->get('perPage');
            $query = Articles::query();
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

    public function category()
    {
        $data = [];
        $category = new Category();
        $data = $category->getSelectList();
        return response()->json($data);

    }


    public function store(ArticlesCreateRequest $request)
    {
        $articles = new Articles();
        foreach (array_keys($this->fields) as $field) {
            $articles->$field = $request->get($field);
        }
        $articles->picture = upBase64Img($request->get('picture'), 'images');
        $articles->save();
        Event::fire(new AdminLogger('create', "添加了文章[{$articles->title}]"));
        $res['status'] = true;
        return response()->json($res);
    }


    public function edit(Request $request)
    {
        $id = $request->get('id');
        $articles = Articles::find($id);
        $data = $articles->toArray();

        if ($articles->category) {
            $data['category'] = ['label' => $articles->category->name, 'value' => $articles->category->id];
        }

        //$data['tags'] = explode(',', $articles->tags);

        return response()->json($data);

    }


    public function update(ArticlesUpdateRequest $request, $id)
    {
        $articles = Articles::find($id);
        foreach (array_keys($this->fields) as $field) {
            $articles->$field = $request->get($field);
        }
        $articles->picture = upBase64Img($request->get('picture'), 'images');
        $articles->save();
        Event::fire(new AdminLogger('update', "编辑了文章[{$articles->title}]"));
        $res['status'] = true;
        return response()->json($res);
    }


    public function destroy($id)
    {
        $articles = Articles::find($id);
        $articles->delete();
        Event::fire(new AdminLogger('delete', "删除了文章[{$articles->title}]"));
        $res['status'] = true;
        return response()->json($res);
    }

    /*
     * 推荐
     */
    public function isHot(Request $request)
    {
        $id = $request->get('id');
        $articles = Articles::find($id);
        $articles->is_hot == 1 ? $articles->is_hot = 0 : $articles->is_hot = 1;
        $articles->save();
        $res['status'] = true;
        return response()->json($res);

    }

}