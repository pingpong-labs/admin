<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title> Login </title>
    
    {{ style('css/bootstrap.min.css') }}
    
    @yield('style')

</head>
<body>
    @include('admin::partials.flashes')

    <div class="container">
        @yield('content')
    </div>

    {{ script('js/jquery.js') }}
    {{ script('js/bootstrap.min.js') }}

    @yield('script')
</body>
</html>