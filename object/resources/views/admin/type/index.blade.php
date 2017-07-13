@extends('admin.parent')
	@section('content')
		<ol class="breadcrumb hidden-xs">
		<li>
		<a href="#">Home</a>
		</li>
		<li>
		<a href="#">Library</a>
		</li>
		<li class="active">Data</li>
		</ol>
		<h4 class="page-title">TABLES</h4>

		<!-- Deafult Table -->
                <div class="block-area" id="defaultStyle">
                    <h3 class="block-title">分类列表</h3>
					@if (session('msg'))
					    <div class="alert alert-success">
					        {{ session('msg') }}
					    </div>
					@endif
					@if (session('error'))
					    <div class="alert alert-danger">
					        {{ session('error') }}
					    </div>
					@endif
					<form name='myform' action="" style='display:none' method='post'>
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
					</form>
					<!-- 搜索	 -->
					<form action="/type">
						<div class='medio-body'>
							类别名：<input type="text" class='form-control input-sm m-b-10' name='name'>
						</div>					
						<input type="submit" class='btn m-b-10' value='搜索'>
					</form>          
                    <table class="table tile">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>类别名</th>
                                <th>路径</th>
                                <th>父id</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list as $v)
								<tr>
	                                <td>{{ $v->id }}</td>
	                                <td>{{ $v->name }}</td>
	                                <td>{{ $v->path }}</td>
	                                <td>{{ $v->upid }}</td>
	                                <td>
										<a class="btn m-r-5" href='javascript:doDel({{ $v->id }})'>删除</a>
										<a class="btn m-r-5" href='{{ url("admin/type")."/".$v->id }}/edit'>修改</a>
										<a class="btn m-r-5" href='{{ url("admin/typeSon")."/".$v->id }}'>添加子分类</a>
	                                </td>
	                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {!! $list->appends($where)->render() !!}
                </div>
                <script>
                	function doDel(id)
                	{
                		if(confirm('你确定要删除吗？')){
                			var form = document.myform;
                			var url = "{{ url('admin/type') }}";
                			form.action = url+'/'+id;
                			form.submit();
                		}
                	}
                </script>	
	@endsection
