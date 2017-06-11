<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['category']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'HomeController@index']);
//    if (!Request::ajax()) {
//        Route::get('{path?}', ['uses' => 'HomeController@index'])->where('path', '[\/\w\.-]*');
//    }

    Route::get('category/{category_id}', ['as'=>'category','uses' => 'HomeController@category'])->where('category_id', '[0-9]+');

    //Auth::routes();

    Route::get('archives/{id}', ['as' => 'articles.detail', 'uses' => 'ArticlesController@detail']);
    Route::get('archives/tag/{tag}', ['as' => 'articles.tag', 'uses' => 'ArticlesController@tag']);
});
