<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admin';

    public function index($request)
    {
    	// 获取到用户登录时填写的用户名
    	$name = $request->input('name');
    	// 通过用户名查询数据库有没有这个用户
    	$ob = $this->where('name',$name)->first();
    	// 如果查出用户，则验证密码
    	if($ob){
    		//获取用户输入的密码和查数据库得到的密码对比
    		if($request->input('pass') == $ob->pass){
    			//返回用户信息
    			return $ob;
    		}else{
    			//返回空，密码不对
    			return null;
    		}
    	}else{
    		//返回空，查不到用户，用户名不对
    		return null;
    	}
    }
}
