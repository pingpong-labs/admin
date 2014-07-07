<?php

use Pingpong\Auth\Eloquent\Role;
use Pingpong\Auth\Eloquent\Permission;
use Pingpong\Admin\Entities\Category;

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