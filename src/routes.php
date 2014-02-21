<?php

$permission = Config::get('admin::admin.permission');

Route::group(array('prefix'	=>	'admin', 'before'	=>	$permission ), function(){
	
	Route::get('/', 'Pingpong\Admin\SiteController@index');

	/*
	|----------------------------------------------------
	| Costum page
	|----------------------------------------------------
	| Here code to create costum page automaticly
	|
	*/
	$constumPages = Config::get('admin::admin.pages');
	foreach ($constumPages as $page => $callback) {
		
		Route::get($page, $callback);

	}

	/*
	|----------------------------------------------------
	| Resources
	|----------------------------------------------------
	| Here code to create resources automaticly
	|
	*/
	$resources = Config::get('admin::admin.resources');
	foreach ($resources as $resource) {
		
		Route::get($resource.'/search/{search}', 'Pingpong\Admin\ResourceController@getSearch');
		Route::post($resource.'/search', 'Pingpong\Admin\ResourceController@postSearch');
		Route::resource($resource, 'Pingpong\Admin\ResourceController');

	}

});