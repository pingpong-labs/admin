<?php

Route::group(['prefix' => config('admin.prefix', 'admin'), 'namespace' => 'Pingpong\Admin\Controllers'], function () {
    Route::group(['middleware' => config('admin.filter.guest')], function () {
        Route::resource('login', 'LoginController', [
            'only' => ['index', 'store'],
            'names' => [
                'index' => 'admin.login.index',
                'store' => 'admin.login.store',
            ],
        ]);
    });

    Route::group(['middleware' => config('admin.filter.auth')], function () {
        Route::get('/', ['as' => 'admin.home', 'uses' => 'SiteController@index']);
        Route::get('/logout', ['as' => 'admin.logout', 'uses' => 'SiteController@logout']);

        // settings
        Route::get('settings', ['as' => 'admin.settings', 'uses' => 'SiteController@settings']);
        Route::post('settings', ['as' => 'admin.settings.update', 'uses' => 'SiteController@updateSettings']);

        Route::resource('articles', 'ArticlesController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.articles.index',
                'create' => 'admin.articles.create',
                'store' => 'admin.articles.store',
                'show' => 'admin.articles.show',
                'update' => 'admin.articles.update',
                'edit' => 'admin.articles.edit',
                'destroy' => 'admin.articles.destroy',
            ],
        ]);
        Route::resource('pages', 'ArticlesController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.pages.index',
                'create' => 'admin.pages.create',
                'store' => 'admin.pages.store',
                'show' => 'admin.pages.show',
                'update' => 'admin.pages.update',
                'edit' => 'admin.pages.edit',
                'destroy' => 'admin.pages.destroy',
            ],
        ]);
        Route::resource('users', 'UsersController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.users.index',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'show' => 'admin.users.show',
                'update' => 'admin.users.update',
                'edit' => 'admin.users.edit',
                'destroy' => 'admin.users.destroy',
            ],
        ]);
        Route::resource('categories', 'CategoriesController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.categories.index',
                'create' => 'admin.categories.create',
                'store' => 'admin.categories.store',
                'show' => 'admin.categories.show',
                'update' => 'admin.categories.update',
                'edit' => 'admin.categories.edit',
                'destroy' => 'admin.categories.destroy',
            ],
        ]);
        Route::resource('roles', 'RolesController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.roles.index',
                'create' => 'admin.roles.create',
                'store' => 'admin.roles.store',
                'show' => 'admin.roles.show',
                'update' => 'admin.roles.update',
                'edit' => 'admin.roles.edit',
                'destroy' => 'admin.roles.destroy',
            ],
        ]);
        Route::resource('permissions', 'PermissionsController', [
            'except' => 'show',
            'names' => [
                'index' => 'admin.permissions.index',
                'create' => 'admin.permissions.create',
                'store' => 'admin.permissions.store',
                'show' => 'admin.permissions.show',
                'update' => 'admin.permissions.update',
                'edit' => 'admin.permissions.edit',
                'destroy' => 'admin.permissions.destroy',
            ],
        ]);

        // backup & reset
        Route::get('backup/reset', ['as' => 'admin.reset', 'uses' => 'SiteController@reset']);
        Route::get('app/reinstall', ['as' => 'admin.reinstall', 'uses' => 'SiteController@reinstall']);
        Route::get('cache/clear', ['as' => 'admin.cache.clear', 'uses' => 'SiteController@clearCache']);
    });
});
