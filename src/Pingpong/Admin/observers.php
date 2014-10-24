<?php

Event::listen('admin::routes', function()
{
	$permalink = option('post.permalink', '{slug}');

	$controller = 'Pingpong\Admin\Controllers\SiteController';

	Route::get($permalink, ['as' => 'articles.show', 'uses' => $controller . '@showArticle']);
});

Event::listen('admin::visitors.track', function()
{
	$isOnAdmin  = Request::is('admin') || Request::is('admin/*');
	if( ! $isOnAdmin)
	{
		Visitor::track();
	}
});

Event::listen('admin::menus', function()
{
	require __DIR__ . '/menus.php';
});