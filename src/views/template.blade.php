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

	<!-- Fixed navbar -->
	<div class="navbar navbar-danger navbar-fixed-top" role="navigation">
		<div class="container middle-content">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('admin') }}">
				{{ Config::get('admin::admin.title') }}
				</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
				@foreach (Config::get('admin::admin.menus') as $key => $value)
					{{-- */ $submenu = Config::get('admin::admin.submenus.'.$key) /* --}}
					@if(!empty($submenu))
					<li class="dropdown">	
					<a href="{{ url($value['url']) }}" class="dropdown-toggle" data-toggle="dropdown">{{ $value['title'] }} <b class="caret"></b></a>
						<ul class="dropdown-menu">
						@foreach ($submenu as $menu)
						<li>
							<a href="{{ url($menu['url']) }}">
								{{ $menu['title'] }}
							</a>
						</li>
						@endforeach
						</ul>
					</li>
					@else
					<li><a href="{{ url($value['url']) }}">{{ $value['title'] }}</a></li>
					@endif
				@endforeach
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="{{ url('admin/logout') }}"><i class="glyphicon glyphicon-remove-sign"></i> Logout</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>

	<div class="container main-content middle-content">

		@if(Session::has('message-success'))
			<div class="alert alert-message alert-success">
				<i class="glyphicon glyphicon-info-sign"></i>
				{{ Session::get('message-success') }}
			</div>
		@elseif(Session::has('message-error'))
			<div class="alert alert-message alert-danger">
				<i class="glyphicon glyphicon-info-sign"></i>
				{{ Session::get('message-error') }}
			</div>
		@elseif(Session::has('message-warning'))
			<div class="alert alert-message alert-warning">
				<i class="glyphicon glyphicon-info-sign"></i>
				{{ Session::get('message-warning') }}
			</div>
		@endif

		@yield('main', 'Contest is empty.')

		<div class="footer">
			{{ AdminHelper::copyright() }}
		</div>
	</div>

	{{ AdminHelper::script('js/jquery.js') }}
	{{ AdminHelper::script('bootstrap/js/bootstrap.min.js') }}
	{{ AdminHelper::script('js/admin.js') }}
	
	@yield('script')
	
</body>
</html>