<?php

use Pingpong\Trusty\Entities\Role;
use Pingpong\Admin\Entities\Category;
use Pingpong\Trusty\Entities\Permission;

View::composer('admin::articles.form', function($view)
{
	$categories = Category::lists('name', 'id');
	
	$view->with(compact('categories'));
});

View::composer('admin::users.form', function($view)
{
	$roles = Role::lists('name', 'id');
	$view->with(compact('roles'));
});

View::composer('admin::roles.form', function($view)
{
	$permissions = Permission::lists('name', 'id');
	$view->with(compact('permissions'));
});

View::composer('admin::settings', function($view)
{
	$themes = [
		'default'	=>	'Default',
		'pink'		=>	'Pink',
	];
	$view->with(compact('themes'));
});