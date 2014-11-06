<?php

Route::group(['prefix' => 'admin', 'namespace' => 'Pingpong\Admin\Controllers'], function ()
{
    Route::group(['before' => 'admin.guest'], function ()
    {
        Route::resource('login', 'LoginController', ['only' => ['index', 'store']]);
    });

    Route::group(['before' => 'admin.auth'], function ()
    {
        Route::get('/', ['as' => 'admin.home', 'uses' => 'SiteController@index']);
        Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'SiteController@logout']);

        // settings
        Route::get('settings', ['as' => 'admin.settings', 'uses' => 'SiteController@settings']);
        Route::post('settings', ['as' => 'admin.settings.update', 'uses' => 'SiteController@updateSettings']);

        // app
        $options = ['except' => ['show']];

        Route::resource('articles', 'ArticlesController', $options);
        Route::resource('pages', 'ArticlesController', $options);
        Route::resource('users', 'UsersController', $options);
        Route::resource('categories', 'CategoriesController', $options);
        Route::resource('roles', 'RolesController', $options);
        Route::resource('permissions', 'PermissionsController', $options);

        // backup & reset
        Route::get('backup/reset', ['as' => 'admin.reset', 'uses' => 'SiteController@reset']);
        Route::get('app/reinstall', ['as' => 'admin.reinstall', 'uses' => 'SiteController@reinstall']);
        Route::get('cache/clear', ['as' => 'admin.cache.clear', 'uses' => 'SiteController@clearCache']);
    });
});