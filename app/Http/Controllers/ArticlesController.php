<?php
/**
 * Created by PhpStorm.
 * User: yangchunrun
 * Date: 17/3/10
 * Time: 下午4:01
 */

namespace App\Http\Controllers;


class ArticlesController extends Controller
{

    public function detail(){
        return view('articles.detail');
    }

}