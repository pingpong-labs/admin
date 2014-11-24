<!DOCTYPE html>
<html class="bg-black">
    <head>
        <meta charset="UTF-8">
        <title>Administrator| Login</title>
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{{ admin_asset('components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ admin_asset('components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet"
type="text/css"/>
        <!-- Theme style -->
        <link href="{{ admin_asset('adminlte/css/AdminLTE.css') }}" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bg-black">

        <div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            {{ Form::open(['route' => 'admin.login.store']) }}
                <div class="body bg-gray">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"/>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>          
                    <div class="form-group checkbox" style="margin-left:20px;">
                        <input type="checkbox" name="rememner" value="1" /> Remember me
                    </div>
                </div>
                <div class="footer">                                                               
                    <button type="submit" class="btn bg-olive btn-block">Sign me in</button>  
                    <!-- 
                    <p><a href="#">I forgot my password</a></p>
                    
                    <a href="register.html" class="text-center">Register a new membership</a> -->
                </div>
            {{ Form::close() }}

            <div class="margin hidden text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>

        <script src="{{ admin_asset('components/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ admin_asset('components/bootstrap/dist/js/bootstrap.min.js') }}" type="text/javascript"></script>

    </body>
</html>