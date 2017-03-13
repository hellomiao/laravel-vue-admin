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

Route::get('/', ['as'=>'home','uses' => 'HomeController@index']);

Auth::routes();
Route::get('archives/{id}', ['as'=>'articles.detail','uses' => 'ArticlesController@detail']);
Route::get('archives/tag/{tag}', ['as'=>'articles.tag','uses' => 'ArticlesController@tag']);
