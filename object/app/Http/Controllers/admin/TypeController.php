<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class TypeController extends Controller
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
        $ob = DB::table('type');
        // dd($request);
        // 判断请求中是否含有name字段
        if($request->has('name')){
            // 获取搜索的条件
            $name = $request->input('name');
            //添加到将要带到分页中的数组
            $where['name'] = $name;
            //给查询语句添加where条件
            $ob->where('name','like','%'.$name.'%');
        }
        //执行分页查询
        $list = $ob->paginate(5);
        // 加载模板的同时，把查询的数据，以及分页时需要携带的参数传到模板上
        return view('admin.type.index', ['list'=>$list,'where'=>$where]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.type.add');
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
            'name.required' => '分类名必须填写',
            'name.unique'  => '分类已存在',
        );

        //表单自动验证（用户提交的请求数据，验证规则，自定义的错误消息）
        $this->validate($request, [
            'name' => 'required|unique:type',
        ],$messages);
        
        $arr = $request->except('_token');
        $id = DB::table('type')->insertGetId($arr);
        if($id > 0){
            return redirect('/admin/type')->with('msg', '添加成功');
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
        $type = DB::table('type')->where('id', $id)->first();
        return view('admin.type.edit', ['type'=>$type]);
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
        $res = DB::table('type')->where('id',$id)->update($arr);
        if($res > 0){
            return redirect('/admin/type')->with('msg', '修改成功');
        }else{
            return redirect('/admin/type')->with('error', '修改失败');
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
        //用要删除的分类的id去查询有没有子分类的uPid等于他，如果有，说明你要删除的分类有子分类
        $list = DB::table('type')->where('upid',$id)->first();
        if(count($list)>0){
            //如果有子分类，不能删除，直接跳转
            return redirect('admin/type')->with('error','要删除这个分类需要先删除此分类下的子分类');
        }
        //执行删除
        $res = DB::table('type')->where('id',$id)->delete();
        if($res > 0){
            return redirect('/admin/type')->with('msg', '删除成功');
        }else{
            return redirect('/admin/type')->with('error', '删除失败');
        }
    }

    public function createSon($id)
    {
        //显示添加子分类的页面，带父分类显示出来
        $ob = DB::table('type')->where('id',$id)->first();
        return view('admin.type.addSon',['ob'=>$ob]);
    }

    public function storeSon(Request $request)
    {
        //自定义错误消息格式
        $messages = array(
            'name.required' => '分类名必须填写',
            'name.unique'  => '分类已存在',
        );

        //表单自动验证（用户提交的请求数据，验证规则，自定义的错误消息）
        $this->validate($request, [
            'name' => 'required|unique:type',
        ],$messages);
        
        $arr = $request->except('_token');
        //获取当前添加的子分类的父分类的信息
        $par = DB::table('type')->where('id',$request->input('upid'))->first();
        // 拼接出path字段
        $arr['path'] = $par->path.','.$arr['upid'];
        // 执行添加
        $id = DB::table('type')->insertGetId($arr);
        if($id > 0){
            return redirect('/admin/type')->with('msg', '添加成功');
        }
    }
}
