<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/10
 * Time: 下午4:01
 */

namespace App\Http\Controllers;


use App\Models\Articles;

class ArticlesController extends Controller
{

    public function detail($id){
        $articles = Articles::find($id);
        $articles->tags = explode(',',$articles->tags);
        return view('articles.detail',['articles'=>$articles]);
    }

}