<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
	//返回前台页面
    return '111';
});

//后台群组
Route::group(['prefix' => 'admin','middleware' => 'login'], function(){
	//后台首页
	Route::get('/index', 'admin\AdminController@index');
	//后台注销
	Route::get('/over', 'admin\LoginController@over');
	//后台用户管理
	Route::resource('/users', 'admin\UserController');
	//分类管理
	Route:resource('type', 'admin\TypeController');
});


//后台登录
Route::get('admin/login', 'admin\LoginController@index');
Route::post('admin/login', 'admin\LoginController@doLogin');
Route::get('admin/capth/{tmp}', 'admin\LoginController@capth');

