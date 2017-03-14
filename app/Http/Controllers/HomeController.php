<?php

namespace App\Http\Controllers;

use App\Models\Articles;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = array();
        $params = $request->all();
        if ($request->ajax()) {
            $list = $this->getList($params);
            return response()->json($list);
        }
        $data['hot'] = Articles::query()->where('is_hot', 1)->orderBy('created_at', 'desc')->take(3)->get();
        return view('home', $data);
    }

    public function category(Request $request, $category_id)
    {
        $params = $request->all();
        $params['category_id'] = $category_id;
        if ($request->ajax()) {
            $list = $this->getList($params);
            return response()->json($list);
        }
        $category = Category::find($category_id);
        return view('category', ['category'=> $category]);
    }
    /*
     * 获取文章列表
     */

    public function getList($params)
    {

        $keyword = isset($params['keyword']) ? $params['keyword'] : '';
        $category_id = isset($params['category_id']) ? $params['category_id'] : '';
        $page = $params['page'];
        $perPage = 10;
        $start = ($page - 1) * $perPage;
        $query = Articles::query();
        if ($category_id) {
            $query->where('category_id', $category_id);
        }
        if ($keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        $query->skip($start)->take($perPage);

        $list = $query->get();
        return $list;

    }
}



