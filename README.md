##Simple Administrator Package for Laravel 4.*

###Installation

1. Open your composer.json file and and new required package:

  ```
  "pingpong/admin": "dev-master"
  ```

2. Open terminal and run:

  ```
  composer update
  ```

3. After composer updated, add new service provider:

  ```
  'Pingpong\Admin\AdminServiceProvider',
  ```

4. Open your terminal and run this following code:
  
  ```
  php artisan admin:setup
  ```
  
  It will be running come artisan for setup Administrator Automatically. 
  
5. For test run `php artisan serve` and open `http://localhost:8000/admin` your browser.
   By default username and password is `admin`.

###Artisan CLI
This package have 3 artisan command:
1. 
2. For generate restful auth. This will help you creation login page for administrator.
  ```
  php artisan admin:generate-auth  
  ```
  For example, if you will be create a new named 'Auth' you can run :
  ```
  php artisan admin:generate-auth Auth
  ```
  it will be created File `AuthController` on your `controllers` folder.
3. For generate config file. This will help you restful resources login page for administrator.
  ```
  php artisan admin:generate-config  
  ```
  For example:
  ```
  php artisan admin:generate-config users --table=users --eloquent=User
  ```
  That will be create new file in `app/config/packages/pingpong/admin/resources/` folder named `users`  

###Understanding configuration file for admin page 
1. Title Page
   ```
  /*
	|----------------------------------------------------
	| Title
	|----------------------------------------------------
	| Here is title in admin page. You can use your brand
	| name.
	|
	*/
	'title'			=>	'Administrator',

   ```
2. Footer and Copyright
  ```
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

  ```
3. Home Page

  ```
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
  ```
  
4. Login Url

  ```
  /*
	|----------------------------------------------------
	| Login url
	|----------------------------------------------------
	| Routes url for login page
	|
	*/
	'login-url'	=>	'admin-login',
  ```
  
5. Menu and Submenu

  ```
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
	],
  ```
  
6. Permission and filters

  ```
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
				  ->with('message-error', 'You must logged in first.')
				;
			}
		}
	],

  ```
  
7. Costum Pages

  ```
  /*
	|----------------------------------------------------
	| Costum page
	|----------------------------------------------------
	| Here code to register your costum page
	|
	*/
	'pages'	=>	array(
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
		}
	),
  ```

8. Resources

  ```
  /*
	|----------------------------------------------------
	| Resources
	|----------------------------------------------------
	| Here code to register your resources
	|
	*/
	'resources'	=>	array(
		'users',
	),
  ```

9. Admin Template

  ```
  /*
	|----------------------------------------------------
	| Template
	|----------------------------------------------------
	| Here you define what view template are you use for
	| admin page. 
	|
	*/
	'template'	=>	'admin::template',
  ```

###Understanding configuration file for resources 
By default if you creating new config file you will get many array config like below:

```
<?php

return array(

	'table'     		=>  'users',

	'eloquent'  		=>  'User',

	'data-perpage'  	=>  10,

	'title'   		=>  array(
		'index'         =>  'All Users Data (%s)',
		'create'        =>  'Add New',
		'edit'          =>  'Edit Data',
		'show'          =>  'Show Data',
		'search'        =>  'Search Result : "%s"'
	),

	'search'  		=> 	'id',

	'fields'  		=> 	array(
		'show'		=>	'*',
		'format'	=>	array(
			//
			// example
			//
			// 	'fullname'	=>	'Fullname',
			// 	'user_id'	=>	['Username', function($value)
			// 	{
			// 		return User::find($value)->username;
			// 	}],

		)
	),

	'validation'	=>	array(
		'create'	=>	array(
			'rules'		=>	array(),
			'messages'	=>	array(),
			'format'	=>	array(),
		),
		'update'	=>	array(
			'rules'		=>	array(),
			'messages'	=>	array(),
			'format'	=>	array()
		)
	),

	'form'    		=>  array(
		'create'	=>	array(
			
			//
			// 	example
			//
			//	'username'	=>	array(
			//		'title'	=>	'Username',
			//		'field'	=>	array(
			//			'type'			=>	'text',
			//			'value'			=>	null,
			//			'attributes'	=>	array(
			//				'class'	=>	'form-control'
			//			)
			//		)
			//	)
		),
		'update'	=>	'auto'
	),
);
```
###License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)
