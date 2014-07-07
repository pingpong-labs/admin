<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Pingpong\Admin\Controllers'], function()
{
	Route::group(['before' => Config::get('admin::filter.guest')], function()
	{
		Route::resource('login', 'LoginController', ['only' => ['index', 'store']]);
	});

	Route::group(['before' => Config::get('admin::filter.auth')], function()
	{
		Route::get('/',         ['as' => 'admin.home',      'uses' => 'SiteController@index']);
		Route::get('/logout',   ['as' => 'admin.logout',    'uses' => 'SiteController@logout']);
		
		// settings
		Route::get('settings',  ['as' => 'admin.settings',  'uses' => 'SiteController@settings']);
		Route::post('settings', ['as' => 'admin.settings.update',  'uses' => 'SiteController@updateSettings']);

		// app
		Route::resource('articles', 'ArticlesController');
		Route::resource('pages', 'ArticlesController');
		Route::resource('users', 'UsersController');
		Route::resource('categories', 'CategoriesController');
		Route::resource('roles', 'RolesController');
		Route::resource('permissions', 'PermissionsController');

		// reset
		Route::get('backup/reset', ['as' => 'admin.reset', 'uses' => 'SiteController@reset']);
		Route::get('app/reinstall', ['as' => 'admin.reinstall', 'uses' => 'SiteController@reinstall']);
		Route::get('cache/clear', ['as' => 'admin.cache.clear', 'uses' => 'SiteController@clearCache']);
	});
});