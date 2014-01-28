<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		@yield('title', 'Administrator')
	</title>

	{{ Admin::style('bootstrap/css/bootstrap.css') }}
	{{ Admin::style('css/style.css') }}

	@yield('style')

</head>

<body>

	@yield('main', 'Contest is empty.')

	{{ Admin::script('js/jquery.js') }}
	{{ Admin::script('bootstrap/js/bootstrap.min.js') }}
	{{ Admin::script('js/admin.js') }}

	@yield('script')
	
</body>
</html>