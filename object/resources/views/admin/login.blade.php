<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta name="format-detection" content="telephone=no">
        <meta charset="UTF-8">

        <meta name="description" content="Violate Responsive Admin Template">
        <meta name="keywords" content="Super Admin, Admin, Template, Bootstrap">

        <title>Super Admin Responsive Template</title>
            
        <!-- CSS -->
        <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/form.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('admin/css/generics.css') }}" rel="stylesheet"> 
    </head>
    <body id="skin-blur-violate">
        <section id="login">
            <header>
                <h1>SUPER ADMIN</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
            </header>
        
            <div class="clearfix"></div>
            
            <!-- Login -->
            <form class="box tile animated active" id="box-login" action='{{ url("admin/login") }}' method='post'>
            	{{ csrf_field() }}
                <h2 class="m-t-0 m-b-15">
					@if(session('msg'))
						{{ session('msg') }}
					@else
						登录
					@endif
                </h2>
                <input type="text" class="login-control m-b-10" placeholder="Username or Email Address" name='name'>
                <input type="password" class="login-control" placeholder="Password" name='pass'>
                请输入验证码：
                <div class='row'>
					<div class='col-xs-4'>
						<input type="text" class='login-control' name='mycode'>
					</div>
					<div class='col-xs-4'>
						<img src="{{ url('admin/capth/'.time()) }}" onclick="this.src='{{ url('admin/capth') }}/'+Math.random()">
					</div>
                </div>
                <div class="checkbox m-b-20">
                    <label>
                        <input type="checkbox">
                        记住我
                    </label>
                </div>
                <button class="btn btn-sm m-r-5">登录</button>
                
                <small>
                    <a class="box-switcher" data-switch="box-register" href="">还没有账号？</a> or
                    <a class="box-switcher" data-switch="box-reset" href="">忘记密码？</a>
                </small>
            </form>
            
            <!-- Register -->
            <form class="box animated tile" id="box-register">
                <h2 class="m-t-0 m-b-15">Register</h2>
                <input type="text" class="login-control m-b-10" placeholder="Full Name">
                <input type="text" class="login-control m-b-10" placeholder="Username">
                <input type="email" class="login-control m-b-10" placeholder="Email Address">    
                <input type="password" class="login-control m-b-10" placeholder="Password">
                <input type="password" class="login-control m-b-20" placeholder="Confirm Password">

                <button class="btn btn-sm m-r-5">Register</button>

                <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small>
            </form>
            
            <!-- Forgot Password -->
            <form class="box animated tile" id="box-reset">
                <h2 class="m-t-0 m-b-15">Reset Password</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
                <input type="email" class="login-control m-b-20" placeholder="Email Address">    

                <button class="btn btn-sm m-r-5">Reset Password</button>

                <small><a class="box-switcher" data-switch="box-login" href="">Already have an Account?</a></small>
            </form>
        </section>                      
        
        <!-- Javascript Libraries -->
        <!-- jQuery -->
        <script src="{{ asset('admin/js/jquery.min.js') }}"></script> <!-- jQuery Library -->
        
        <!-- Bootstrap -->
        <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
        
        <!--  Form Related -->
        <script src="{{ asset('admin/js/icheck.js') }}"></script> <!-- Custom Checkbox + Radio -->
        
        <!-- All JS functions -->
        <script src="{{ asset('admin/js/functions.js') }}"></script>
    </body>
</html>
