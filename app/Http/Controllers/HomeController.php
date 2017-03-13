<?php

namespace App\Http\Controllers;

use App\Models\Articles;
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
        $data['hot'] = Articles::query()->where('is_hot',1)->orderBy('created_at','desc')->take(3)->get();
        $start = $request->get('start');
        $sort = $request->get('sort');
        $keyword = $request->get('keyword');
        $perPage = 10;
        $query = Articles::query();
        if ($keyword) {
            $query->where('title', 'LIKE', '%' . $keyword . '%');
        }
        $data['total'] = $query->count();
        $query->skip($start)->take($perPage);

        if ($sort[0]) {
            $query->orderBy($sort[0], $sort[1]);
        }
        $data['list'] = $query->get();
        return view('home',$data);
    }
}
