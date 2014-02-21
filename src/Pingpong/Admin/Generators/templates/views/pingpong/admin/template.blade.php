<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		@yield('title', 'Administrator')
	</title>

	{{ AdminHelper::style('bootstrap/css/bootstrap.css') }}
	{{ AdminHelper::style('css/style.css') }}

	@yield('style')

</head>

<body>

	@yield('main', 'Contest is empty.')

	{{ AdminHelper::script('js/jquery.js') }}
	{{ AdminHelper::script('bootstrap/js/bootstrap.min.js') }}
	{{ AdminHelper::script('js/admin.js') }}

	@yield('script')
	
</body>
</html>
