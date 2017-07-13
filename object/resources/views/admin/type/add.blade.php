@extends('admin.parent')
	@section('content')
			<!-- Text Input -->
                <div class="block-area" id="text-input">
                    <h3 class="block-title">添加类别</h3>
                    @if (count($errors) > 0)
					    <div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
					    </div>
					@endif

                    <p>Text Inputs with different sizes by height and column.</p>
                    <form action="{{ url('admin/type') }}" method='post'>
                    	{{ csrf_field() }}
	                    <div class="row">
	                        
	                        <div class="col-lg-6">
	                            <input type="text" class="form-control m-b-10" placeholder="分类名" name='name'>
	                        </div>
							<div class="col-lg-6">
	                            <input type="hidden" class="form-control m-b-10" value='0' name='path'>
	                        </div>
	                        <div class="clearfix"></div>                     
							<div class="col-lg-6">
	                            <input type="hidden" class="form-control m-b-10" name='upid' value='0'>
	                        </div>
							<div class='col-lg-12'>
							<input type='submit' class="btn btn-block m-b-12" value='提交'>  
						</div>							
	                    </div>
						
                    </form>
                </div>		
	@endsection
