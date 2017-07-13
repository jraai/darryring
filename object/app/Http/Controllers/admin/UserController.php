<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //保存搜索条件
        $where = [];
        //实例化需要的表
        $ob = DB::table('admin');
        // dd($request);
        // 判断请求中是否含有name字段
        if($request->has('zname')){
            // 获取搜索的条件
            $zname = $request->input('zname');
            //添加到将要带到分页中的数组
            $where['zname'] = $name;
            //给查询语句添加where条件
            $ob->where('zname','like','%'.$zname.'%');
        }
        if($request->has('name')){
            $name = $request->input('name');
            $where['name'] = $name;
            $ob->where('name',$name);
        }
        //执行分页查询
        $list = $ob->paginate(3);
        // 加载模板的同时，把查询的数据，以及分页时需要携带的参数传到模板上
        return view('admin.user.index', ['list'=>$list,'where'=>$where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //自定义错误消息格式
        $messages = array(
            'zname.required' => '姓名必须填写',
            'name.unique'  => '用户名已存在',
            'name.required' => '用户名必须填写'
        );

        //表单自动验证（用户提交的请求数据，验证规则，自定义的错误消息）
        $this->validate($request, [
            'zname' => 'required',
            'name' => 'required|unique:admin',
        ],$messages);
        
        $arr = $request->except('_token');

        $id = DB::table('admin')->insertGetId($arr);

        if($id > 0){
            return redirect('/admin/users')->with('msg', '添加成功');
        }
    }

 //    public function messages()
    // {
    //     return [
    //         'name.required' => '用户名必须填写',
    //         'name.unique'  => '用户已存在',
    //         'age.required' => '年龄必须填写',
    //     ];
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = DB::table('admin')->where('id', $id)->first();
        return view('admin.user.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $arr = $request->except('_token', '_method');
        $res = DB::table('admin')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('/admin/users')->with('msg', '修改成功');
        }else{
            return redirect('/admin/users')->with('error', '修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $res = DB::table('admin')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/admin/users')->with('msg', '删除成功');
        }else{
            return redirect('/admin/users')->with('error', '删除失败');
        }
    }

    // public function del($id)
    // {

    // }
}
