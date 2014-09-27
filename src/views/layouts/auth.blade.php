<!DOCTYPE html>
<html>
<head>
	<title>@yield('title', 'Administrator')</title>
	{{ style('css/bootstrap.min.css') }}
</head>
<body>

	<div class="container">
		@yield('content')
	</div>

    {{ script('js/jquery.js') }}
    {{ script('js/bootstrap.min.js') }}
</body>
</html>