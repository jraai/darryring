@extends('admin.parent')
	@section('content')
			<!-- Text Input -->
                <div class="block-area" id="text-input">
                    <h3 class="block-title">修改用户</h3>
                    
                    <p>Text Inputs with different sizes by height and column.</p>
                    <form action="{{ url('admin/type').'/'.$type->id }}" method='post'>
                    	{{ csrf_field() }}
                    	{{ method_field('PUT') }}
	                    <div class="row">
	                        <div class="col-lg-6">
	                            <input type="text" class="form-control m-b-10" placeholder="姓名" name='name' value='{{ $type->name }}'>
	                        </div>                     
	                        <div class="clearfix"></div>
							<div class='col-lg-12'>
							<input type='submit' class="btn btn-block m-b-12" value='提交'>  
						</div>							
	                    </div>
						
                    </form>
                </div>		
	@endsection
