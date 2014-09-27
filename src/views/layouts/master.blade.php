<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Administrator')</title>

    <!-- Bootstrap Core CSS -->
    {{ style('css/bootstrap.min.css') }}

    <!-- Custom CSS -->
    {{ style('css/admin.css') }}

    <!-- Custom Fonts -->
    {{ style('font-awesome-4.1.0/css/font-awesome.min.css') }}
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div id="wrapper">

    @include('admin::partials.navigation')

    <div id="page-wrapper">

        <div class="container-fluid">

            @yield('content')

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery Version 1.11.0 -->
{{ script('js/jquery.js') }}

<!-- Bootstrap Core JavaScript -->
{{ script('js/bootstrap.min.js') }}

{{-- Admin Script --}}
{{ script('js/admin.js') }}

</body>

</html>
