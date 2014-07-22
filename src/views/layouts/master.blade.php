<html>
<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<title> Administrator </title>
	
    {{ style('css/bootstrap.min.css') }}
    {{ style('css/'.option('admin.theme', 'default').'.css') }}
	{{ Menu::style() }}
	
	@yield('style')

</head>
<body>
	@include('admin::partials.flashes')
	
	@if(Auth::check() && Auth::user()->isAdmin())
		@include('admin::partials.header')
	@endif

	<div class="container main-content">
		@yield('content')
	</div>

	<footer class="container">
		Copyright &COPY; {{ date('Y') }}
	</footer>

    {{ script('js/jquery.js') }}
    {{ script('js/bootstrap.min.js') }}
    {{ script('js/all.js') }}

	@yield('script')
</body>
</html>