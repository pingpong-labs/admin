<?php

return array(

	/*
	|----------------------------------------------------
	| Title
	|----------------------------------------------------
	| Here is title in admin page. You can use your brand
	| name.
	|
	*/
	'title'			=>	'Administrator',

	/*
	|----------------------------------------------------
	| Copyright
	|----------------------------------------------------
	| Here is copyright. You can use Closure object or a
	| string
	|
	*/
	'copyright'		=>	function()
	{
		return '&COPY; '. date('Y').' All rights reserved.';
	},

	/*
	|----------------------------------------------------
	| Homepage
	|----------------------------------------------------
	| Here you define what view are you show in homepage.
	|
	*/
	'homepage'		=>	[
		'view'	=>	'admin::homepage',
		'data'	=>	[]
	],


	/*
	|----------------------------------------------------
	| Template
	|----------------------------------------------------
	| Here you define what view template are you use for
	| admin page. 
	|
	*/
	'template'	=>	'admin::template',
	
	/*
	|----------------------------------------------------
	| Login url
	|----------------------------------------------------
	| Routes url for login page
	|
	*/
	'login-url'	=>	'admin-login',
	
	/*
	|----------------------------------------------------
	| Menus
	|----------------------------------------------------
	| Here you define all menus for your admin page.
	|
	*/
	'menus'			=>	[
		'home'	=>	[
			'title'		=>	'Home',
			'url'		=>	'admin'
		],
		'data'	=>	[
			'title'		=>	'Data',
			'url'		=>	'#'
		],
		'charts'	=>	[
			'title'		=>	'Charts',
			'url'		=>	'#'
		],
		'settings'	=>	[
			'title'		=>	'Settings',
			'url'		=>	'#'
		],
	],

	/*
	|----------------------------------------------------
	| Sub menus
	|----------------------------------------------------
	| Here you define sub menu for main menu above.
	|
	*/
	'submenus'	=>	[
		'data'	=>	[
			[
				'title'	=>	'Users',
				'url'	=>	'admin/users'
			]
		],
		'settings'	=>	[
			[
				'title'	=>	'Charts',
				'url'	=>	'admin/charts'
			]
		],
		'charts'	=>	Chart::submenu()
	],

	/*
	|----------------------------------------------------
	| Permission
	|----------------------------------------------------
	| What permission are you use for secure admin page ?
	|
	*/
	'permission'	=>	'admin.auth',

	/*
	|----------------------------------------------------
	| Costum filters
	|----------------------------------------------------
	| Here code to register your costum filters
	|
	*/
	'filters'	=>	[
		'admin.auth'	=>	function()
		{
			if( ! Auth::check())
			{
				return Redirect::to(Config::get('admin::admin.login-url'))
					->with('message-error', 'You must logged in first.');
			}
		}
	],

	/*
	|----------------------------------------------------
	| Costum page
	|----------------------------------------------------
	| Here code to register your costum page
	|
	*/
	'pages'	=>	array(

		/**
		 * Logout action.
		 *
		 * @return Response
		 */
		'logout' 	=>	function()
		{
			if(Auth::check())
			{
				Auth::logout();
				return Redirect::to('/')
					->with('message-success', 'Logout success.')
				;
			}

			return Redirect::to('/')
				->with('message-error', 'You are not logged in.')
			;
		},

		/**
		 * Chart report for admin page.
		 *
		 * @return Response
		 */
		'charts/{slug}'	=>	function($slug){
			$chart = Chart::whereSlug($slug)->first();
			if(empty($chart))
			{
				return App::abort(404, 'Chart with slug : '.$slug.' not defined.');
			}
			$table = $chart->table;
			$datas = DB::table($table)
	            ->select(array(DB::raw('DISTINCT(date(created_at)) AS date, count(*) AS count')))
                ->orderBy('date', 'asc')
                ->groupBy('date')
                ->get()
	        ;
	        
	        $charttype = 'line';
	        if(Input::has('chart-type'))
	        {
	        	$charttype = Input::get('chart-type');
	        }
	        if( ! in_array($charttype, ['line', 'bar']))
	        {
	        	$charttype = 'line';		        
	        }
	        
	        $selected = url('admin/charts/'.$table.'?chart-type='.$charttype);
			return View::make('pingpong.admin.charts', compact('datas', 'table', 'chart', 'selected', 'charttype'));
		},
	),

	/*
	|----------------------------------------------------
	| Resources
	|----------------------------------------------------
	| Here code to register your resources
	|
	*/
	'resources'	=>	array(
		'users',
		'charts',
	),
);
